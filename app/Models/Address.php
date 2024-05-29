<?php

namespace App\Models;

use App\Db\Core\StringField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    public function saveableFields(): array
    {
        return [
            "street_id" => StringField::new(),
            "floor" => StringField::new(),
            "block_no" => StringField::new(),
            "zipcode" => StringField::new(),
            "user_id" => StringField::new()
        ];
    }
    
    public function street(){
        return $this->belongsTo(Street::class, 'street_id', 'id');
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
