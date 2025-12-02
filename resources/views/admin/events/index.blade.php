@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Manage Events" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.events.index')}}">Events</x-breadcrumb-link>
            </x-breadcrumb>

            <div class="">
                @can('admin.events.create')
                    <a class="" href="{{ route('admin.events.create') }}">
                        <button class="bg-green-600 btn hover:bg-green-800">Add Event</button>
                    </a>
                @endcan
            </div>
        </header>

        <div class="">
            <livewire:table
                    :model="\App\Models\Event::class"
                    edit-route="admin.events.edit"
                    edit-id="id"
                    :columns="[
                        'name' => 'Name',
                        'start_date' => 'Start Date',
                        'end_date' => 'End Date',
                        'season' => [
                            'label' => 'Season',
                            'relation' => 'season',
                            'display' => 'name',
                        ]
                    ]"
            />
        </div>

    </div>

@endsection
