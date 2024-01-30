<?php

namespace Tapp\FilamentAuthenticationLog\Resources\AuthenticationLogResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentAuthenticationLog\Resources\AuthenticationLogResource;

class ListAuthenticationLogs extends ListRecords
{
    public static function getResource(): string
    {
        return config('filament-authentication-log.resources.AutenticationLogResource', AuthenticationLogResource::class);
    }
}
