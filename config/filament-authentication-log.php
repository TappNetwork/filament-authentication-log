<?php

return [

    'resources' => [
        'AutenticationLogResource' => \Tapp\FilamentAuthenticationLog\Resources\AuthenticationLogResource::class,
    ],

    'authenticable-resources' => [
        \App\Models\User::class,
    ],

    'authenticatable' => [
        'field-to-display' => null,
    ],

    'navigation' => [
        'authentication-log' => [
            'register' => true,
            'sort' => 1,
            'icon' => 'heroicon-o-shield-check',
        ],
    ],

    'sort' => [
        'column' => 'login_at',
        'direction' => 'desc',
    ],
];
