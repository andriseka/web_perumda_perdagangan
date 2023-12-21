<?php

use App\Http\Controllers\Website\About\AboutController;
use App\Http\Controllers\Website\Activity\ActivityController;
use App\Http\Controllers\Website\Award\AwardController;
use App\Http\Controllers\Website\Bidang\BidangController;
use App\Http\Controllers\Website\Contact\ContactController;
use App\Http\Controllers\Website\Cooperation\CooperationController;
use App\Http\Controllers\Website\Home\HomeController;
use App\Http\Controllers\Website\Kerjasama\KerjasamaController;
use App\Http\Controllers\Website\Post\PostController;
use App\Http\Controllers\Website\Product\ProductController;
use App\Http\Controllers\Website\Report\ReportController;
use App\Http\Controllers\Website\Rkap\RkapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/rkap', [RkapController::class, 'index']);
Route::get('/report', [ReportController::class, 'index']);

Route::prefix('/bidang')->group(function() {
    Route::get('/', [BidangController::class, 'index']);
    Route::get('/detail/{slug}', [BidangController::class, 'detail']);
});

Route::prefix('/award')->group(function() {
    Route::get('/', [AwardController::class, 'index']);
    Route::get('/detail/{slug}', [AwardController::class, 'detail']);
    Route::get('/category/{slug}', [AwardController::class, 'get_by_category']);
});

Route::get('/cooperation/{slug}', [CooperationController::class, 'index']);

Route::prefix('/news')->group(function() {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/detail/{slug}', [PostController::class, 'detail']);
    Route::get('/category/{category_slug}', [PostController::class, 'get_by_category']);
});

Route::get('/about', [AboutController::class, 'index']);

Route::prefix('/product')->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/detail/{slug}', [ProductController::class, 'detail']);
    Route::get('/category/{slug}', [ProductController::class, 'product_category']);

    // search
    Route::get('/search', [ProductController::class, 'search']);
});

Route::get('/contact', [ContactController::class , 'index']);

Route::get('/activity', [ActivityController::class, 'index']);

Route::get('/kerjasama', [KerjasamaController::class ,'index']);
