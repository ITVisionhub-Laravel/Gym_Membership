<?php

namespace App\Models;

use App\DB\Core\StringField;
use App\DB\Core\IntegerField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ward extends Model
{
    use HasFactory;
    public function saveableFields(): array
    {
        return [
            'name' => StringField::new(),
            'township_id' => IntegerField::new(),
        ];
    }

    public function street(): HasMany
    {
        return $this->hasMany(Street::class);
    }
    public function township(): BelongsTo
    {
        return $this->belongsTo(Township::class);
    }
}
