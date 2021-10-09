<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index']);
Route::resource('/blog', PostsController::class);


Auth::routes();
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/post_comment/{slug}', [PostsController::class,'add_comment']);

Route::middleware('auth')->group(function () {

    Route::post('/add_cat', [CategoriesController::class,'store']);
    Route::get('/categories', [CategoriesController::class,'index']);
    Route::post('/cat_delete/{id}', [CategoriesController::class,'destroy']);
    
});





