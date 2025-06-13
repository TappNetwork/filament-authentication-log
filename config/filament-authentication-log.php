<?php

use App\Models\User;
use Tapp\FilamentAuthenticationLog\Resources\AuthenticationLogResource;

return [
    // 'user-resource' => \App\Filament\Resources\UserResource::class,
    'resources' => [
        'AutenticationLogResource' => AuthenticationLogResource::class,
    ],

    'authenticable-resources' => [
        User::class,
    ],

    'authenticatable' => [
        'field-to-display' => null,
    ],

    'navigation' => [
        'authentication-log' => [
            'register' => true,
            'sort' => 1,
            'icon' => 'heroicon-o-shield-check',
            // 'group' => 'Logins',
        ],
    ],

    'sort' => [
        'column' => 'login_at',
        'direction' => 'desc',
    ],
];
