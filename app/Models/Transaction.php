<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function debitAndCredit(): HasOne
    {
        return $this->hasOne(DebitAndCredit::class);
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
}