<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRecord extends Model
{
    use HasFactory;
    protected $table = 'payment_records';

    protected $fillable = ['price','package_id','date','provider_id','customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function package()
    {
        return $this->belongsTo(PaymentPackage::class, 'package_id','id');
    }
    public function paymentprovider()
    {
        return $this->belongsTo(PaymentProvider::class, 'provider_id','id');
    }
}