<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopType extends Model
{
    use HasFactory;
    protected $table = 'shoptypes';

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'hot_line',
        'image',
    ];
}
