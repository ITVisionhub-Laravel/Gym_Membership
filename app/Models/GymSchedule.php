<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymSchedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';

    protected $guard = [
        'id'
    ];

    public function daysOfWeek()
    {
        return $this->belongsTo(DaysOfWeek::class, 'days_of_week_id', 'id');
    }
}
