<?php

namespace App\Models;

use App\Models\GymSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GymClass extends Model
{
    use HasFactory;
    protected $table='gym_classes';

    protected $guard=[
        'id'
    ];
    public function gymSchedules()
    {
        return $this->belongsTo(GymSchedule::class, 'schedule_id', 'id');
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }
}
