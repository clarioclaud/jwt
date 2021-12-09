<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogcommentController;
use App\Models\Blog;
use App\Http\Controllers\FrontendController;

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

Route::get('/', function () {
	$blogs = Blog::latest()->get();
    return view('frontend.index',compact('blogs'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'blog','middleware' => 'auth'], function(){
	Route::get('/show',[BlogController::class, 'Blogweb'])->name('blog');
	Route::post('/store',[BlogController::class, 'BlogStore'])->name('blog.store');
	Route::get('/edit/{id}',[BlogController::class, 'BlogEdit'])->name('blog.edit');
	Route::post('/update',[BlogController::class, 'BlogUpdateWeb'])->name('blog.update');
	Route::get('/delete/{id}',[BlogController::class, 'BlogDeleteWeb'])->name('blog.delete');
	Route::get('/comments/show',[BlogcommentController::class, 'BlogCommentsWeb'])->name('blog.comment');
	Route::get('/comments/approve/{id}',[BlogcommentController::class, 'BlogCommentsApprove'])->name('blog.approve');
});

///frontend routes
Route::get('/post/{id}/{title}',[FrontendController::class,'BlogPage']);
Route::post('/comments/post',[FrontendController::class,'CommentSubmit'])->name('submit.comment');
