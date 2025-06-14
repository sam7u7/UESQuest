<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Aunque no lo usaremos directamente en este ejemplo, es buena práctica si expandes.

class EstadoUsuarioController extends Controller
{
    /**
     * Display a listing of all users, including those soft-deleted.
     * This method is specifically for managing user status.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // El trait SoftDeletes en el modelo Usuario ya permite usar withTrashed()
        // para obtener todos los usuarios, incluyendo los que tienen deleted_at no nulo.
        return response()->json(Usuario::withTrashed()->get());
    }

    /**
     * Restore a soft-deleted user.
     *
     * @param string $id The ID of the user to restore.
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(string $id)
    {
        // Buscar el usuario incluyendo los soft-deleted para poder restaurarlo.
        $usuario = Usuario::withTrashed()->find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        // Verificar si el usuario ya está activo (no soft-deleted)
        if (!$usuario->trashed()) {
            return response()->json(['message' => 'El usuario ya está activo.'], 409); // 409 Conflict
        }

        $usuario->restore(); // Esto establece 'deleted_at' a null
        return response()->json($usuario->fresh(), 200); // Retorna el usuario actualizado
    }

    /**
     * Soft delete a user (inactivate).
     *
     * @param string $id The ID of the user to soft delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate(string $id)
    {
        // Busca solo usuarios activos para soft-delete, si ya está inactivo, lanza un 409.
        $usuario = Usuario::find($id);

        if (!$usuario) {
            // Si no se encuentra como activo, verifica si ya está inactivo para dar un mensaje más específico.
            $usuario = Usuario::withTrashed()->find($id);
            if ($usuario && $usuario->trashed()) {
                return response()->json(['message' => 'El usuario ya está inhabilitado.'], 409); // 409 Conflict
            }
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        $usuario->delete(); // Realiza el soft delete
        return response()->json($usuario->fresh(), 200); // Retorna el usuario actualizado con deleted_at
    }
}