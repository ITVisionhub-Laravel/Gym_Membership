<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPaymentRecords extends Model
{
    use HasFactory;
    protected $table = 'product_payment_records';
    protected $fillable = [
        'user_id',
        'product_id',
        'provider_id',
        'quantity',
        'total',
    ];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function paymentType()
    {
        return $this->belongsTo(PaymentProvider::class, 'provider_id', 'id');
    }
}
