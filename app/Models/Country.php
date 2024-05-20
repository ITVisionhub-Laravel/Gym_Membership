<?php

namespace App\Models;

use App\Db\Core\StringField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    public function saveableFields(): array
    {
        return [
            'name' => StringField::new(),
        ];
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
