<?php

namespace App\Models;

use App\Traits\FilterableByDatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Expenses extends Model
{
    use HasFactory, FilterableByDatesTrait;
    protected $table = 'expenses';

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