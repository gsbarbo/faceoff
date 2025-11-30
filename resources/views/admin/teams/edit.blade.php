@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto space-y-4">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Edit Team | {{$team->name}}" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.teams.index')}}">Teams</x-breadcrumb-link>
                <x-breadcrumb-link route="{{route('admin.teams.edit', $team->id)}}">Edit</x-breadcrumb-link>
                <x-breadcrumb-text>{{$team->name}}</x-breadcrumb-text>
            </x-breadcrumb>
        </header>

        <div class="card" x-data="{open: false}">
            <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                <h1 class="text-lg">Team Information</h1>
            </div>

            <div class="mt-3" x-show="open">
                <form action="{{route('admin.teams.update', $team->id)}}" method="POST" class="form">
                    @csrf
                    @method('PUT')

                    <x-forms.input name="name" label="Team Name" required autocomplete="off"
                                   autofocus>{{$team->name}}</x-forms.input>

                    <div>
                        <p class="form-label">Current Logo</p>
                        <img src="{{asset($team->logo_url)}}" alt="{{$team->name}} logo" class="w-64">
                    </div>

                    <x-forms.input name="logo_url" type="url" help="Must be a Discord CDN link."
                                   required>{{asset($team->logo_url)}}</x-forms.input>

                    <x-forms.buttons name="Save Team" cancel-route="{{route('admin.teams.index')}}"></x-forms.buttons>

                </form>
            </div>
        </div>

        <div class="card" x-data="{open: false}">
            <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                <h1 class="text-lg">Team Roster</h1>
            </div>

            <div class="mt-3" x-show="open">

            </div>
        </div>

        <div class="card" x-data="{open: false}">
            <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                <h1 class="text-lg">Team Stats</h1>
            </div>

            <div class="mt-3" x-show="open">

            </div>
        </div>

        <div class="card" x-data="{open: false}">
            <div class="flex justify-between items-center cursor-pointer bg-red-500 -m-2 p-2" @click="open = !open">
                <h1 class="text-lg">Danger Area</h1>
            </div>

            <div class="mt-3" x-show="open">
                asdfasdfa
            </div>
        </div>

    </div>

@endsection
