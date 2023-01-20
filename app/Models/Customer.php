<?php

namespace App\Models;

use App\Models\Attendent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'age',
        'height',
        'weight',
        'phone-number',
        'emergency-phone',
    ];
}
