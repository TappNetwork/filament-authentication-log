<?php

namespace Tapp\FilamentAuthenticationLog;

use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\Panel;

class FilamentAuthenticationLogPlugin implements Plugin
{
    protected ?string $panelName = null;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'authentication-log';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources(
                config('filament-authentication-log.resources')
            );
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function get(): Plugin
    {
        return filament(app(static::class)->getId());
    }

    public function getPanelName(): ?string
    {
        return $this->panelName ?? Filament::getCurrentPanel()->getId();
    }

    public function panelName(string $name): static
    {
        $this->panelName = $name;

        return $this;
    }
}
