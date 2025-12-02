<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GameRequest;
use App\Models\Game;
use App\Support\Flash;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::get();

        return view('admin.games.index', compact('games'));

    }

    public function store(GameRequest $request)
    {
        $data = $request->validated();
        Game::create($data);
        Flash::success('Game created successfully.');

        return redirect()->route('admin.games.index');
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    public function update(GameRequest $request, Game $game)
    {
        $data = $request->validated();
        $game->update($data);
        Flash::success('Game updated successfully.');

        return redirect()->route('admin.games.index');
    }
}
