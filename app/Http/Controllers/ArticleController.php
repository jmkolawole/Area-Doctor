<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Article;

class ArticleController extends Controller
{
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
}
