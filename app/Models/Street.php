<?php

namespace App\Models;

use App\Db\Core\StringField;
use App\Db\Core\IntegerField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Street extends Model
{
    use HasFactory;

    protected $table = 'streets';
    public function saveableFields(): array
    {
        return [
            'name' => StringField::new(),
            'ward_id' => IntegerField::new(),
        ];
    }

    public function ward():BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }
}
