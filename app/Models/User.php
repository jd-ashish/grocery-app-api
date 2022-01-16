<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'plateform',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUserDetails(){
        return $this->hasOne(UserDetails::class);
    }
    public function getAddress(){
        return $this->hasMany(UserAddress::class);
    }
    public function getNotification(){
        return $this->hasMany(Notification::class)->where("viewed",0)->orderBy('id','desc');
    }
    public function customer()
    {
    return $this->hasOne(Customer::class);
    }
    public function Sope()
    {
    return $this->hasOne(Sope::class);
    }

    public function products()
    {
    return $this->hasMany(Product::class);
    }
    public function carts()
    {
    return $this->hasMany(Carts::class);
    }
}
