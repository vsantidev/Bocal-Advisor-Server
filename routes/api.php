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

/*Routes inscription/connexion*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*Routes Protegées par le middleware*/
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard']);
    Route::put('dashboard', [AuthController::class, 'updateUser']);

    /*Routes créer/afficher/détails/modifier/supprimer LIEU */
    Route::post('/place', [PlaceController::class, 'place']);
    Route::put('/edit/{id}', [PlaceController::class, 'edit']);
});
Route::delete('/delete/{id}', [PlaceController::class, 'destroy']);
Route::get('/post', [PlaceController::class, 'renderPlace']);
Route::get('/show/{id}', [PlaceController::class, 'show']);

/*Routes de la gestion des commentaires*/
Route::get('/review', [ReviewController::class, 'renderReview']);

Route::post('/show/{id}', [ReviewController::class, 'review']);
Route::delete('/show/{id}', [ReviewController::class, 'deleteReview'])->name('review.destroy');
//Route::post('/show/{id}', [ReviewController::class, 'review']);
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

Route::get('/index', [PlaceController::class, 'index']);


Route::put('/update', [ReviewController::class, 'update']);
