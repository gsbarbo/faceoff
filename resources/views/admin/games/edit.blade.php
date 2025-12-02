@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Edit Game" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.games.index')}}">Games</x-breadcrumb-link>
                <x-breadcrumb-link route="{{route('admin.games.edit', $game->id)}}">Edit</x-breadcrumb-link>
                <x-breadcrumb-text>{{$game->name}}</x-breadcrumb-text>
            </x-breadcrumb>
        </header>

        <div class="">
            <form action="{{route('admin.games.update', $game->id)}}" method="POST" class="form">
                @csrf
                @method('PUT')

                <x-forms.input name="name" label="Game Name" required autocomplete="off"
                               autofocus>{{old('name', $game->name)}}</x-forms.input>
                <x-forms.input name="short_code" label="Game Short Code" required autocomplete="off"
                               help="e.g. BO7">{{old('name', $game->short_code)}}</x-forms.input>

                <x-forms.buttons name="Save Game"
                                 cancel-route="{{route('admin.games.index')}}"></x-forms.buttons>

            </form>
        </div>

    </div>

@endsection
