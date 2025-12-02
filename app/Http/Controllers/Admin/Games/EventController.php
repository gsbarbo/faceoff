<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Season;
use App\Support\Flash;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.events.index');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();
        Event::create($data);
        Flash::success('Event created successfully.');

        return redirect()->route('admin.events.index');
    }

    public function create()
    {
        $seasons = Season::get();

        return view('admin.events.create', compact('seasons'));
    }

    public function edit(Event $event)
    {
        $seasons = Season::get();

        return view('admin.events.edit', compact('event', 'seasons'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();
        $event->update($data);
        Flash::success('Event updated successfully.');

        return redirect()->route('admin.events.index');
    }
}
