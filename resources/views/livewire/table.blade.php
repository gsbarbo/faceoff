<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

new class extends Component {
    use WithPagination;

    public array $columns = [];       // column configs
    public string $model;             // e.g. App\Models\User::class
    public string $editRoute = '';    // e.g. "admin.users.edit"
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
     |  Utility Helpers
     | -------------------------------------------------------------
     */

    private function colConfig(string $field): array
    {
        $config = $this->columns[$field] ?? [];
        return is_array($config) ? $config : ['label' => $config];
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
        return $this->colConfig($field)['relation'] ?? null;
    }

    private function searchableColumns(): array
    {
        return collect($this->columns)
            ->filter(fn($cfg, $field) => $this->isSearchable($field))
            ->mapWithKeys(function ($cfg, $field) {
                $cfg = $this->colConfig($field);

                if (isset($cfg['relation'])) {
                    return [
                        $field => [
                            'relation' => $cfg['relation'],
                            'display' => $cfg['display'],
                        ]
                    ];
                }

                return [
                    $field => [
                        'relation' => null,
                        'display' => $field,
                    ]
                ];
            })
            ->toArray();
    }

    /* -------------------------------------------------------------
     |  Lifecycle
     | -------------------------------------------------------------
     */

    public function updatingFilters(): void
    {
        $this->resetPage();
    }

    public function updatingGlobalSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
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
     |  Query Builder
     | -------------------------------------------------------------
     */

    public function with(): array
    {
        $query = $this->model::query();

        /* EAGER LOAD RELATIONS */
        foreach ($this->columns as $field => $cfg) {
            $rel = $this->relationConfig($field);
            if ($rel) $query->with($rel);
        }

        /* GLOBAL SEARCH */
        if (!empty($this->globalSearch)) {
            $searchTerm = $this->globalSearch;

            $query->where(function (Builder $q) use ($searchTerm) {
                foreach ($this->searchableColumns() as $field => $cfg) {

                    if ($cfg['relation']) {
                        $q->orWhereHas($cfg['relation'], function (Builder $qr) use ($cfg, $searchTerm) {
                            $qr->where($cfg['display'], 'like', "%$searchTerm%");
                        });
                    } else {
                        $q->orWhere($cfg['display'], 'like', "%$searchTerm%");
                    }

                }
            });
        }

        /* COLUMN FILTERS */
        foreach ($this->filters as $field => $value) {
            if (empty($value) || !$this->isSearchable($field)) continue;

            $rel = $this->relationConfig($field);

            if ($rel) {
                $query->whereHas($rel, function (Builder $q) use ($field, $value) {
                    $display = $this->colConfig($field)['display'];
                    $q->where($display, 'like', "%$value%");
                });
            } else {
                $query->where($field, 'like', "%$value%");
            }
        }

        /* SORTING */
        if ($this->sortField && $this->isSortable($this->sortField)) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return [
            'rows' => $query->paginate(10),
        ];
    }

    public function clearFilters(): void
    {
        $this->filters = [];
        $this->globalSearch = '';
        $this->sortField = '';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }
};

?>


<div>

    {{-- GLOBAL SEARCH BAR --}}
    {{--    <div class="mb-4">--}}
    {{--        <input type="text"--}}
    {{--               wire:model.live.debounce.500ms="globalSearch"--}}
    {{--               placeholder="Search all columns…"--}}
    {{--               class="form-text-input w-full max-w-md">--}}
    {{--    </div>--}}

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">

            {{-- TABLE HEADER --}}
            <thead class="bg-charcoal-light">
            <tr>
                @foreach($columns as $key => $colConfig)
                    @php
                        $label = is_array($colConfig) ? $colConfig['label'] : $colConfig;
                        $sortable = is_array($colConfig)
                            ? ($colConfig['sortable'] ?? true)
                            : true;
                    @endphp

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider
                               {{ $sortable ? 'cursor-pointer' : '' }}"
                        @if($sortable) wire:click="sortBy('{{ $key }}')" @endif>

                        {{ $label }}

                        @if($sortable && $sortField === $key)
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        @endif

                    </th>
                @endforeach

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    Actions
                </th>
            </tr>

            {{-- FILTER ROW --}}
            <tr>
                @foreach($columns as $key => $colConfig)
                    @php
                        $label = is_array($colConfig) ? $colConfig['label'] : $colConfig;
                        $searchable = !is_array($colConfig) || (($colConfig['searchable'] ?? true));
                    @endphp

                    <th class="px-6 py-2">
                        @if($searchable)
                            <input type="text"
                                   wire:model.live.debounce.500ms="filters.{{ $key }}"
                                   placeholder="Search {{ strtolower($label) }}"
                                   class="form-text-input max-w-xl">
                        @endif
                    </th>
                @endforeach

                <th class="px-6 py-2">
                    <button class="btn btn-gray btn-sm btn-rounded" wire:click="clearFilters">
                        Clear Filters
                    </button>
                </th>
            </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="bg-charcoal-light divide-gray-700">

            @forelse($rows as $row)
                <tr>
                    @foreach($columns as $key => $colConfig)
                        <td class="px-6 py-4 whitespace-nowrap text-wrap text-sm text-steel-gray">

                            @if (is_array($colConfig) && isset($colConfig['relation']))
                                {{ $row->{$colConfig['relation']}->pluck($colConfig['display'])->join(', ') }}
                            @else
                                {{ data_get($row, $key) }}
                            @endif

                        </td>
                    @endforeach

                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route($editRoute, $row->$editId) }}"
                           class="text-teal-500 underline">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + 1 }}"
                        class="px-6 py-4 text-center text-sm text-gray-500">
                        No results found.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $rows->links() }}
        </div>
    </div>
</div>