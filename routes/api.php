<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//Users
//Get all users



Route::get('/users', [AuthController::class, 'index'])->name('show.users');
Route::get('/users/{slug}', [AuthController::class, 'show'])->name('show.user');



//Testimonials
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('show.testimonials');
Route::get('/testimonials/featured', [TestimonialController::class, 'featured'])->name('feature.testimonials');
Route::get('/testimonials/{id}', [TestimonialController::class, 'show'])->name('show.testimonial');


Route::get('/doctors', [DoctorController::class, 'index'])->name('show.doctors');
Route::get('/doctors/{slug}', [DoctorController::class, 'show'])->name('show.user');


//Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('show.articles');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('show.user');


//Blog Categories
Route::get('/blogCategories', [BlogCategoryController::class, 'index'])->name('show.blogCategories');
Route::get('/blogCategories/{slug}', [BlogCategoryController::class, 'show'])->name('show.blogCategory');

