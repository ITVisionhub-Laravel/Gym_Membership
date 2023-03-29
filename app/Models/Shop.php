<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $table = 'shop';

    protected $fillable = ['product_id', 'quantity', 'shop_type_id'];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
    public function shoptype()
    {
        return $this->belongsTo(ShopType::class, 'shop_type_id', 'id');
    }
}
