<?php

namespace App\Models;
 
use App\Db\Core\StringField;
use App\Db\Core\IntegerField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    public function saveableFields(): array
    { 
        return [
            'name' => StringField::new(),
            'state_id' => IntegerField::new(),
        ];
    }

    public function townships()
    {
        return $this->hasMany(Township::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
