<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;

use App\Models\Place;

use App\Http\Controllers\ResetPasswordController;

use App\Models\Review;
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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*Routes de la gestion des incriptions et commentaires*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*Routes Protegés par le middleware*/
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

/*Routes de l'affichage dans les détails d'un lieu'*/
Route::post('/place', [PlaceController::class, 'place']);
Route::get('/post', [PlaceController::class, 'renderPlace']);
Route::get('/show/{id}', [PlaceController::class, 'show']);
Route::put('/edit/{id}', [PlaceController::class, 'edit']);

/*Routes de la gestion des commentaires*/
Route::get('/review', [ReviewController::class, 'renderReview']);

Route::post('/show/{id}', [ReviewController::class, 'review']);
// Route::post('/review', [ReviewController::class, 'review']);
// Route::get('/show/{id}', [PlaceController::class, 'review']);

// Route::prefix('/show')->group(function () {
//     // Route::get('/{id}', [PlaceController::class, 'show']);
//     Route::get('/{id}', [ReviewController::class, 'review'])->name('review');
// });

// Reset Email
Route::post('/send-reset-email', [ResetPasswordController::class, 'sendResetEmail'])->name('password.reset');

// changement mot de passe
// Route::post('/passwordChange', [PasswordChangeController::class, 'changePassword']);
