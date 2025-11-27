@extends('layouts.public')

@section('content')
    <div class="container max-w-4xl mx-auto grid md:grid-cols-3 gap-3">

        @foreach($teams as $team)
            <div class="card space-y-2">

                <div class="">
                    <h1 class="text-lg text-center font-bold">{{$team->name}}</h1>
                    <img src="{{asset($team->logo_url)}}" alt="{{$team->name}} Logo">
                </div>

                <div class="text-sm">
                    <h1 class="text-center text-base underline">Players</h1>
                    @forelse($team->players as $player)
                        <p class="">{{$player->name}} ({{$player->role}})</p>
                    @empty
                        <p>No Players</p>
                    @endforelse
                </div>

                <div class="w-full">
                    <hr class="py-2">
                    <a class="btn btn-outline w-full" href="#">View Team</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
