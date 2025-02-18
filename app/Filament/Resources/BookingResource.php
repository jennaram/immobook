<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages\CreateBooking;
use App\Filament\Resources\BookingResource\Pages\EditBooking;
use App\Filament\Resources\BookingResource\Pages\ListBookings;
use Filament\Resources\Resource;

class BookingResource extends Resource
{
    protected static ?string $model = \App\Models\Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function getPages(): array
    {
        return [
            'index' => ListBookings::route('/'),
            'create' => CreateBooking::route('/create'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}