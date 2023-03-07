<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['customer_id', 'product_id', 'quantity', 'total'];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
