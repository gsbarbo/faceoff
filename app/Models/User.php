<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    protected $guarded = [];

    public function canAccess(string|array $abilities): bool
    {
        if ($this->is_owner || $this->is_super_user) {
            return true;
        }

        $abilities = is_array($abilities) ? $abilities : [$abilities];
        $userPermissions = $this->getAllPermissions();

        foreach ($abilities as $check) {

            if (! str_contains($check, '*') && $this->hasPermissionTo($check)) {
                return true;
            }

            foreach ($userPermissions as $perm) {
                if (Str::is($check, $perm->name)) {
                    return true;
                }
            }

        }

        return false;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
