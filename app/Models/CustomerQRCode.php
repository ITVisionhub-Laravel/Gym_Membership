<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerQRCode extends Model
{
    use HasFactory;
    protected $table = '_qrcode';

    protected $fillable = ['member_card_id', 'user_id'];

    public function memberId()
    {
        return $this->belongsTo(
            User::class,
            'member_card_id',
            'member_card'
        );
    }
}
