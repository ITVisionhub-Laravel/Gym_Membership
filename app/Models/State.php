<?php

namespace App\Models;

use App\Db\Core\StringField;
use App\Db\Core\IntegerField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;
    public function saveableFields(): array
    {
        return [
            'name' => StringField::new(),
            'country_id' => IntegerField::new(),
        ];
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
