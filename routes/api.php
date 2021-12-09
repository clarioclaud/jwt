<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogcommentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/redirect', function(){
	// return response()->json([
		// 'status' => 'error',
		// 'message' => 'You Must Login First',
	// ],401);
// })->name('api.login');

Route::group(['middleware' => 'api'], function($router){
	Route::post('/register',[AuthController::class,'Register']);
	Route::post('/login',[AuthController::class,'Login']);
	Route::get('/profile',[AuthController::class,'Profile']);
	Route::post('/logout',[AuthController::class,'Logout']);
});


//// Blog
Route::group(['prefix' => 'blog', 'middleware' => 'auth:api'], function(){
	Route::post('/add', [BlogController::class, 'AddBlog']);
	Route::get('/details', [BlogController::class, 'BlogDetails']);
	Route::put('/update/{id}', [BlogController::class, 'BlogUpdate']);
	Route::delete('/delete/{id}', [BlogController::class, 'BlogDelete']);
});

///blog comment
Route::group(['prefix' => 'blog', 'middleware' => 'api'], function(){
	Route::post('/add/comment', [BlogcommentController::class, 'AddBlogComment']);
	Route::get('/comment/details', [BlogcommentController::class, 'BlogCommentDetails']);
});
