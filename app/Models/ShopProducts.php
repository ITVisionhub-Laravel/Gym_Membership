<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopProducts extends Model
{
    use HasFactory;
    protected $table = 'shop_products';

    protected $fillable = ['product_id', 'product_name', 'quantity'];

    /**
     * Get the user that owns the ShopKeeperRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    /**
     * Get the shop that owns the ShopKeeperRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function shops(): BelongsTo
    // {
    //     return $this->belongsTo(ShopType::class, 'shop_type_id', 'id');
    // }
}
