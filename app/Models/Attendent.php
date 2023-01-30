<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendent extends Model
{
    use HasFactory;

    protected $table = 'attendents';

    protected $fillable = ['customer_id', 'attendent_date'];

    public function member()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
