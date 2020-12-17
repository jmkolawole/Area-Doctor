<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class DoctorController extends Controller
{

    public function __construct(){
       Auth::shouldUse('doctor');

    }
    //
    public function index(){

        /*if(auth()->guard('doctor')->check()){
        $doctors = Doctor::with(['testimonials','articles'])->get()->toJson(JSON_PRETTY_PRINT);
        return response($doctors, 200);
        }
        */

        if(auth()->guard('user')->check()){
            return response()->json([
                "message" => "User here",

                    ], 201);
        }else if(auth()->guard('doctor')->check()){
            return response()->json([
                "message" => "Doctor here",

                    ], 201);
        }

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

    public function register(Request $request){

        $doctor = new Doctor;
        $doctor->name = $request->name;
        $doctor->username = $request->username;
        $doctor->slug = Str::slug($doctor->username);
        $doctor->phone = $request->phone;
        $doctor->address = $request->address;
        $doctor->email = $request->email;
        $doctor->password = Hash::make($request->password);
        $doctor->save();

            return response()->json([
                "message" => "Registration successful",
                ], 201);
    }

    public function login(Request $request){
        $credentials = $request->only(['email','password']);
        $token = \JWTAuth::attempt($credentials);
         return response()->json([
         "message" => "Login Successful",
         "token"=> $token

             ], 201);
     }


    public function me(){
        if(auth()->guard('user')->check()){
            return response()->json([
                "message" => "User here",

                    ], 201);
        }else if(auth()->guard('doctor')->check()){
            return response()->json([
                "message" => "Doctor here",
                "id" => Auth::user()


                    ], 201);
        }
    }


     public function logout(){
        auth()->guard('doctor')->logout();
        return response()->json([
            "message" => "Logout Successful",
                ], 201);
    }

}
