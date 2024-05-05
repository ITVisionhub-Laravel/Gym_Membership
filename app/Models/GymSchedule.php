<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymSchedule extends Model
{
    use HasFactory;
    protected $table = 'gym_schedule';

    protected $fillable = [
        'hours_From','hours_To','days_of_week_id'
    ];

    public function daysOfWeek()
    {
        return $this->belongsTo(DaysOfWeek::class, 'days_of_week_id', 'id');
    }

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'gym_class_trainer', 'schedule_id', 'trainer_id')->withPivot('gym_class_id');
    }

    public function gymclasses()
    {
        return $this->belongsToMany(GymSchedule::class, 'gym_class_trainer', 'schedule_id', 'gym_class_id')
        ->withPivot('trainer_id');
    }
}
