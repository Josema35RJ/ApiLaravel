<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{user}', [UserController::class, 'show']);
    Route::get('/emotions', [EmotionController::class, 'index']);
    Route::get('/getEmotion/{emotion}', [EmotionController::class, 'show']);
    Route::post('/addEmotion', [EmotionController::class, 'store']);
    Route::put('/updateEmotion/{emotion}', [EmotionController::class, 'update']);
    Route::delete('/deleteEmotion/{emotion}', [EmotionController::class, 'destroy']);
});
