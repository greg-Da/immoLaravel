<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'surface',
        'nmbRoom',
        'floor',
        'nmbBedroom',
        'floorCount',
        'price',
        'address',
        'zipCode',
        'sold',
        'city_id'
    ];

    public function getSlug(): string{
        return Str::slug($this->title);
    }

    public function getFormattedPrice(): string{
        return number_format($this->price, thousands_separator: '  ') . '€';
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }
}
