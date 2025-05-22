<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GrupoMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(GrupoMeta::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_grupo'      => 'required|string',
            'descripcion_grupo' => 'nullable|string',
            'created_by'        => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $grupoMeta = GrupoMeta::create($request->all());

        return response()->json($grupoMeta, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grupoMeta = GrupoMeta::find($id);

        return response()->json($grupoMeta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $grupoMeta = GrupoMeta::find($id);

        if (!$grupoMeta) {
            return response()->json(['error' => 'grupo_meta no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_grupo'      => 'required|string',
            'descripcion_grupo' => 'nullable|string',
            'created_by'        => 'sometimes|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $grupoMeta->update($request->all());

        return response()->json($grupoMeta, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grupoMeta = GrupoMeta::find($id);

        if (!$grupoMeta) {
            return response()->json(['error' => 'grupo_meta no encontrado'], 404);
        }

        $grupoMeta->delete();

        return response()->json(['message' => 'grupo_meta eliminado', 200]);
    }
}