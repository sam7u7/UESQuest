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
});

//rutas a las que solo puede tener acceso el administrador
Route::middleware(['auth:sanctum', 'rol:Administrador'])->group(function () {
    Route::apiResource('/roles', RolController::class);
    //Route::apiResource('/grupoMeta', GrupoMetaController::class);
    Route::apiResource('/usuarios', UsuarioController::class);
    Route::apiResource('/encuestas', EncuestaController::class);
});

//rutas a las que solo puede acceder Usuario

Route::middleware(['auth:sanctum', 'rol:Usuario,Administrador'])->group(function () {

});

Route::options('/{any}', function () {
    return response()->json([], 204);
})->where('any', '.*');

//Route::apiResource('/roles', RolController::class);
//Route::apiResource('/encuestas', EncuestaController::class);
Route::apiResource('/encuestaRealizada', RealizaEncuestaController::class);
Route::apiResource('/respuestasUsuario', RespuestaUsuarioController::class);

Route::apiResource('/preguntaBase', PreguntaBaseController::class);
Route::apiResource('/tipoPregunta', TipoPreguntaController::class);
Route::apiResource('/tipoRespuesta', TipoRespuestaController::class);


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

