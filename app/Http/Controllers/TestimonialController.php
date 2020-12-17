<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    //

    public function __construct(){


        Auth::shouldUse('doctor') ||  Auth::shouldUse('user');



     }


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



    public function add(Request $request){
        if(Auth::guard('doctor')->check()){
                $doctor_id = Auth::user()->id;
                $user_id = null;

                $testimonial = new Testimonial;
                $testimonial->doctor_id = $doctor_id;
                $testimonial->user_id = $request->user_id;
                $testimonial->body = $request->body;

                //$testimonial->save();

                return response()->json([
                    "message" => "Testimonial Doctor Saved Successfully",
                    "testimonial" => $testimonial
                ], 201);

        }else if(Auth::guard('user')->check()){
            $user_id = Auth::user()->id;
            $doctor_id = null;

            $testimonial = new Testimonial;
            $testimonial->doctor_id = $doctor_id;
            $testimonial->user_id = $user_id;
            $testimonial->body = $request->body;

            $testimonial->save();


            return response()->json([
                "message" => "Testimonial User Saved Successfully",
                    "testimonial" => $testimonial
            ], 201);
        }else{
            return response()->json([
                "message" => "Insufficient Permission",
            ], 201);
        }

    }


    public function update(Request $request, $id = null){
        if(Auth::guard('doctor')->check()){
                $doctor_id = Auth::user()->id;
                $user_id = null;

                $testimonial = Testimonial::where('id', $id)->first();
                if($testimonial && $testimonial->doctor_id == $doctor_id){
                    $testimonial->body = is_null($request->body) ? $testimonial->body : $request->body;
                    $testimonial->save();

                    return response()->json([
                        "message" => "Testimonial Updated Successfully",
                        "doctor" => $testimonial
                    ], 201);

                }else{
                    return response()->json([
                        "message" => "You don't have the permission to edit this testimonial or it does not exist",
                    ],403);

                }
            }else if(Auth::guard('user')->check()){
            $user_id = Auth::user()->id;
            $doctor_id = null;

            $testimonial = Testimonial::where('id', $id)->first();
                if($testimonial && $testimonial->user_id == $user_id){
                    $testimonial->body = is_null($request->body) ? $testimonial->body : $request->body;
                    $testimonial->save();

                    return response()->json([
                        "message" => "Testimonial Updated Successfully",
                        "doctor" => $testimonial
                    ], 201);

                }else{
                    return response()->json([
                        "message" => "You don't have the permission to edit this testimonial or it does not exist",
                    ],403);

                }
        }else{
            return response()->json([
                "message" => "Insufficient Permission",
            ], 201);
        }

    }




    public function delete($id=null){
        if(Auth::guard('doctor')->check()){
            $testimonial = Testimonial::where('id', $id)->first();
            $doctor_id = Auth::user()->id;

            if($testimonial && $testimonial->doctor_id == $doctor_id){

                $testimonial->delete();

                return response()->json([
                    "message" => "Testimonial Deleted Successfully",
                    "testimonial" => $testimonial
                ], 201);
            }else{
                return response()->json([
                    "message" => "You don't have the permission to delete this testimonial or it does not exist",
                ],403);

            }

        }else if(Auth::guard('user')->check()){
            $testimonial = Testimonial::where('id', $id)->first();
            $user_id = Auth::user()->id;

            if($testimonial && $testimonial->user_id == $user_id){

                $testimonial->delete();

                return response()->json([
                    "message" => "Testimonial Deleted Successfully",
                    "testimonial" => $testimonial
                ], 201);
            }else{
                return response()->json([
                    "message" => "You don't have the permission to delete this testimonial or it does not exist",
                ],403);

            }
        }else{
            return response()->json([
                "message" => "Insufficient Permission",
            ], 403);
    }

    }




}
