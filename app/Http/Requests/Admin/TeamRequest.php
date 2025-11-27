<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class TeamRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'logo_url' => ['required', 'url'],
        ];
    }

    public function authorize(): bool
    {
        return Gate::allows('admin.teams.create') || Gate::allows('admin.teams.update');
    }
}
