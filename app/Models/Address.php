<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable = ['street_id'];

    public function street(){
        return $this->belongsTo(Street::class, 'street_id', 'id');
    }
}
