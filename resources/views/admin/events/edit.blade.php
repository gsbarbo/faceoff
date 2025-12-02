@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Edit Event" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.events.index')}}">Seasons</x-breadcrumb-link>
                <x-breadcrumb-link route="{{route('admin.events.edit', $event->id)}}">Edit</x-breadcrumb-link>
                <x-breadcrumb-text>{{$event->name}}</x-breadcrumb-text>
            </x-breadcrumb>
        </header>

        <div class="">
            <form action="{{route('admin.events.update', $event->id)}}" method="POST" class="form">
                @csrf
                @method('PUT')

                <x-forms.input name="name" required autocomplete="off"
                               autofocus>{{old('name', $event->name)}}</x-forms.input>
                <x-forms.select name="season_id" label="Season" required>
                    @foreach($seasons as $season)
                        <option value="{{$season->id}}" @selected(old('season_id', $event->season_id) == $season->id)>{{$season->name}}</option>
                    @endforeach
                </x-forms.select>
                <x-forms.input name="start_date" type="date" required
                               autocomplete="off">{{old('name', $event->start_date->format('Y-m-d'))}}</x-forms.input>

                <x-forms.input name="end_date" type="date" required
                               autocomplete="off">{{old('name', $event->end_date->format('Y-m-d'))}}</x-forms.input>

                <x-forms.buttons name="Save Event"
                                 cancel-route="{{route('admin.events.index')}}"></x-forms.buttons>

            </form>
        </div>

    </div>

@endsection
