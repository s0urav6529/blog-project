<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TagController;
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

Route::get('/', [FrontendController::class, 'index'])->name('front.index');
Route::get('/single-post', [FrontendController::class, 'single'])->name('front.single');

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [BackendController::class, 'index'])->name('back.index');
    Route::resource('/category', CategoryController::class);
    Route::resource('/tag', TagController::class);
});

require __DIR__ . '/auth.php';
