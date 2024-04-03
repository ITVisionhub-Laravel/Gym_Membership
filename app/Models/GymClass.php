<?php

namespace App\Models;

use App\Models\Trainer;
use App\Models\GymSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GymClass extends Model
{
    use HasFactory;
    protected $table='gym_classes';

    protected $fillable = ['name', 'description', 'gym_class_category_id', 'image'];

    public function classCategory()
    {
        return $this->belongsTo(GymClassCategory::class, 'gym_class_category_id');
    }

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'gym_class_trainer', 'gym_class_id', 'trainer_id')->withPivot('schedule_id');
    }

    public function schedules()
    {
        return $this->belongsToMany(GymSchedule::class, 'gym_class_trainer', 'gym_class_id', 'schedule_id')
        ->withPivot('trainer_id');
    }

}
