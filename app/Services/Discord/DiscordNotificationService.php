<?php

namespace App\Services\Discord;

namespace App\Services\Discord;

use App\Models\DiscordChannel;
use Illuminate\Http\Client\Response;
use InvalidArgumentException;

class DiscordNotificationService
{
    protected ?int $channelId = null;

    protected array $embeds = [];

    protected string $content = '';

    public function __construct(
        protected DiscordApiService $api
    ) {}

    public static function make(): self
    {
        return app(self::class);
    }

    public function channel(string|int $value): self
    {
        // If numeric → assume it's a Discord channel ID
        if (is_numeric($value)) {
            $this->channelId = (int) $value;

            return $this;
        }

        // Otherwise treat it as a named channel stored in the DB
        $channel = DiscordChannel::where('name', $value)->first();

        if (! $channel) {
            throw new InvalidArgumentException("Discord channel '{$value}' not found.");
        }

        $this->channelId = $channel->channel_id;

        return $this;
    }

    public function content(string $text): self
    {
        $this->content = $text;

        return $this;
    }

    /** Add a single embed */
    public function embed(DiscordEmbedService $embed): self
    {
        $this->embeds[] = $embed->toArray();

        return $this;
    }

    /** Add multiple embeds */
    public function embeds(array $embeds): self
    {
        foreach ($embeds as $embed) {
            if (! $embed instanceof DiscordEmbedService) {
                throw new InvalidArgumentException(
                    'All items passed to embeds() must be instances of DiscordEmbed'
                );
            }

            $this->embeds[] = $embed->toArray();
        }

        return $this;
    }

    public function send(): Response
    {
        if (! $this->channelId) {
            throw new InvalidArgumentException('You must specify a channel before sending.');
        }

        if (empty($this->content) && empty($this->embeds)) {
            throw new InvalidArgumentException('Cannot send an empty Discord message.');
        }

        return $this->api->post(
            "/channels/{$this->channelId}/messages",
            [
                'content' => $this->content ?: null,
                'embeds' => $this->embeds,
            ]
        );
    }
}
