<?php

use App\Http\Controllers\VisiteurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FraisController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::POST('/visiteur/initpwds', [ VisiteurController::class,"initPassword"]);

Route::POST('/visiteur/login', [VisiteurController::class,"login"]);

Route::get('/visiteur/logout', [VisiteurController::class, "logout"])->middleware("auth:sanctum");

Route::get('/visiteur/unauth', [VisiteurController::class, "unauthorized"])->name("login");

Route::get('/frais/{idFrais}', [FraisController::class,"listerFrais"])->middleware("auth:sanctum");

Route::POST('/frais/ajout', [FraisController::class, "ajoutFraisJSON"])->middleware("auth:sanctum");

Route::POST('/frais/modif', [FraisController::class, "modifierFraisJSON"])->middleware("auth:sanctum");

Route::DELETE('/frais/suppr', [FraisController::class, "supprimerFraisJSON"])->middleware("auth:sanctum");

Route::GET('/frais/liste/{idVisiteur}',[FraisController::class, "listevisiteur",])->middleware("auth:sanctum");



