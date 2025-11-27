<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamRequest;
use App\Models\Team;
use App\Services\ImageService;
use App\Support\Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Str;

class TeamController extends Controller
{
    public function index(): View
    {
        abort_unless('can:admin.teams.read', 403, 'Unauthorized action');

        return view('admin.teams.index');
    }

    public function store(TeamRequest $request): RedirectResponse
    {
        abort_unless('can:admin.teams.create', 403, 'Unauthorized action');

        $pictureUrl = ImageService::saveFromUrl(
            url: $request->input('logo_url'),
            fileName: $request->input('name'),
        );

        Team::create([
            'name' => $request->input('name'),
            'logo_url' => $pictureUrl,
            'slug' => Str::slug($request->input('name')),
        ]);

        Flash::success('Team saved.');

        if ($request->action == 'save_add') {
            return redirect()->route('admin.teams.create');
        }

        return redirect()->route('admin.teams.index');
    }

    public function create(): View
    {
        abort_unless('can:admin.teams.create', 403, 'Unauthorized action');

        return view('admin.teams.create');
    }

    public function edit(Team $team): View
    {
        abort_unless('can:admin.teams.update', 403, 'Unauthorized action');

        return view('admin.teams.edit', compact('team'));
    }

    public function update(TeamRequest $request, Team $team): RedirectResponse
    {
        abort_unless('can:admin.teams.update', 403, 'Unauthorized action');

        $data = $request->validated();
        $data['slug'] = Str::slug($request->input('name'));

        if ($data['logo_url'] !== $team->logo_url) {
            $data['logo_url'] = ImageService::saveFromUrl(
                url: $request->input('logo_url'),
                fileName: $request->input('name'),
            );
        } else {
            unset($data['logo_url']);
        }

        $team->update($data);

        Flash::success('Team saved.');

        return redirect()->route('admin.teams.index');
    }
}
