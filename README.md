# Filament Authentication Log

![pint](https://github.com/TappNetwork/filament-authentication-log/actions/workflows/pint.yml/badge.svg)

A Filament plugin for [Laravel Authentication Log](https://github.com/rappasoft/laravel-authentication-log) package.

This package provides a Filament resource and a relation manager for [Laravel Authentication Log](https://github.com/rappasoft/laravel-authentication-log).

## Requirements
- PHP 8.1+
- [Filament 3](https://github.com/laravel-filament/filament)

## Dependencies
- [rappasoft/laravel-authentication-log](https://github.com/rappasoft/laravel-authentication-log)

## Version Compatibility

 Filament | Laravel   | Filament Authentication Log
:---------|:----------|:---------------------------
 2.x      | 9.x/10.x  | 2.x
 3.x      | 10.x/11.x | 3.0.x/3.1.x

## Installation

You can install the plugin via Composer:

```bash
composer require tapp/filament-authentication-log:"^3.1"
```

Follow the configuration instruction for [laravel-authentication-log](https://rappasoft.com/docs/laravel-authentication-log/v1/start/configuration)
- Publish and run the migrations
- Add the `AuthenticationLoggable` and `Notifiable` traits to your `User` model

> **Note** 
> For **Filament 2.x** check the **[2.x](https://github.com//TappNetwork/filament-authentication-log/tree/2.x)** branch

You can publish the translations files with:

```bash
php artisan vendor:publish --tag="filament-authentication-log-translations"
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-authentication-log-config"
```

## Using the Resource

Add this plugin to a panel on `plugins()` method. 
E.g. in `app/Providers/Filament/AdminPanelProvider.php`:

```php
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;
 
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            FilamentAuthenticationLogPlugin::make(),
            //...
        ]);
}
```

That's it! Now you can see the Authentication Log resource on left sidebar.

### Resource appearance

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

### Relation manager appearance

![Filament Authentication Log Relation Manager](https://raw.githubusercontent.com/TappNetwork/filament-authentication-log/main/docs/relation_manager.png)
