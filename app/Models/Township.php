<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Township extends Model
{
    use HasFactory;

    protected $table = 'townships';

    protected $fillable = ['name','city_id'];

    public function city():BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function ward(): HasMany
    {
        return $this->hasMany(Ward::class);
    }
}
