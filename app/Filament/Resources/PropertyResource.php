<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('price_per_night')
                ->required()
                ->numeric()
                ->prefix('€'),
            Forms\Components\Textarea::make('description')
                ->required()
                ->maxLength(65535)
                ->columnSpan('full'),
            Forms\Components\Select::make('status')
                ->options([
                    'available' => 'Disponible',
                    'unavailable' => 'Indisponible',
                    'maintenance' => 'En maintenance',
                ])
                ->required(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('title')
                ->searchable(),
            Tables\Columns\TextColumn::make('price_per_night')
                ->money('EUR'),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'success' => 'available',
                    'danger' => 'unavailable',
                    'warning' => 'maintenance',
                ]),
        ]);
}