<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ward extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function street(): HasMany
    {
        return $this->hasMany(Street::class);
    }
    public function township(): BelongsTo
    {
        return $this->belongsTo(Township::class);
    }
}
