<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopKeeperRequest extends Model
{
    use HasFactory;
    protected $table = 'shop_keeper_request';

    protected $fillable = ['shop_id', 'status'];
}
