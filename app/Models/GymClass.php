<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    use HasFactory;
    protected $table='gym_classes';

    protected $fillable=[
        'name','description','image','day','morning_time','evening_time','trainer_id'
    ];
    public function trainer(){
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }
}
