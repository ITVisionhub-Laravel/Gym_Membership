<?php

namespace App\Models;

use App\Models\GymSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GymClassTrainer extends Model
{
    use HasFactory;
    protected $table = 'gym_class_trainer';

    protected $guard = [
        'id'
    ];
    public function gymSchedules()
    {
        return $this->hasMany(GymSchedule::class, 'schedule_id', 'id');
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }
}
