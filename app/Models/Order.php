<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function status() :BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function deliveryType() :BelongsTo
    {
        return $this->belongsTo(DeliveryType::class);
    }
    public function paymentType() : BelongsTo
    {
        return $this->belongsTo(PaymentProvider::class, 'provider_id', 'id');
    }
}
