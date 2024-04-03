<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;
    protected $table = 'logos';
    protected $fillable = [
        'image',
        'name',
        'description',
        'address_id',
        'location',
        'ph_no',
        'email',
        'open_day',
        'open_time',
        'close_day',
    ];
}
