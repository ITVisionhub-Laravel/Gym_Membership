<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPaymentRecords extends Model
{
    use HasFactory;
    protected $table = 'product_payment_records';
    protected $fillable = [
        'customer_id',
        'product_id',
        'provider_id',
        'quantity',
        'total',
    ];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function paymentType()
    {
        return $this->belongsTo(PaymentProvider::class, 'provider_id', 'id');
    }
}
