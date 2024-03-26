<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentProvider extends Model
{
    use HasFactory;

    protected $table = 'payment_providers';

    protected $fillable = ['name','bank_slip'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
