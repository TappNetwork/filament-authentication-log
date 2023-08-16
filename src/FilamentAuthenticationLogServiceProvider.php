<?php

namespace Tapp\FilamentAuthenticationLog;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentAuthenticationLogServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-authentication-log';

    public function configurePackage(Package $package): void
    {
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
