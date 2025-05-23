<?php

use App\Http\Controllers\Api\EncuestaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\GrupoMetaController;
use App\Http\Controllers\Api\RealizaEncuestaController;
use App\Http\Controllers\Api\RespuestaUsuarioController;
use App\Http\Controllers\Api\PreguntaBaseController;
use App\Http\Controllers\Api\TipoPreguntaController;
use App\Http\Controllers\Api\TipoRespuestaController;

use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\GrupoUsuarioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/roles', RolController::class);
Route::apiResource('/encuestas', EncuestaController::class);
Route::apiResource('/encuestaRealizada', RealizaEncuestaController::class);
Route::apiResource('/respuestasUsuario', RespuestaUsuarioController::class);

Route::apiResource('/preguntaBase', PreguntaBaseController::class);
Route::apiResource('/tipoPregunta', TipoPreguntaController::class);
Route::apiResource('/tipoRespuesta', TipoRespuestaController::class);

Route::apiResource('/usuarios', UsuarioController::class);
Route::apiResource('/grupoUsuario', GrupoUsuarioController::class);
Route::apiResource('/grupoMeta', GrupoMetaController::class);

//Route::post('/roles',[RolController::class,'store']);
