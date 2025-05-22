<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GrupoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoUsuarioController extends Controller
{
    public function index()
    {
        return response()->json(GrupoUsuario::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grupo_id'   => 'required|integer|exists:grupo_meta,id',
            'usuario_id' => 'required|integer|exists:usuario,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $grupoUsuario = GrupoUsuario::create($request->all());

        return response()->json($grupoUsuario, 201);
    }

    public function show(string $id)
    {
        $grupoUsuario = GrupoUsuario::find($id);

        if (!$grupoUsuario) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        return response()->json($grupoUsuario);
    }

    public function update(Request $request, string $id)
    {
        $grupoUsuario = GrupoUsuario::find($id);

        if (!$grupoUsuario) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'grupo_id'   => 'sometimes|integer|exists:grupo_meta,id',
            'usuario_id' => 'sometimes|integer|exists:usuario,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $grupoUsuario->update($request->all());

        return response()->json($grupoUsuario);
    }

    public function destroy(string $id)
    {
        $grupoUsuario = GrupoUsuario::find($id);

        if (!$grupoUsuario) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        $grupoUsuario->delete();

        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}