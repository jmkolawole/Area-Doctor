<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct(){

        Auth::shouldUse('user');
        Auth::shouldUse('doctor');

     }

    public function index(){
        $articles = Article::with(['doctors'])->get()->toJson(JSON_PRETTY_PRINT);
        return response($articles, 200);
    }

    public function show($slug=null){
        $article = Article::with('doctors')->where('slug', $slug)->first();

        if($article){
         $article = $article->toJson(JSON_PRETTY_PRINT);
         return response($article, 200);
        }
        else{
            return response()->json([
                "message" => "Article not found",
              ], 404);
        }
    }


    public function add(Request $request){

        if(Auth::guard('doctor')->check()){
            $doctor_id = Auth::user()->id;

                $article = new Article;
                $article->doctor_id = $doctor_id;
                $article->blog_category_id = $request->blog_category_id;
                $article->title = $request->title;
                $article->slug = Str::slug($request->title);
                $article->body = $request->body;
                $article->image = $request->image;
                $article->active = $request->active;

                $article->save();

                return response()->json([
                    "message" => "Article Saved Successfully",
                    "article" => $article
                ], 201);
        }else if(Auth::guard('user')->check()){
            return response()->json([
                "message" => "Not allowed to do this",
            ], 201);
        }else{
            return response()->json([
                "message" => "Insufficient Permission",
            ], 201);
        }




       /*



       "doctor_id" : "7",
    "blog_category_id" :"1",
    "title" :"My first post",
    "body" :"This is my first post. Enjoy it",
    "image" :"a.png",
    "active" :"1"
*/


    }


    public function update(Request $request, $slug=null){

        if(Auth::guard('doctor')->check()){
            $article = Article::where('slug', $slug)->first();
            $doctor_id = Auth::user()->id;


            if($article && $article->doctor_id == $doctor_id){
            $article->blog_category_id = is_null($request->blog_category_id) ? $article->blog_category_id : $request->blog_category_id;
            $article->title = is_null($request->title) ? $article->title : $request->title;
            if(!is_null($request->title)){
               $article->title = $request->title;
               $article->slug = $request->slug;
            }
            $article->body = is_null($request->body) ? $article->body : $request->body;
            $article->image = is_null($request->image) ? $article->image : $request->image;
            $article->active = is_null($request->active) ? $article->active : $request->active;

            $article->save();

                return response()->json([
                    "message" => "Article Updated Successfully",
                ], 201);
            }else{
                return response()->json([
                    "message" => "You don't have the permission to edit this article or it does not exist",
                ],'403');

            }

        }else if(Auth::guard('user')->check()){
            return response()->json([
                "message" => "Not allowed to do this",
                "id" => Auth::user()->id
            ], 403);
        }else{
            return response()->json([
                "message" => "Insufficient Permission",
            ], 403);
    }

}


public function delete($slug=null){
    if(Auth::guard('doctor')->check()){
        $article = Article::where('slug', $slug)->first();
        $doctor_id = Auth::user()->id;

        if($article && $article->doctor_id == $doctor_id){

            $article->delete();

            return response()->json([
                "message" => "Article Deleted Successfully",
                "article" => $article
            ], 201);
        }else{
            return response()->json([
                "message" => "You don't have the permission to delete this article or it does not exist",
            ],'403');

        }

    }else if(Auth::guard('user')->check()){
        return response()->json([
            "message" => "Not allowed to do this",
        ], 403);
    }else{
        return response()->json([
            "message" => "Insufficient Permission",
        ], 403);
}

}

}
