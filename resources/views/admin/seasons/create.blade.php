@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Create Season" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.seasons.index')}}">Seasons</x-breadcrumb-link>
                <x-breadcrumb-link route="{{route('admin.seasons.create')}}">Create</x-breadcrumb-link>
            </x-breadcrumb>
        </header>

        <div class="">
            <form action="{{route('admin.seasons.store')}}" method="POST" class="form">
                @csrf

                <x-forms.input name="name" required autocomplete="off" autofocus/>
                <x-forms.select name="game_id" label="Game" required>
                    @foreach($games as $game)
                        <option value="{{$game->id}}">{{$game->name}}</option>
                    @endforeach
                </x-forms.select>
                <x-forms.input name="start_date" type="date" required autocomplete="off"/>

                <x-forms.input name="end_date" type="date" required autocomplete="off"/>

                <x-forms.buttons name="Create Season"
                                 cancel-route="{{route('admin.seasons.index')}}"></x-forms.buttons>

            </form>
        </div>

    </div>

@endsection
