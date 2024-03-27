<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRecord extends Model
{
    use HasFactory;
    protected $table = 'payment_records';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function package()
    {
        return $this->belongsTo(PaymentPackage::class,'payment_package_id','id');
    }
    public function paymentprovider()
    {
        return $this->belongsTo(PaymentProvider::class,'payment_provider_id','id');
    }
}
