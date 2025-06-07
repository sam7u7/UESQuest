<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoPregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoPreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos = TipoPregunta::all();
        return response()->json($tipos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
         [
            'tipo_pregunta' => 'required|string',
            'indicacion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tipoPregunta = TipoPregunta::create($request->all());
        return response()->json($tipoPregunta, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipoPregunta = TipoPregunta::find($id);

        if (!$tipoPregunta) {
            return response()->json(['error' => 'Tipo de pregunta no encontrada'], 404);
        }

        return response()->json($tipoPregunta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tipoPregunta = TipoPregunta::find($id);

        if (!$tipoPregunta) {
            return response()->json(['error' => 'Tipo de pregunta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [

            'tipo_pregunta' => 'required|string',
            'indicacion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tipoPregunta->update($request->all());
        return response()->json($tipoPregunta, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipoPregunta = TipoPregunta::find($id);

        if (!$tipoPregunta) {
            return response()->json(['error' => 'Tipo de pregunta no encontrada'], 404);
        }

        $tipoPregunta->delete();
        return response()->json(['message' => 'Tipo de pregunta eliminada'], 204);
    }
}

