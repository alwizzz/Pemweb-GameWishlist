<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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



//index
// Route::get('/', [ProductController::class, 'index']);

// //create
// Route::get('/create', [ProductController::class, 'create'])
//     ->middleware('auth');
// Route::post('/create', [ProductController::class, 'store']);

// //read
// Route::get('/detail/{product:slug}', [ProductController::class, 'detail']);

// //update
// Route::get('/edit/{product:slug}', [ProductController::class, 'edit'])
//     ->middleware('auth');
// Route::post('/edit', [ProductController::class, 'update']);

// //delete
// Route::post('/remove', [ProductController::class, 'delete'])
//     ->middleware('auth');

Route::get('/about', function () {
    return view('about', [
        'title' => 'About'
    ]);
});

Route::get('/', function () {
    return redirect('/product');
});

Route::resource('/product', ProductController::class);


Route::get('/login', [UserController::class, 'login'])
    ->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);

Route::get('/register', [UserController::class, 'register'])
    ->middleware('guest');
Route::post('/register', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth');

