<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopType extends Model
{
    use HasFactory;
    protected $table = 'shop_types';

    protected $fillable = [
        'name',
        'email',
        'address_id',
        'phone',
        'hot_line',
        'image',
    ];
}
