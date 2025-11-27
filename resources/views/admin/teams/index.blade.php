@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Manage Teams" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.teams.index')}}">Teams</x-breadcrumb-link>
            </x-breadcrumb>

            <div class="">
                @can('admin.teams.create')
                    <a class="" href="{{ route('admin.teams.create') }}">
                        <button class="bg-green-600 btn hover:bg-green-800">Add Team</button>
                    </a>
                @endcan
            </div>
        </header>

        <div class="">
            <livewire:table
                    :model="\App\Models\Team::class"
                    edit-route="admin.teams.edit"
                    edit-id="id"
                    :columns="['name' => 'Name']"
            />
        </div>

    </div>

@endsection
