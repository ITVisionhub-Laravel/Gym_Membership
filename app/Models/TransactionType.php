<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransactionType extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $table = 'transaction_type';

    public function transaction() : HasOne
    {
        return $this->hasOne(DebitAndCredit::class);
    }
}