<?php

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

Auth::routes([
    'register' => false,
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('data_buruh.create');
Route::get('/view', [App\Http\Controllers\HomeController::class, 'view'])->name('data_buruh.view');
Route::get('/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('data_buruh.edit');
Route::post('/update', [App\Http\Controllers\HomeController::class, 'update'])->name('data_buruh.update');
Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'delete'])->name('data_buruh.delete');