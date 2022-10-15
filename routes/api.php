<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes 
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/ 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blog/{id}', [BlogController::class, 'show']);
    Route::post('/blog/store', [BlogController::class, 'store']);
    Route::post('/blog/{blog}/update', [BlogController::class, 'update']);
    Route::post('/blog/{blog}/destroy', [BlogController::class, 'destroy']);
    


    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/category/{category}', [CategoryController::class, 'show']);
    Route::post('/category/store', [CategoryController::class, 'store']);
    // Route::post('/category/create', [CategoryController::class, 'create']);
    Route::post('/category/{category}/update', [CategoryController::class, 'update']);
    Route::post('/category/{category}/destroy', [CategoryController::class, 'destroy']);
    
});