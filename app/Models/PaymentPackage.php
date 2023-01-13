<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPackage extends Model
{
    use HasFactory;
    protected $table = 'payment_packages';

    protected $fillable = ['package', 'promotion'];
}
