<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
class BlogCategoryController extends Controller
{
    //
    public function index(){
        $blogCategories = BlogCategory::with(['articles'])->get()->toJson(JSON_PRETTY_PRINT);
        return response($blogCategories, 200);
    }

    public function show($slug=null){
        $blogCategory = BlogCategory::with('articles')->where('slug', $slug)->first();

        if($blogCategory){
         $blogCategory = $blogCategory->toJson(JSON_PRETTY_PRINT);
         return response($blogCategory, 200);
        }
        else{
            return response()->json([
                "message" => "Blog Category not found",
              ], 404);
        }
    }
}
