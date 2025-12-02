<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeasonRequest;
use App\Models\Game;
use App\Models\Season;
use App\Support\Flash;

class SeasonController extends Controller
{
    public function index()
    {
        $seasons = Season::get();

        return view('admin.seasons.index', compact('seasons'));
    }

    public function store(SeasonRequest $request)
    {
        $data = $request->validated();
        Season::create($data);
        Flash::success('Season created successfully.');

        return redirect()->route('admin.seasons.index');
    }

    public function create()
    {
        $games = Game::get();

        return view('admin.seasons.create', compact('games'));
    }

    public function edit(Season $season)
    {
        $games = Game::get();

        return view('admin.seasons.edit', compact('season', 'games'));
    }

    public function update(SeasonRequest $request, Season $season)
    {
        $data = $request->validated();
        $season->update($data);
        Flash::success('Season updated successfully.');

        return redirect()->route('admin.seasons.index');
    }
}
