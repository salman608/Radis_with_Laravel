<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('/blogs', [BlogController::class, 'blogs'])->name('blogs');
Route::get('/blog-edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blog-update/{id}', [BlogController::class, 'update'])->name('blog.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
