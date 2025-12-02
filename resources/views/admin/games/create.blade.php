@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Create Game" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.games.index')}}">Games</x-breadcrumb-link>
                <x-breadcrumb-link route="{{route('admin.games.create')}}">Create</x-breadcrumb-link>
            </x-breadcrumb>
        </header>

        <div class="">
            <form action="{{route('admin.games.store')}}" method="POST" class="form">
                @csrf

                <x-forms.input name="name" label="Game Name" required autocomplete="off" autofocus/>
                <x-forms.input name="short_code" label="Game Short Code" required autocomplete="off" help="e.g. BO7"/>

                <x-forms.buttons name="Create Game"
                                 cancel-route="{{route('admin.games.index')}}"></x-forms.buttons>

            </form>
        </div>

    </div>

@endsection
