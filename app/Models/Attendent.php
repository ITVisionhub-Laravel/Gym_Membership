<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendent extends Model
{
    use HasFactory;

    protected $table = 'attendents';

    protected $fillable = ['customer_id', 'attendent_date'];

    public function member()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

   
}
