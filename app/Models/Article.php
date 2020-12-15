<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function doctors(){
        return $this->belongsTo('App\Models\Doctor','doctor_id');
    }

    public function blogCategories(){
        return $this->belongsTo('App\Models\BlogCategory','category_id');
    }
}
