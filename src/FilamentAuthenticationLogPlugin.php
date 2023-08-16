<?php

namespace Tapp\FilamentAuthenticationLog;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentAuthenticationLogPlugin implements Plugin
{
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
}
