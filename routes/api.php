<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LearningPathController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\LearningPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::get('learning-paths', [LearningPathController::class, 'index']);
Route::post('learning-path', [LearningPathController::class, 'create']);
Route::put('learning-path/{id}', [LearningPathController::class, 'update']);
Route::delete('learning-path/{id}', [LearningPathController::class, 'destroy']);

Route::get('courses', [CourseController::class, 'index']);
Route::post('course', [CourseController::class, 'create']);
Route::put('course/{id}', [CourseController::class, 'update']);

Route::get('products', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::get('products/search/{name}', [ProductController::class, 'search']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('logout', [UserController::class, 'logout']);

    Route::post('product', [ProductController::class, 'store']);
    Route::put('product/{id}', [ProductController::class, 'update']);
    Route::delete('product/{id}', [ProductController::class, 'destroy']);
});