<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaysOfWeek extends Model
{
    use HasFactory;
    protected $table = 'days_of_week';

    protected $fillable = [
        'name'
    ];

    public function schedule(){
        return $this->hasMany(GymSchedule::class);
    }
}
