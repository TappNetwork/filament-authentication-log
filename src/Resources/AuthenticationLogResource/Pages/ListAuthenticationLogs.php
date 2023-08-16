<?php

namespace Tapp\FilamentAuthenticationLog\Resources\AuthenticationLogResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentAuthenticationLog\Resources\AuthenticationLogResource;

class ListAuthenticationLogs extends ListRecords
{
    protected static string $resource = AuthenticationLogResource::class;
}
