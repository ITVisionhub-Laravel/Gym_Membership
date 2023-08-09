<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'shop_type_id',
        'deli_type_id',
    ];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class, 'deli_type_id', 'id');
    }
    /**
     * Get the shop that owns the ShopKeeperRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shops(): BelongsTo
    {
        return $this->belongsTo(ShopType::class, 'shop_type_id', 'id');
    }
}
