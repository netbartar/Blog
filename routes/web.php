<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function (){

    Route::middleware('admin')->group(function (){
        Route::resource('categories', CategoryController::class);
        Route::controller(UserController::class)->group(function (){
            Route::get('users','userList')->name('user.index');
            Route::delete('user/{id}','userDelete')->name('user.delete');
        });
        Route::controller(PostController::class)->group(function (){
            Route::delete('post/{id}','postDelete')->name('posts.delete');
            Route::get('post/publish/{id}','postPublish')->name('posts.publish');
        });

        Route::get('comments',[CommentController::class,'commentList'])->name('comment.index');
    });

    Route::controller(PostController::class)->group(function (){

        Route::name('posts.')->group(function (){
            Route::get('post/create','createPost')->name('create');
            Route::post('post/store','storePost')->name('store');
            Route::get('posts','postList')->name('index');
            Route::get('post/{id}','postDetails')->name('show');
            Route::get('post/{id}/edit','postEdit')->name('edit');
            Route::put('post/{id}','postUpdate')->name('update');
            Route::get('posts/other','postOtherList')->name('other');
        });
    });

    Route::controller(CommentController::class)->group(function (){

        Route::get('comment/create/{id}','commentCreate')->name('comment.create');
        Route::post('comment/store','storeComment')->name('comment.store');
        Route::delete('comment/{id}','commentDelete')->name('comment.delete');
        Route::get('comment/{id}','commentApprove')->name('comment.approve');
    });
});











