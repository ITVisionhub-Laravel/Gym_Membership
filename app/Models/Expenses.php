<?php

namespace App\Models;

use App\Db\Core\ImageField;
use App\Db\Core\StringField;
use App\Db\Core\IntegerField;
use App\Traits\FilterableByDatesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expenses extends Model
{
    use HasFactory, FilterableByDatesTrait;
    protected $table = 'expenses';
    public function saveableFields(): array
    {
        return [
            'name' => StringField::new(),
            'amount' => StringField::new(),
            'invoice_slip' => ImageField::new(),
            'invoice_id' => IntegerField::new(),
        ];
    }
    
    public function debitAndCredit(): HasOne
    {
        return $this->hasOne(DebitAndCredit::class);
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
}