<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $primaryKey = 'user_id';
    protected $table = 'users';

    protected $fillable = [
        'avatar',
        'username',
        'password',
        'email',
        'gender',
        'phone',
        'birthday',
        'address',
        'role_id',
        'voucher_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }


    public function cart()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function voucher()
    {
        return $this->belongsTo(Vouchers::class, 'voucher_id');
    }

    public function role()
    {
        return $this->belongsTo(role::class, 'role_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }
}
