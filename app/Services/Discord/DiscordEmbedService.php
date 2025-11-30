<?php

namespace App\Services\Discord;

class DiscordEmbedService
{
    public string $title = '';

    public string $description = '';

    public ?int $color = null;

    /** @var array<int, array> */
    public array $fields = [];

    public static function make(): self
    {
        return new self;
    }

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function color(int $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function field(string $name, string $value, bool $inline = false): self
    {
        $this->fields[] = [
            'name' => $name,
            'value' => $value,
            'inline' => $inline,
        ];

        return $this;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'color' => $this->color,
            'fields' => $this->fields,
        ];
    }
}
