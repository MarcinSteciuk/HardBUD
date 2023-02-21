<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['name', 'description', 'place', 'image','accommodationType', 'user_id', 'deleted'];

    public function equipments(): HasMany
    {
        return $this->hasMany(equipment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
