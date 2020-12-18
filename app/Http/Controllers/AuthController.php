<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;




class AuthController extends Controller
{

    //use RegistersUsers;
    //
    public function __construct(){
        Auth::shouldUse('user');
        //$this->middleware('guest')->except('logout');
       //$this->middleware('guest:user')->except('logout');
        //$this->middleware('guest:doctor')->except('logout');


    }

    public function index(){
        if (Auth::guard('user')->check()){
            $users = User::with('testimonials')->get()->toJson(JSON_PRETTY_PRINT);
            return response($users, 200);
        }

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


    public function register(Request $request){

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->slug = Str::slug($user->username);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

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

             ], 201)->header('Authorization',$token);
     }
     public function me(){
        // if(auth()->guard('users')->check()){
            //auth()->user()->id,
             if(auth()->guard('user')->check()){
                 return response()->json([
                     "message" => "User here",
                     "id" => Auth::user()

                         ], 201);
             }else if(auth()->guard('doctor')->check()){
                 return response()->json([
                     "message" => "Doctor here",
                         ], 201);
             }
             }


     public function logout(){
        auth()->guard('user')->logout();
        return response()->json([
            "message" => "Logout Successful",
                ], 201);
    }

    public function refresh(){
        if($token = $this->guard('user')->refresh()){
            return response()->jsonjson([
                "message" => "Successful",
                    ], 201)->header('Authorization',$token);

        }else{
            return response()->json([
              'error' => 'refresh token error'
            ],401);
        }
    }


}
