<?php

use App\Http\Controllers\Api\EncuestaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\GrupoMetaController;
use App\Http\Controllers\Api\RealizaEncuestaController;
use App\Http\Controllers\Api\RespuestaUsuarioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/roles', RolController::class);
Route::apiResource('/encuestas', EncuestaController::class);
Route::apiResource('/encuestaRealizada', RealizaEncuestaController::class);
Route::apiResource('/respuestasUsuario', RespuestaUsuarioController::class);
//Route::post('/roles',[RolController::class,'store']);
