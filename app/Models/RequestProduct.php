<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{
    use HasFactory;
    protected $table = 'request_products';

    protected $fillable = ['product_id', 'product_name', 'quantity', 'status'];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    // public function deliveryType()
    // {
    //     return $this->belongsTo(DeliveryType::class, 'deli_type_id', 'id');
    // }

    // public function shops()
    // {
    //     return $this->belongsTo(ShopType::class, 'shop_type_id', 'id');
    // }
}
