<?php

namespace Tapp\FilamentAuthenticationLog;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Tapp\FilamentAuthenticationLog\RelationManagers\AuthenticationLogsRelationManager;

class FilamentAuthenticationLogServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-authentication-log';

    protected array $relationManagers = [
        AuthenticationLogsRelationManager::class,
    ];

    public function getResources(): array
    {
        return config('filament-authentication-log.resources');
    }

    public function configurePackage(Package $package): void
    {
        parent::configurePackage($package);

        $package->name('filament-authentication-log')
            ->hasConfigFile('filament-authentication-log')
            ->hasTranslations('filament-authentication-log');
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        //
    }
}
