<?php

use App\Http\Controllers\AccompagnantController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TypeChambreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);

Route::apiResource('chambres', ChambreController::class);

// Routes pour les réservations
Route::get('reservations', [ReservationController::class, 'index']); // Liste des réservations
Route::get('reservations/paginated', [ReservationController::class, 'paginated']); // Liste paginée des réservations
Route::get('reservations/count', [ReservationController::class, 'count']); // Compter les réservations
Route::post('reservations', [ReservationController::class, 'store']); // Créer une réservation
Route::get('reservations/{id}', [ReservationController::class, 'show']); // Afficher une réservation spécifique
Route::put('reservations/{id}', [ReservationController::class, 'update']); // Mettre à jour une réservation
Route::delete('reservations/{id}', [ReservationController::class, 'destroy']); // Supprimer une réservation



Route::apiResource('types_chambres', TypeChambreController::class);
Route::apiResource('paiements', PaiementController::class);

Route::apiResource('accompagnants', AccompagnantController::class);

