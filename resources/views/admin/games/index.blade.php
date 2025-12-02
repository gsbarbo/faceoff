@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Manage Games" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.games.index')}}">Teams</x-breadcrumb-link>
            </x-breadcrumb>

            <div class="">
                @can('admin.games.create')
                    <a class="" href="{{ route('admin.games.create') }}">
                        <button class="bg-green-600 btn hover:bg-green-800">Add Game</button>
                    </a>
                @endcan
            </div>
        </header>

        <div class="">
            <livewire:table
                    :model="\App\Models\Game::class"
                    edit-route="admin.games.edit"
                    edit-id="id"
                    :columns="['name' => 'Name']"
            />
        </div>

    </div>

@endsection
