<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = ['user_id', 'property_id', 'check_in', 'check_out', 'total_price'];

    // Utiliser $casts pour convertir les colonnes en objets Carbon
    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}