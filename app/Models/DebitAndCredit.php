<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DebitAndCredit extends Model
{
    use HasFactory;
    protected $table = 'debit_and_credit';
    
    protected $guarded = ['id'];
    
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function relatedInfo(){
        return $this->morphTo();
    }
}