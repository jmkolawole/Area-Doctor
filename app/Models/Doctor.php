<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;
//use Illuminate\Database\Eloquent\Model;

class Doctor extends Authenticatable implements JWTSubject
{

    use HasFactory, Notifiable;

    protected $guard = 'doctor';


    protected $fillable = [
        'name',
        'username',
        'slug',
        'phone',
        'address',
        'email',
        'password',
    ];






    public function articles(){
        return $this->hasMany('App\Models\Article');
    }

    public function testimonials(){
        return $this->hasOne('App\Models\Testimonial');
    }

    public function getJWTIdentifier(Type $var = null)
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }



}
