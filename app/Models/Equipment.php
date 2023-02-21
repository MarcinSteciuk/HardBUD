<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class equipment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'beds_amount', 'offer_id', 'deleted'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
