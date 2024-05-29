<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Customer;
use App\Models\Position;
use App\DB\Core\ImageField;
use App\DB\Core\StringField;
use App\DB\Core\IntegerField;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function saveableFields(): array
    {
        return [
            "name" => StringField::new(),
            "email" => StringField::new(),
            "password" => StringField::new(),
            "age" => IntegerField::new(),
            "gender" => StringField::new(),
            "height" => StringField::new(),
            "weight" => StringField::new(),
            "member_card" => IntegerField::new(),
            "phone_number" => StringField::new(),
            "emergency_phone" => StringField::new(),
            "gym_class_id" => StringField::new(),
            "image" => ImageField::new(),
            "facebook" => StringField::new(),
            "twitter" => StringField::new(),
            "linkedIn" => StringField::new(),
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'email', 'email');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function address(): HasMany
    {
        return $this->hasMany(Address::class);
    }
    public function payment_records() : HasMany
    {
        return $this->hasMany(PaymentRecord::class);
    }

    public function debitCreditInfo(){
        return $this->morphMany(DebitAndCredit::class, 'related_info');
    }
}
