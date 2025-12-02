@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Edit Season" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.seasons.index')}}">Seasons</x-breadcrumb-link>
                <x-breadcrumb-link route="{{route('admin.seasons.edit', $season->id)}}">Edit</x-breadcrumb-link>
                <x-breadcrumb-text>{{$season->name}}</x-breadcrumb-text>
            </x-breadcrumb>
        </header>

        <div class="">
            <form action="{{route('admin.seasons.update', $season->id)}}" method="POST" class="form">
                @csrf
                @method('PUT')

                <x-forms.input name="name" required autocomplete="off"
                               autofocus>{{old('name', $season->name)}}</x-forms.input>
                <x-forms.select name="game_id" label="Game" required>
                    @foreach($games as $game)
                        <option value="{{$game->id}}">{{$game->name}}</option>
                    @endforeach
                </x-forms.select>
                <x-forms.input name="start_date" type="date" required
                               autocomplete="off">{{old('name', $season->start_date->format('Y-m-d'))}}</x-forms.input>

                <x-forms.input name="end_date" type="date" required
                               autocomplete="off">{{old('name', $season->end_date->format('Y-m-d'))}}</x-forms.input>

                <x-forms.buttons name="Save Season"
                                 cancel-route="{{route('admin.seasons.index')}}"></x-forms.buttons>

            </form>
        </div>

    </div>

@endsection
