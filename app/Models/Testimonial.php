<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function doctors(){
        return $this->belongsTo('App\Models\Doctor','doctor_id');
    }
}
