<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendent extends Model
{
    use HasFactory;

    protected $table = 'attendents';

    protected $fillable = ['user_id', 'attendent_date'];

    public function member()
    {
        return $this->belongsTo(User::class,'user_id');
    }

   
}
