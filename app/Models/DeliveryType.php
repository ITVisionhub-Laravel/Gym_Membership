<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    use HasFactory;

    protected $table = 'delivery_types';
    protected $fillable = [
        'name',
        'image',
        'kg',
        'township_id',
        'cost',
        'waiting_time',
    ];

    public function township()
    {
        return $this->belongsTo(Township::class, 'township_id', 'id');
    }
}
