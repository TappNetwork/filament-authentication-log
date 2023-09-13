<?php

namespace Tapp\FilamentAuthenticationLog\Resources;

use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;
use Tapp\FilamentAuthenticationLog\Resources\AuthenticationLogResource\Pages;

class AuthenticationLogResource extends Resource
{
    protected static ?string $model = AuthenticationLog::class;

    public static function shouldRegisterNavigation(): bool
    {
        return config('filament-authentication-log.navigation.authentication-log.register', true);
    }

    public static function getNavigationIcon(): string
    {
        return config('filament-authentication-log.navigation.authentication-log.icon');
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-authentication-log.navigation.authentication-log.sort');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-authentication-log::filament-authentication-log.navigation.group');
    }

    public static function getLabel(): string
    {
        return __('filament-authentication-log::filament-authentication-log.navigation.authentication-log.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-authentication-log::filament-authentication-log.navigation.authentication-log.plural-label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\MorphToSelect::make('authenticable')
                    ->types(self::authenticableResources())
                    ->required(),
                Forms\Components\TextInput::make('Ip Address'),
                Forms\Components\TextInput::make('User Agent'),
                Forms\Components\DateTimePicker::make('Login At'),
                Forms\Components\Toggle::make('Login Successful'),
                Forms\Components\DateTimePicker::make('Logout At'),
                Forms\Components\Toggle::make('Cleared By User'),
                Forms\Components\KeyValue::make('Location'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('authenticatable')
                    ->label(trans('filament-authentication-log::filament-authentication-log.column.authenticatable'))
                    ->formatStateUsing(function (?string $state, Model $record) {
                        if (! $record->authenticatable_id) {
                            return new HtmlString('&mdash;');
                        }

                        return new HtmlString('<a href="'.route('filament.'.Filament::getCurrentPanel()->getId().'.resources.'.Str::plural((Str::lower(class_basename($record->authenticatable::class)))).'.edit', ['record' => $record->authenticatable_id]).'" class="inline-flex items-center justify-center hover:underline focus:outline-none focus:underline filament-tables-link text-primary-600 hover:text-primary-500 text-sm font-medium filament-tables-link-action">'.class_basename($record->authenticatable::class).'</a>');
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label(trans('filament-authentication-log::filament-authentication-log.column.ip_address'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_agent')
                    ->label(trans('filament-authentication-log::filament-authentication-log.column.user_agent'))
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    }),
                Tables\Columns\TextColumn::make('login_at')
                    ->label(trans('filament-authentication-log::filament-authentication-log.column.login_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('login_successful')
                    ->label(trans('filament-authentication-log::filament-authentication-log.column.login_successful'))
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('logout_at')
                    ->label(trans('filament-authentication-log::filament-authentication-log.column.logout_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('cleared_by_user')
                    ->label(trans('filament-authentication-log::filament-authentication-log.column.cleared_by_user'))
                    ->boolean()
                    ->sortable(),
                //Tables\Columns\TextColumn::make('location'),
            ])
            ->actions([
                //
            ])
            ->filters([
                Filter::make('login_successful')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('login_successful', true)),
                Filter::make('login_at')
                    ->form([
                        DatePicker::make('login_from'),
                        DatePicker::make('login_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['login_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('login_at', '>=', $date),
                            )
                            ->when(
                                $data['login_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('login_at', '<=', $date),
                            );
                    }),
                Filter::make('cleared_by_user')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('cleared_by_user', true)),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthenticationLogs::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            //
        ];
    }

    public static function authenticableResources(): array
    {
        return config('filament-authentication-log.authenticable-resources', [
            \App\Models\User::class,
        ]);
    }
}
