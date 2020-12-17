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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/



//Users
//Get all users
//Route::get('/users', [AuthController::class, 'index'])->name('show.users');
Route::group(['prefix' => 'users','middleware' => ['assign.guard:user','jwt.auth']], function () {
    Route::get('/', [AuthController::class, 'index'])->name('show.users');
    Route::get('/me', [AuthController::class, 'me'])->name('me.users');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.user');
});

Route::get('/users/{slug}', [AuthController::class, 'show'])->name('show.user');
Route::post('/users/register', [AuthController::class, 'register'])->name('register.user');
Route::post('/users/login', [AuthController::class, 'login'])->name('login.user');


//Doctors

Route::group(['prefix' => 'doctors','middleware' => ['assign.guard:doctor','jwt.auth']], function () {
   //Route::get('/', [DoctorController::class, 'index'])->name('show.doctors');
   Route::get('/me', [DoctorController::class, 'me'])->name('me.doctors');
    Route::get('/logout', [DoctorController::class, 'logout'])->name('logout.doctors');
    //Route::get('/', [DoctorController::class, 'index'])->name('show.doctors');

});

Route::get('/doctors', [DoctorController::class, 'index'])->name('show.doctors');
Route::get('/doctors/{slug}', [DoctorController::class, 'show'])->name('show.user');
Route::post('/doctors/register', [DoctorController::class, 'register'])->name('register.doctor');
Route::post('/doctors/login', [DoctorController::class, 'login'])->name('login.doctor');


//Testimonials
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('show.testimonials');
Route::post('/testimonials', [TestimonialController::class, 'add'])->name('add.testimonial');
Route::get('/testimonials/featured', [TestimonialController::class, 'featured'])->name('feature.testimonials');
Route::put('/testimonials/{id}', [TestimonialController::class, 'update'])->name('update.testimonial');
Route::delete('/testimonials/{id}', [TestimonialController::class, 'delete'])->name('delete.testimonial');


//Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('show.articles');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('show.user');
Route::post('/articles', [ArticleController::class, 'add'])->name('add.article');
Route::put('/articles/{slug}', [ArticleController::class, 'update'])->name('update.article');
Route::delete('/articles/{slug}', [ArticleController::class, 'delete'])->name('delete.article');



//Blog Categories
Route::get('/blogCategories', [BlogCategoryController::class, 'index'])->name('show.blogCategories');
Route::get('/blogCategories/{slug}', [BlogCategoryController::class, 'show'])->name('show.blogCategory');
Route::post('/blogCategories/add', [BlogCategoryController::class, 'addCategory'])->name('add.blogCategory');



