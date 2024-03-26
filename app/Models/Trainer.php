<?php

namespace App\Models;

use App\Models\GymClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function gymClasses()
    {
        return $this->belongsToMany(GymClass::class, 'gym_class_trainer', 'trainer_id', 'gym_class_id')->withPivot('schedule_id');
    }
}
