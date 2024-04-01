<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClassCategory extends Model
{
    use HasFactory;
    protected $table = 'gym_class_category';

    protected $fillable = [
        'name','image','description'
    ];
}
