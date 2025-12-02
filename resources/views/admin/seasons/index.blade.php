@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Manage Seasons" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.seasons.index')}}">Teams</x-breadcrumb-link>
            </x-breadcrumb>

            <div class="">
                @can('admin.seasons.create')
                    <a class="" href="{{ route('admin.seasons.create') }}">
                        <button class="bg-green-600 btn hover:bg-green-800">Add Season</button>
                    </a>
                @endcan
            </div>
        </header>

        <div class="">
            <livewire:table
                    :model="\App\Models\Season::class"
                    edit-route="admin.seasons.edit"
                    edit-id="id"
                    :columns="[
                        'name' => 'Name',
                        'start_date' => 'Start Date',
                        'end_date' => 'End Date',
                        'game' => [
                            'label' => 'Game',
                            'relation' => 'game',
                            'display' => 'name',
                        ],
                    ]"
            />
        </div>

    </div>

@endsection
