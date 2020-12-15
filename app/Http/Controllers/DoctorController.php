<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;

class DoctorController extends Controller
{
    //
    public function index(){
        $doctors = Doctor::with(['testimonials','articles'])->get()->toJson(JSON_PRETTY_PRINT);
        return response($doctors, 200);
    }

    public function show($slug=null){
        $doctor = Doctor::with(['testimonials','articles'])->where('slug', $slug)->first();

        if($doctor){
         $doctor = $doctor->toJson(JSON_PRETTY_PRINT);
         return response($doctor, 200);
        }
        else{
            return response()->json([
                "message" => "Doctor not found",
              ], 404);
        }
    }
}
