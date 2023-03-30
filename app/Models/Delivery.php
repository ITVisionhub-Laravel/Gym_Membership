<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = 'delivery_request';

    protected $fillable = [
        'start_date',
        'end_date',
        'description',
        'product_id',
        'quantity',
        'kg',
        'deli_cost',
        'deli_type_id',
    ];
}
