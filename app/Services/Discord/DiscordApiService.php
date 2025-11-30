<?php

namespace App\Services\Discord;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class DiscordApiService
{
    protected string $baseUrl = 'https://discord.com/api';

    public function post(string $endpoint, array $payload): Response
    {
        //        dd(Http::acceptJson()
        //
        //            ->post($this->baseUrl.$endpoint, $payload));

        return Http::acceptJson()
            ->withHeaders(['Authorization' => config('services.discord.discord_bot_token')])
            ->post($this->baseUrl.$endpoint, $payload);
    }
}
