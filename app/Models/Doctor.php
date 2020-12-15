<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;


    public function articles(){
        return $this->hasMany('App\Models\Article');
    }

    public function testimonials(){
        return $this->hasOne('App\Models\Testimonial');
    }



}
