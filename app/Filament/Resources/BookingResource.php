<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Réservations';
    protected static ?string $modelLabel = 'réservation';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations de réservation')
                    ->schema([
                        Forms\Components\Select::make('property_id')
                            ->relationship('property', 'title')
                            ->required()
                            ->searchable()
                            ->label('Propriété')
                            ->preload(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('check_in')
                                    ->required()
                                    ->label('Date d\'arrivée')
                                    ->minDate(now())
                                    ->afterStateUpdated(function ($state, $set) {
                                        $set('check_out', Carbon::parse($state)->addDays(1));
                                    }),

                                Forms\Components\DatePicker::make('check_out')
                                    ->required()
                                    ->label('Date de départ')
                                    ->minDate(now()->addDay())
                                    ->after('check_in'),
                            ]),

                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'En attente',
                                'confirmed' => 'Confirmée',
                                'cancelled' => 'Annulée',
                            ])
                            ->required()
                            ->default('pending')
                            ->label('Statut'),
                    ]),

                Forms\Components\Section::make('Détails financiers')
                    ->schema([
                        Forms\Components\TextInput::make('total_price')
                            ->numeric()
                            ->prefix('€')
                            ->label('Prix total')
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('deposit_paid')
                            ->numeric()
                            ->prefix('€')
                            ->label('Acompte versé'),
                    ]),

                Forms\Components\Section::make('Informations client')
                    ->schema([
                        Forms\Components\TextInput::make('guest_name')
                            ->required()
                            ->label('Nom du client'),

                        Forms\Components\TextInput::make('guest_email')
                            ->email()
                            ->required()
                            ->label('Email'),

                        Forms\Components\TextInput::make('guest_phone')
                            ->tel()
                            ->label('Téléphone'),

                        Forms\Components\Textarea::make('special_requests')
                            ->label('Demandes spéciales')
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.title')
                    ->label('Propriété')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('guest_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('check_in')
                    ->label('Arrivée')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('check_out')
                    ->label('Départ')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Prix total')
                    ->money('EUR')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'En attente',
                        'confirmed' => 'Confirmée',
                        'cancelled' => 'Annulée',
                    ]),
                Tables\Filters\Filter::make('check_in')
                    ->form([
                        Forms\Components\DatePicker::make('check_in_from')
                            ->label('Arrivée depuis'),
                        Forms\Components\DatePicker::make('check_in_until')
                            ->label('Arrivée jusqu\'à'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['check_in_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('check_in', '>=', $date),
                            )
                            ->when(
                                $data['check_in_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('check_in', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }
}