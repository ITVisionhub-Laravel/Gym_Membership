<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $table = 'trainers';

    protected $fillable = [
        'name',
        'description',
        'fb_name',
        'twitter_name',
        'linkin_name',
        'image',
    ];
    public function class(){
        return $this->belongsTo(GymClass::class, 'id', 'trainer_id');
    }
}
