<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DebitAndCredit extends Model
{
    use HasFactory;
    protected $table = 'debit_and_credits';

    protected $guarded = ['id'];

    // public function transaction(): BelongsTo
    // {
    //     return $this->belongsTo(Transaction::class);
    // }

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function gymMember(): BelongsTo
    {
        return $this->belongsTo(User::class, "related_info_id", "member_card");
    }

    // public function relatedInfo(){
    //     return $this->morphTo();
    // }
}
