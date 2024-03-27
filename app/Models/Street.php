<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Street extends Model
{
    use HasFactory;

    protected $table = 'streets';

    protected $fillable = ['name','township_id'];

    public function ward():BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }
}
