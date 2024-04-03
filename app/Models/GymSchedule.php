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
}
