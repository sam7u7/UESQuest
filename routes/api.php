<?php

use App\Http\Controllers\Api\EncuestaController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\GrupoMetaController;
use App\Http\Controllers\Api\RealizaEncuestaController;
use App\Http\Controllers\Api\RespuestaUsuarioController;
use App\Http\Controllers\Api\PreguntaBaseController;
use App\Http\Controllers\Api\TipoPreguntaController;
use App\Http\Controllers\Api\TipoRespuestaController;
use App\Http\Controllers\Api\EstadoUsuarioController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\GrupoUsuarioController;



//ruta para login
Route::post('/login',[AuthController::class,'login']);
//ruta para envio de contraseña
Route::post('/forgot-password', [AuthController::class, 'sendProvisionalPassword']);
//Route::get('/me',[AuthController::class,'me']);
//ruta para logout y obtener informacion del usuario logeado en el sistema
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/me',[AuthController::class,'me']);
    //Route::apiResource('/roles', RolController::class);
    // Obtener datos del usuario autenticado
    Route::get('/usuarios/me', [UsuarioController::class, 'showOwn']);
    Route::get('/mis-encuestas', [EncuestaController::class, 'misEncuestas']);
    Route::get('/usuarios/estado-usuarios', [EstadoUsuarioController::class, 'index']); // Obtener todos (activos e inactivos)
    Route::post('/usuarios/{id}/restaurar', [EstadoUsuarioController::class, 'restore']); // Restaurar un usuario
    Route::delete('/usuarios/{id}/inhabilitar', [EstadoUsuarioController::class, 'deactivate']); // Inhabilitar un usuario (soft delete)
});

//rutas a las que solo puede tener acceso el administrador
Route::middleware(['auth:sanctum', 'rol:Administrador'])->group(function () {
    Route::apiResource('/roles', RolController::class);
    //Route::apiResource('/grupoMeta', GrupoMetaController::class);
    Route::apiResource('/usuarios', UsuarioController::class);
    //Route::apiResource('/encuestas', EncuestaController::class);
});

//rutas a las que solo puede acceder Usuario

Route::middleware(['auth:sanctum', 'rol:Usuario,Administrador'])->group(function () {

});

Route::options('/{any}', function () {
    return response()->json([], 204);
})->where('any', '.*');

//Route::apiResource('/roles', RolController::class);
Route::apiResource('/encuestas', EncuestaController::class);
Route::apiResource('/encuestaRealizada', RealizaEncuestaController::class);
Route::apiResource('/respuestasUsuario', RespuestaUsuarioController::class);

Route::apiResource('/preguntaBase', PreguntaBaseController::class);
Route::get('/preguntaEncuesta',[PreguntaBaseController::class,'preguntaEncuesta']);

//traer todas las encuestas->preguntas->tipo_preguntas
Route::get('/encuestaPregunta',[EncuestaController::class,'encuestaPregunta']);
Route::get('/encuestaPregunta/{id}',[EncuestaController::class,'showEncuestaPregunta']);
//para traer las encuestas con sus preguntas y respuestas
Route::get('/encuestaPreguntaForm/{id}',[EncuestaController::class,'showEncuestaPreguntasRespuestas']);
//para traer las respeustas de usuarios
Route::get('/Encuestas/datos/{id}',[EncuestaController::class,'showEncuestaRespuestas']);

Route::apiResource('/tipoPregunta', TipoPreguntaController::class);
Route::apiResource('/tipoRespuesta', TipoRespuestaController::class);
Route::get('/tipoRespuesta/respuesta/{id}',[TipoRespuestaController::class,'respuestaPregunta']);


Route::apiResource('/grupoUsuario', GrupoUsuarioController::class);
Route::apiResource('/grupoMeta', GrupoMetaController::class);

// Crear usuario como usuario regular (forzado id_rol = 1)
Route::post('/usuarios/usuario', [UsuarioController::class, 'storeRegularUser']);




// Editar usuario regular
Route::put('/usuarios/usuario/{id}', [UsuarioController::class, 'updateRegularUser']);

//editar contraseña
Route::put('/usuarios/{id}/cambiar-password', [UsuarioController::class, 'cambiarPassword']);



//Route::apiResource('/roles', RolController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

