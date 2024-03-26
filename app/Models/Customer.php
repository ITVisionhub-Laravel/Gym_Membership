<?php

namespace App\Models;

use App\Models\Attendent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'age',
        'member_card',
        'height',
        'weight',
        'phone_number',
        'emergency_phone',
        'image',
        'address_id',
        'class_id',
    ];
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
    public function payment_records() : BelongsTo
    {
        return $this->belongsTo(PaymentRecord::class, 'id', 'customer_id');
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
