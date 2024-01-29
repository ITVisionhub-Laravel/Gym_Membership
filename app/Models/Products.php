<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'small_description',
        'description',
        'buying_price',
        'selling_price',
        'quantity',
        'image',
    ];
    
    public function orderDetail(): HasOne
    {
        return $this->hasOne(OrderDetail::class);
    }
}