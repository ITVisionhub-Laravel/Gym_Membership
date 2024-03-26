<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClassCategory extends Model
{
    use HasFactory;
    protected $table = 'class_category';

    protected $guard = [
        'id'
    ]; 
}
