@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Edit Team | {{$team->name}}" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.teams.index')}}">Teams</x-breadcrumb-link>
                <x-breadcrumb-link route="{{route('admin.teams.edit', $team->id)}}">Edit</x-breadcrumb-link>
                <x-breadcrumb-text>{{$team->name}}</x-breadcrumb-text>
            </x-breadcrumb>
        </header>

        <div class="">
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

@endsection
