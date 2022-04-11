<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::get('/login', [\App\Http\Controllers\AccountController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AccountController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [\App\Http\Controllers\AccountController::class, 'logout'])->name('logout');



Route::group(['middleware' => 'account'], function() {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/category-by-id/{id}', [\App\Http\Controllers\HomeController::class, 'filByCategory'])->name('categoryByID');
    Route::resource('/category', CategoryController::class);
    Route::resource('/idea', \App\Http\Controllers\IdeaController::class);
    Route::get('/personal-info/{id}', [\App\Http\Controllers\AccountController::class, 'viewInfo'])->name('viewInfo');
    Route::resource('/idea', \App\Http\Controllers\IdeaController::class);
    Route::post('/idea/comment/{id}', [\App\Http\Controllers\CommentController::class, 'postComment']);
    Route::post('/idea/like-dislike', [\App\Http\Controllers\IdeaController::class, 'likeDislikeIdea'])->name('postLikeDislikeIdea');
    //download
    Route::get('/download-idea/{id}', [\App\Http\Controllers\IdeaController::class, 'downloadIdea'])->name('downloadIdea');
    // download CSV
    Route::get('/download-csv/{id}', [CategoryController::class, 'export_csv'])->name('export_csv');
    //download category document
    Route::get('/download-cate/{id}', [CategoryController::class, 'downloadCate'])->name('downloadCate');
    //user
    Route::group(['prefix'=> 'user'], function(){
        Route::get('/list', [\App\Http\Controllers\AccountController::class, 'listUser'])->name('adminListUser');
        Route::get('/create', [\App\Http\Controllers\AccountController::class, 'createUser'])->name('adminCreateUser');
        Route::post('/create', [\App\Http\Controllers\AccountController::class, 'storeUser'])->name('adminStoreUser');
        Route::get('/edit/{id}', [\App\Http\Controllers\AccountController::class, 'editUser'])->name('adminEditUser');
        Route::put('/edit/{id}', [\App\Http\Controllers\AccountController::class, 'updateUser'])->name('adminUpdateUser');
        Route::get('/delete/{id}', [\App\Http\Controllers\AccountController::class, 'deleteUser'])->name('adminDeleteUser');
    });
});

Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');;
