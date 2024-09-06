<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuesMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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





Route::get('/hello', function () {
    return 'hello';
});

Route::redirect('/yt', '/hello');

Route::fallback(function () {
    return '404';
});

// Route::get('/hello-again/{name}', function () {
//     return view('hello', ['name' => 'World']);
// });

Route::get('/hello-again/{name?}', function ($name = 'World') {
    return view('hello', ['name' => $name]);
});

Route::get('/hello-again/{name?}/items/{id?}', function ($name = 'World', $id = null) {
    return 'hello ' . $name . ', id ' . $id;
});

Route::get('contro/{name?}', [HelloController::class, 'index']);

Route::get('controller/request', [HelloController::class, 'request']);

Route::get('/index', [InputController::class, 'index']);
Route::post('/index', [InputController::class, 'index']);

Route::post('/store', [InputController::class, 'store']);
Route::post('/request', [InputController::class, 'request']);

Route::post('/merge', [InputController::class, 'merge']);
Route::post('/upload', [FileController::class, 'upload']);
Route::get('/response', [FileController::class, 'response']);
Route::get('/cookie', [CookieController::class, 'setCookie']);


Route::get('/', [HomeController::class, 'home']);

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware(OnlyGuesMiddleware::class);
    Route::post('/login', 'dologin')->middleware(OnlyGuesMiddleware::class);
    Route::post('/dologout', 'dologout')->middleware(OnlyMemberMiddleware::class);
});


Route::controller(TodolistController::class)->middleware(OnlyMemberMiddleware::class)->group(function () {
    Route::get('/todolist', 'todolist');
    Route::post('/todolist', 'addtodo');
    Route::post('/todolist/{id}/delete', 'deletetodo');
});