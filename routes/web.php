<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TagController;
use App\Models\SubCategory;
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

Route::get('/search', [FrontendController::class, 'search'])->name('front.search');

Route::get('/single-post/{title}', [FrontendController::class, 'single'])->name('front.single');
Route::get('/all-post', [FrontendController::class, 'all_post'])->name('front.all_post');

Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('front.category');
Route::get('/category/{cat_slug}/{sub_cat_slug}', [FrontendController::class, 'index'])->name('front.sub_category');

Route::get('/tag/{slug}', [FrontendController::class, 'index'])->name('front.tag');


Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [BackendController::class, 'index'])->name('back.index');
    Route::resource('/category', CategoryController::class);
    Route::get('/get-subcategory/{id}', [SubCategoryController::class, 'getCategoryWiseSubCategory']);
    Route::resource('/sub-category', SubCategoryController::class);
    Route::resource('/tag', TagController::class);
    Route::resource('/post', PostController::class);
});

require __DIR__ . '/auth.php';
