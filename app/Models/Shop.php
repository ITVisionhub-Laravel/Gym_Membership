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
        return $this->belongsTo(Products::class, 'id', 'product_id');
    }
    public function shoptype()
    {
        return $this->belongsTo(ShopType::class, 'id', 'shop_type_id');
    }
}
