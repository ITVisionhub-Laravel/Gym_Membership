<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;
    
    public function debitAndCredit(): HasOne
    {
        return $this->hasOne(DebitAndCredit::class);
    }
    
}