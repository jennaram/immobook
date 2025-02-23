<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = ['name', 'description', 'price_per_night', 'address', 'bedrooms'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // Relation avec les favoris
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // Relation avec les utilisateurs qui ont mis cette propriété en favori
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}