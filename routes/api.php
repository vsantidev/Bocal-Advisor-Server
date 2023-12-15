<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard']);
});

// Places
// Route::get('/post', [PlaceController::class, 'index']);
// Route::post('/post', [PlaceController::class, 'create']);
// Route::post('/post/{id}', [PlaceController::class, 'show']);
// Route::post('/post', [PlaceController::class, 'store']);
// Route::put('/post', [PlaceController::class, 'edit']);
// Route::post('/post', [PlaceController::class, 'update']);
// Route::delete('/post', [PlaceController::class, 'destroy']);

Route::post('/place', [PlaceController::class, 'place']);
Route::get('/post', [PlaceController::class, 'renderPlace']);
Route::get('/show/{id}', [PlaceController::class, 'show']);
// ======> AVIS / COMMENTAIRE / REVIEW
Route::post('/review', [ReviewController::class, 'review']);
Route::get('/review', [ReviewController::class, 'renderReview']);

// Reset Email
Route::post('/send-reset-email', [ResetPasswordController::class, 'sendResetEmail'])->name('password.reset');

// changement mot de passe
Route::post('/passwordChange', [PasswordChangeController::class, 'changePassword']);