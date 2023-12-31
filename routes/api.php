<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Places
Route::get('/post', [PlaceController::class, 'renderPlace']);
// Route::post('/post', [PlaceController::class, 'create']);
// Route::post('/post/{id}', [PlaceController::class, 'show']);
// Route::post('/post', [PlaceController::class, 'store']);
// Route::put('/post', [PlaceController::class, 'edit']);
// Route::post('/post', [PlaceController::class, 'update']);
// Route::delete('/post', [PlaceController::class, 'destroy']);

// Route::resource('/post', PlaceController::class);
Route::post('/post', [PlaceController::class, 'place']);

// ======> AVIS / COMMENTAIRE / REVIEW
Route::post('/review', [AuthController::class, 'review']);
