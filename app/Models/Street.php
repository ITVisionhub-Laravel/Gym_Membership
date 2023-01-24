<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $table = 'streets';

    protected $fillable = ['name','township_id'];

    public function township(){
        return $this->belongsTo(Township::class, 'township_id', 'id');
    }
}
