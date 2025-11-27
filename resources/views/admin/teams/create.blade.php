@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Create Team" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.teams.index')}}">Teams</x-breadcrumb-link>
                <x-breadcrumb-link route="{{route('admin.teams.create')}}">Create</x-breadcrumb-link>
            </x-breadcrumb>
        </header>

        <div class="">
            <form action="{{route('admin.teams.store')}}" method="POST" class="form">
                @csrf

                <x-forms.input name="name" label="Team Name" required autocomplete="off" autofocus/>
                <x-forms.input name="logo_url" type="url" help="Must be a Discord CDN link." required/>

                <x-forms.buttons name="Create Team" save-add-another="true"
                                 cancel-route="{{route('admin.teams.index')}}"></x-forms.buttons>

            </form>
        </div>

    </div>

@endsection
