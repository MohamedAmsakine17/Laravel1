<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CartController;

use App\Models\User;

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



Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
*/

Route::get('user', [UserController::class,'index'])->name('profile')->middleware(['auth',]);

Route::delete('user/delete/{id}', [UserController::class,'destroy'])->name('destroyUser')->middleware(['auth',]);

Route::put('user/update/name/{id}',[UserController::class,'updateUsername'])->name('updateUsername')->middleware(['auth',]);

Route::put('user/update/photo/{id}',[UserController::class,'updatePhoto'])->name('updatePhoto')->middleware(['auth',]);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::get('admin/dashboard',[AdminController::class,'index'])->middleware(['auth','admin'])->name('adminDash');
Route::get('admin/users',[AdminController::class,'users'])->middleware(['auth','admin'])->name('adminUsers');
Route::get('admin/articles',[AdminController::class,'articles'])->middleware(['auth','admin'])->name('adminArticles');

Route::delete('admin/delete/user/{id}', [AdminController::class,'destroyUser'])->middleware(['auth','admin']);
Route::post('admin/articles/create/{id}',[AdminController::class,'createArticle'])->middleware(['auth','admin'])->name('createArticle');

/*
|--------------------------------------------------------------------------
| Articles Routes
|--------------------------------------------------------------------------
|
*/
Route::post('upload',[UploadController::class,'store'])->middleware(['auth',]);

Route::resource('article',ArticleController::class)->middleware(['auth']);

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
|
*/

Route::get('panier',[CartController::class,'index'])->name('panier')->middleware('auth');
Route::post('panier/ajouter/{id}',[CartController::class,'create'])->name('ajouterApanier')->middleware('auth');
Route::delete('panier/destroy/{id}',[CartController::class,'destroy'])->name('deleteCart')->middleware('auth');



/* 
|---------------------------------------------------------------------------
| Mail
|---------------------------------------------------------------------------
*/