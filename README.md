# Filament Authentication Log

A Filament plugin for [Laravel Authentication Log](https://github.com/rappasoft/laravel-authentication-log) package.

This package provides a Filament resource and a relation manager for [Laravel Authentication Log](https://github.com/rappasoft/laravel-authentication-log).

## Requirements
- PHP 8.0
- [Filament 2](https://github.com/laravel-filament/filament)

## Dependencies
- [rappasoft/laravel-authentication-log](https://github.com/rappasoft/laravel-authentication-log)

## Installation

You can install the plugin via Composer:

```bash
composer require tapp/filament-authentication-log:"^2.0"
```

You can publish the translations files with:

```bash
php artisan vendor:publish --tag="filament-authentication-log-translations"
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-authentication-log-config"
```

That's it! Now you can see the Authentication Log resource on left sidebar.

### Resource appareance

![Filament Authentication Log Resource](https://raw.githubusercontent.com/TappNetwork/filament-authentication-log/main/docs/resource01.png)

![Filament Authentication Log Resource with filters and tooltip](https://raw.githubusercontent.com/TappNetwork/filament-authentication-log/main/docs/resource02.png)


## Using the Relation Manager

Add the `Tapp\FilamentAuthenticationLog\RelationManagers\` to the `getRelations()` method on the Filament resource where the model uses the `AuthenticationLoggable` trait.

E.g. in `App\Filament\Resources\UserResource.php`:

```php
use Tapp\FilamentAuthenticationLog\RelationManagers\AuthenticationLogsRelationManager;
 
public static function getRelations(): array
{
    return [
        AuthenticationLogsRelationManager::class,
        // ...
    ];
}
```

### Relation manager appareance

![Filament Authentication Log Relation Manager](https://raw.githubusercontent.com/TappNetwork/filament-authentication-log/main/docs/relation_manager.png)
