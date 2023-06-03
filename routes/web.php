<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DownloadMediaController;
use App\Http\Controllers\PaymentController;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\PinController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
*/

Route::get('user', [UserController::class, 'index'])->name('profile')->middleware(['auth', 'verified']);

Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('destroyUser')->middleware(['auth', 'verified']);

Route::put('user/update/name/{id}', [UserController::class, 'updateUsername'])->name('updateUsername')->middleware(['auth', 'verified']);

Route::put('user/update/password/{id}', [UserController::class, 'updatePassword'])->name('updatePassword')->middleware(['auth', 'verified']);

Route::put('user/update/photo/{id}', [UserController::class, 'updatePhoto'])->name('updatePhoto')->middleware(['auth', 'verified']);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('adminDash');
Route::get('admin/users', [AdminController::class, 'users'])->middleware(['auth', 'admin'])->name('adminUsers');
Route::get('admin/trash', [AdminController::class, 'trash'])->middleware(['auth', 'admin'])->name('adminTrashed');
Route::get('admin/articles', [AdminController::class, 'articles'])->middleware(['auth', 'admin'])->name('adminArticles');

Route::post('admin/articles/pin/{id}', [PinController::class, 'create'])->middleware(['auth', 'admin'])->name('adminPins');

Route::delete('admin/delete/user/{id}', [AdminController::class, 'destroyUser'])->middleware(['auth', 'admin']);
Route::post('admin/articles/create/{id}', [AdminController::class, 'createArticle'])->middleware(['auth', 'admin'])->name('createArticle');

/*
|--------------------------------------------------------------------------
| Articles Routes
|--------------------------------------------------------------------------
|
*/
Route::post('upload', [UploadController::class, 'store'])->middleware(['auth', 'verified']);
Route::resource('article', ArticleController::class)->middleware('verified');
Route::get('/articles/{category}/{filter}/{n}', [App\Http\Controllers\HomeController::class, 'articlesByCatg'])->name("articles")->middleware('verified');
Route::get('/articles/{filter}/{n}', [App\Http\Controllers\HomeController::class, 'articles'])->name("allarticles")->middleware('verified');
Route::get('/articles/', [App\Http\Controllers\HomeController::class, 'search'])->name("search")->middleware('verified');

/* 
|---------------------------------------------------------------------------
| Comments
|---------------------------------------------------------------------------
*/

Route::post('/comment/{id}', [CommentController::class, "create"])->middleware(['auth', 'verified'])->name("comment");
Route::delete('/comment/delete/{id}', [CommentController::class, "destroy"])->middleware(['auth', 'verified'])->name("comment_delete");

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
|
*/

Route::get('panier', [CartController::class, 'index'])->name('panier')->middleware(['auth', 'verified']);
Route::post('panier/ajouter/{id}', [CartController::class, 'create'])->name('ajouterApanier')->middleware(['auth', 'verified']);
Route::delete('panier/destroy/{id}', [CartController::class, 'destroy'])->name('deleteCart')->middleware(['auth', 'verified']);



/* 
|---------------------------------------------------------------------------
| Saves
|---------------------------------------------------------------------------
*/

Route::get('/saves', [SaveController::class, 'index'])->middleware(['auth', 'verified'])->name("saves");
Route::post('/save/{id}', [SaveController::class, 'create'])->middleware(['auth', 'verified'])->name("saveArticle");
Route::delete('/save/delete/{id}', [SaveController::class, 'destroy'])->middleware(['auth', 'verified'])->name("deleteSave");




/* 
|---------------------------------------------------------------------------
| Paypal
|---------------------------------------------------------------------------
*/

Route::post('pay', [PaymentController::class, 'pay'])->name('payment')->middleware(['auth', 'verified']);
Route::get('success', [PaymentController::class, 'success'])->middleware(['auth', 'verified']);
Route::get('cancel', [PaymentController::class, 'cancel'])->middleware(['auth', 'verified']);

/* 
|---------------------------------------------------------------------------
| Assets
|---------------------------------------------------------------------------
*/

Route::get('assets', [AssetController::class, 'index'])->middleware(['auth', 'verified'])->name('assets');
Route::get('assets/{category}/{n}', [AssetController::class, 'filter'])->middleware(['auth', 'verified'])->name('filter_assets');
Route::get('download/{id}', [DownloadMediaController::class, 'show'])->middleware(['auth', 'verified'])->name('download');