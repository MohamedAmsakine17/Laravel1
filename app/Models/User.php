<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $directory = 'images/';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'path',
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

    public function setNameAttribute($value){
        $this->attributes['name'] = strtolower($value);
    }
    
    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function getPathAttribute($value)
    {
        return $this->directory . $value;
    }
    
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function Save(){
        return $this->hasOne(Save::class);
    }
}