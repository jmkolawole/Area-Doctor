<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //

    public function index(){
        $users = User::with('testimonials')->get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);
    }

    public function show($slug=null){
        $user = User::with('testimonials')->where('slug', $slug)->first();

        if($user){
         $user = $user->toJson(JSON_PRETTY_PRINT);
         return response($user, 200);
        }
        else{
            return response()->json([
                "message" => "User not found",
              ], 404);
        }
    }


}
