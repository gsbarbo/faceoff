@extends('layouts.admin')

@section('content')

    <div class="container max-w-5xl mx-auto">

        <header class="flex justify-between items-center mb-6">
            <x-breadcrumb pageTitle="Create Event" route="{{ route('admin.dashboard') }}">
                <x-breadcrumb-link route="{{route('admin.events.index')}}">Events</x-breadcrumb-link>
                <x-breadcrumb-link route="{{route('admin.events.create')}}">Create</x-breadcrumb-link>
            </x-breadcrumb>
        </header>

        <div class="">
            <form action="{{route('admin.events.store')}}" method="POST" class="form">
                @csrf

                <x-forms.input name="name" required autocomplete="off" autofocus/>
                <x-forms.select name="season_id" label="Season" required>
                    @foreach($seasons as $season)
                        <option value="{{$season->id}}">{{$season->name}}</option>
                    @endforeach
                </x-forms.select>
                <x-forms.input name="start_date" type="date" required autocomplete="off"/>

                <x-forms.input name="end_date" type="date" required autocomplete="off"/>

                <x-forms.buttons name="Create Event"
                                 cancel-route="{{route('admin.events.index')}}"></x-forms.buttons>

            </form>
        </div>

    </div>

@endsection
