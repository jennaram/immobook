<?php

namespace App\Filament\Resources;

use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
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
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('price_per_night')
                    ->money('EUR'),
                TextColumn::make('status')
                    ->badge() // Utilisez la méthode badge() sur TextColumn
                    ->colors([
                        'success' => 'available',
                        'danger' => 'unavailable',
                        'warning' => 'maintenance',
                    ]),
            ]);
    }
}
