<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
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


    public function addCategory(Request $request){

        $blogCategory = new BlogCategory;
        $blogCategory->name = $request->name;
        $blogCategory->slug = Str::slug($blogCategory->name);
        $blogCategory->description = $request->description;
        $blogCategory->save();

            return response()->json([
                "message" => "Category added successfully",
                ], 201);
    }


}
