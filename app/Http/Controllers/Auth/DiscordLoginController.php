<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class DiscordLoginController extends Controller
{
    public function __invoke()
    {
        $discordUser = Socialite::driver('discord')->user();
        $user = $this->findOrNewUser($discordUser);
        Auth::login($user, true);

        return redirect()->intended()->with('alerts', [['message' => 'Welcome!', 'level' => 'success']]);
    }

    protected function findOrNewUser($discordUser)
    {
        $user = User::where('id', $discordUser->getId())->first();

        if (is_null($discordUser->avatar)) {
            $avatar = 'https://ui-avatars.com/api/?name='.urlencode($discordUser->user['global_name']);
        } else {
            $avatar = $discordUser->avatar;
        }

        if ($user) {
            $user->update([
                'discord_name' => $discordUser->user['global_name'],
                'discord_discriminator' => $discordUser->user['discriminator'],
                'discord_username' => $discordUser->user['username'],
                'avatar' => $avatar,
                'email' => $discordUser->email,
                'last_login_at' => now(),
            ]);
        } else {
            User::create([
                'id' => $discordUser->user['id'],
                'discord_name' => $discordUser->user['global_name'],
                'discord_discriminator' => $discordUser->user['discriminator'],
                'discord_username' => $discordUser->user['username'],
                'avatar' => $avatar,
                'email' => $discordUser->email,
                'last_login_at' => now(),
            ]);
        }

        return User::where('id', $discordUser->getId())->first();
    }
}
