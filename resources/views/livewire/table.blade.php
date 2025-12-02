<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

new class extends Component {
    use WithPagination;

    public array $columns = [];
    public string $model;
    public string $editRoute = '';
    public string $editId = 'id';

    public array $filters = [];
    public string $sortField = '';
    public string $sortDirection = 'asc';
    public string $globalSearch = '';

    protected array $queryString = [
        'filters',
        'sortField',
        'sortDirection',
        'globalSearch',
    ];

    /* -------------------------------------------------------------
     |  Helpers
     | ------------------------------------------------------------- */

    private function colConfig(string $field): array
    {
        $cfg = $this->columns[$field] ?? [];
        return is_array($cfg) ? $cfg : ['label' => $cfg];
    }

    private function isSortable(string $field): bool
    {
        return $this->colConfig($field)['sortable'] ?? true;
    }

    private function isSearchable(string $field): bool
    {
        return $this->colConfig($field)['searchable'] ?? true;
    }

    private function relationConfig(string $field): ?array
    {
        $cfg = $this->colConfig($field);
        return $cfg['relation'] ?? null;
    }

    private function eagerRelations(): array
    {
        return collect($this->columns)
            ->filter(fn($cfg) => is_array($cfg) && isset($cfg['relation']))
            ->map(fn($cfg) => $cfg['relation'])
            ->unique()
            ->values()
            ->all();
    }

    /* -------------------------------------------------------------
     |  Lifecycle
     | ------------------------------------------------------------- */

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function updatingGlobalSearch()
    {
        $this->resetPage();
    }

    public function sortBy(string $field)
    {
        if (!$this->isSortable($field)) return;

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    /* -------------------------------------------------------------
     |  Building Result Set (N+1 SAFE)
     | ------------------------------------------------------------- */

    public function with(): array
    {
        $query = $this->model::query()->with($this->eagerRelations());

        /* ---------- Global Search ---------- */
        if ($this->globalSearch) {
            $search = $this->globalSearch;
            $query->where(function (Builder $q) use ($search) {
                foreach ($this->columns as $field => $cfg) {
                    $cfg = $this->colConfig($field);

                    if (!$this->isSearchable($field)) continue;

                    if (isset($cfg['relation'])) {
                        $relation = $cfg['relation'];
                        $display = $cfg['display'];

                        $q->orWhereHas($relation, fn($qr) => $qr->where($display, 'like', "%{$search}%")
                        );

                    } else {
                        $q->orWhere($field, 'like', "%{$search}%");
                    }
                }
            });
        }

        /* ---------- Column Filters ---------- */
        foreach ($this->filters as $field => $value) {
            if (!$value) continue;

            $cfg = $this->colConfig($field);

            if (isset($cfg['relation'])) {
                $relation = $cfg['relation'];
                $display = $cfg['display'];

                $query->whereHas($relation, fn($q) => $q->where($display, 'like', "%{$value}%")
                );

            } else {
                $query->where($field, 'like', "%{$value}%");
            }
        }

        /* ---------- Sorting (including relations) ---------- */
        if ($this->sortField && $this->isSortable($this->sortField)) {
            $cfg = $this->colConfig($this->sortField);

            if (isset($cfg['relation'])) {
                // Relation sorting via joinRelation
                $relation = $cfg['relation'];
                $display = $cfg['display'];

                $query->joinRelation($relation)
                    ->orderBy($relation.'.'.$display, $this->sortDirection)
                    ->select($this->model::query()->getModel()->getTable().'.*');
            } else {
                $query->orderBy($this->sortField, $this->sortDirection);
            }
        }

        /* ---------- PAGINATE + PRE-FORMAT ALL CELLS (No N+1 in View) ---------- */
        $rows = $query->paginate(10);

        $rows->getCollection()->transform(function ($row) {
            $formatted = [];

            foreach ($this->columns as $key => $cfg) {
                $formatted[$key] = $this->formatCell($row, $key);
            }

            $row->formatted = $formatted; // store safe values
            return $row;
        });

        return ['rows' => $rows];
    }

    public function clearFilters()
    {
        $this->filters = [];
        $this->globalSearch = '';
        $this->sortField = '';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }

    /* -------------------------------------------------------------
     |  Formatting Output (Runs Once Per Row)
     | ------------------------------------------------------------- */

    public function formatCell($row, string $key)
    {
        $cfg = $this->colConfig($key);

        /* ---------- Relation column ---------- */
        if (isset($cfg['relation'])) {
            $relation = $cfg['relation'];
            $display = $cfg['display'];
            $multiple = $cfg['multiple'] ?? false;

            $related = $row->$relation;

            if (!$related) return '';

            if ($multiple) {
                return $related->pluck($display)->join(', ');
            }

            return $related->$display ?? '';
        }

        /* ---------- Auto-format dates ---------- */
        $value = data_get($row, $key);

        if ($value instanceof Carbon) {
            return $value->format($cfg['format'] ?? 'm/d/Y');
        }

        /* ---------- Custom callback formatter ---------- */
        if (isset($cfg['format']) && is_callable($cfg['format'])) {
            return ($cfg['format'])($value, $row);
        }

        return $value;
    }
};
?>

<div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">

            {{-- Headers --}}
            <thead class="bg-charcoal-light">
            <tr>
                @foreach($columns as $key => $col)
                    @php
                        $cfg = is_array($col) ? $col : ['label' => $col];
                        $sortable = $cfg['sortable'] ?? true;
                    @endphp

                    <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase tracking-wider
                                   {{ $sortable ? 'cursor-pointer' : '' }}"
                        @if($sortable)
                            wire:click="sortBy('{{ $key }}')"
                            @endif>

                        {{ $cfg['label'] }}

                        @if($sortable && $sortField === $key)
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        @endif

                    </th>
                @endforeach

                <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">Actions</th>
            </tr>

            {{-- Filters --}}
            <tr>
                @foreach($columns as $key => $col)
                    @php
                        $cfg = is_array($col) ? $col : ['label' => $col];
                        $searchable = $cfg['searchable'] ?? true;
                    @endphp

                    <th class="px-6 py-2">
                        @if($searchable)
                            <input type="text"
                                   wire:model.live.debounce.500ms="filters.{{ $key }}"
                                   placeholder="Search {{ strtolower($cfg['label']) }}"
                                   class="form-text-input">
                        @endif
                    </th>
                @endforeach

                <th class="px-6 py-2">
                    <button wire:click="clearFilters" class="btn btn-gray btn-sm">Clear</button>
                </th>
            </tr>
            </thead>

            {{-- Body --}}
            <tbody class="divide-y divide-gray-700 bg-charcoal-light">

            @forelse($rows as $row)
                <tr>
                    @foreach($columns as $key => $cfg)
                        <td class="px-6 py-4 text-sm text-gray-300">
                            {{ $row->formatted[$key] }}
                        </td>
                    @endforeach

                    <td class="px-6 py-4">
                        <a href="{{ route($editRoute, $row->$editId) }}"
                           class="text-teal-400 underline">Edit</a>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="{{ count($columns) + 1 }}"
                        class="px-6 py-4 text-center text-gray-500">
                        No results found.
                    </td>
                </tr>
            @endforelse

            </tbody>

        </table>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $rows->links() }}
        </div>
    </div>

</div>