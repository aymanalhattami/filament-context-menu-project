<?php

namespace App\Helper;

class ContentMenuItem
{
    private ?string $title = null;

    private ?string $url = null;

    private ?string $icon = null;

    private ?string $target = null;

    public static function make(): static
    {
        return new static;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function title(?string $title): ContentMenuItem
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function url(?string $url): ContentMenuItem
    {
        $this->url = $url;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function icon(?string $icon): ContentMenuItem
    {
        $this->icon = $icon;

        return $this;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function setTarget(?string $target): ContentMenuItem
    {
        $this->target = $target;

        return $this;
    }
}
