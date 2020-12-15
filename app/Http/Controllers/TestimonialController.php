<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Testimonial;

class TestimonialController extends Controller
{
    //

    public function index(){
        $testimonials = Testimonial::with(['users','doctors'])->get()->toJson(JSON_PRETTY_PRINT);
        return response($testimonials, 200);
    }


    public function show($id=null){
        $testimonial = Testimonial::with(['users','doctors'])->where('id', $id)->first();

        if($testimonial){
         $testimonial = $testimonial->toJson(JSON_PRETTY_PRINT);
         return response($testimonial, 200);
        }
        else{
            return response()->json([
                "message" => "Testimonial not found",
              ], 404);
        }
    }


    public function featured(){
        $testimonials = Testimonial::with(['users','doctors'])->orderBy('id','desc')->take(3)->get()->toJson(JSON_PRETTY_PRINT);
        return response($testimonials, 200);
    }

}
