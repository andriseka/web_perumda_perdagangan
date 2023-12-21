<?php

use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\Ads\AdsController;
use App\Http\Controllers\Award\AwardCategoryController;
use App\Http\Controllers\Award\AwardController;
use App\Http\Controllers\Bidang\BidangController;
use App\Http\Controllers\Cooperation\CooperationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Partner\PartnerController;
use App\Http\Controllers\Post\PostCategoryController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Rkap\RkapController;
use App\Http\Controllers\Slider\SliderController;
use App\Http\Controllers\Struktur\StrukturController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::prefix('/post')->group(function() {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/create', [PostController::class ,'create']);
        Route::post('/store', [PostController::class, 'store']);
        Route::get('/edit/{slug}', [PostController::class, 'edit']);
        Route::patch('/update/{slug}', [PostController::class, 'update']);
        Route::delete('/delete/{slug}', [PostController::class, 'delete']);

        // category
        Route::prefix('/category')->group(function() {
            Route::get('/', [PostCategoryController::class, 'index']);
            Route::post('/store', [PostCategoryController::class, 'store']);
            Route::patch('/update/{slug}', [PostCategoryController::class, 'update']);
            Route::delete('/delete/{slug}', [PostCategoryController::class, 'delete']);
        });
    });

    Route::prefix('/product')->group(function() {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/create', [ProductController::class, 'create']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::get('/edit/{slug}', [ProductController::class, 'edit']);
        Route::patch('/update/{slug}', [ProductController::class, 'update']);
        Route::delete('/delete/{slug}', [ProductController::class, 'delete']);

        Route::prefix('/category')->group(function() {
            Route::get('/', [ProductCategoryController::class, 'index']);
            Route::post('/store', [ProductCategoryController::class, 'store']);
            Route::patch('/update/{slug}', [ProductCategoryController::class, 'update']);
            Route::delete('/delete/{slug}', [ProductCategoryController::class, 'delete']);
        });
    });

    Route::prefix('/rkap')->group(function() {
        Route::get('/', [RkapController::class, 'index']);
        Route::post('/store', [RkapController::class, 'store']);
        Route::patch('/update/{id}', [RkapController::class, 'update']);
        Route::delete('/delete/{year}', [RkapController::class, 'delete']);
    });

    Route::prefix('/award')->group(function() {
        Route::get('/', [AwardController::class, 'index']);
        Route::get('/create', [AwardController::class, 'create']);
        Route::post('/store', [AwardController::class, 'store']);
        Route::get('/edit/{slug}', [AwardController::class, 'edit']);
        Route::patch('/update/{slug}', [AwardController::class, 'update']);
        Route::delete('/delete/{slug}', [AwardController::class, 'delete']);

        // category
        Route::prefix('/category')->group(function() {
            Route::get('/', [AwardCategoryController::class, 'index']);
            Route::post('/store', [AwardCategoryController::class, 'store']);
            Route::patch('/update/{slug}', [AwardCategoryController::class, 'update']);
            Route::delete('/delete/{slug}', [AwardCategoryController::class, 'delete']);
        });
    });

    Route::prefix('/report')->group(function() {
        Route::get('/', [ReportController::class, 'index']);
        Route::post('/store', [ReportController::class, 'store']);
        Route::patch('/update/{id}', [ReportController::class, 'update']);
        Route::delete('/delete/{year}', [ReportController::class, 'delete']);
    });

    Route::prefix('/partner')->group(function() {
        Route::get('/', [PartnerController::class, 'index']);
        Route::post('/store', [PartnerController::class, 'store']);
        Route::patch('/update/{slug}', [PartnerController::class, 'update']);
        Route::delete('/delete/{slug}', [PartnerController::class, 'delete']);
    });

    Route::prefix('/bidang')->group(function() {
        Route::get('/', [BidangController::class, 'index']);
        Route::get('/create', [BidangController::class, 'create']);
        Route::post('/store', [BidangController::class, 'store']);
        Route::get('/edit/{slug}', [BidangController::class, 'edit']);
        Route::patch('/update/{slug}', [BidangController::class, 'update']);
        Route::delete('/delete/{slug}', [BidangController::class, 'delete']);
    });

    Route::prefix('/slider')->group(function() {
        Route::get('/', [SliderController::class, 'index']);
        Route::post('/store', [SliderController::class, 'store']);
        Route::delete('/delete/{id}', [SliderController::class, 'delete']);
    });

    Route::prefix('/ads')->group(function() {
        Route::get('/', [AdsController::class, 'index']);
        Route::post('/store', [AdsController::class, 'store']);
        Route::patch('/update/{slug}', [AdsController::class, 'update']);
        Route::delete('/delete/{slug}', [AdsController::class, 'delete']);
    });

    Route::prefix('/cooperation')->group(function() {
        Route::get('/', [CooperationController::class, 'index']);
        Route::get('/create', [CooperationController::class, 'create']);
        Route::post('/store', [CooperationController::class, 'store']);
        Route::get('/edit/{slug}', [CooperationController::class, 'edit']);
        Route::patch('/update/{slug}', [CooperationController::class, 'update']);
        Route::delete('/delete/{slug}', [CooperationController::class, 'delete']);
    });

    Route::prefix('/activity')->group(function() {
        Route::get('/', [ActivityController::class, 'index']);
        Route::post('/store', [ActivityController::class, 'store']);
        Route::patch('/update/{id}', [ActivityController::class, 'update']);
        Route::delete('/delete/{id}', [ActivityController::class, 'delete']);
    });

    Route::prefix('/organisasi')->group(function() {
        Route::get('/', [StrukturController::class ,'index']);
        Route::post('/store', [StrukturController::class, 'store']);
        Route::patch('/update/{id}', [StrukturController::class, 'update']);
        Route::delete('/delete/{id}', [StrukturController::class, 'delete']);
    });
});
