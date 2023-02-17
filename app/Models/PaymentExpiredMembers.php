<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentExpiredMembers extends Model
{
    use HasFactory;

    protected $table = 'payment_expired_members';

    protected $fillable = ['customer_id', 'expired_date'];

    public function expiredMember()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
