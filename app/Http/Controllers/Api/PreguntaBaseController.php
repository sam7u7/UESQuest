<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreguntaBase;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class PreguntaBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preguntas = PreguntaBase::all();
        return response()->json($preguntas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pregunta' => 'required|string',
            'ponderacion' => 'required|numeric',
            'encuesta_id' => 'required|integer',
            'id_pregunta' => 'required|integer',
            'created_by' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pregunta = PreguntaBase::create($request->all());
        return response()->json($pregunta, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pregunta = PreguntaBase::find($id);

        if (!$pregunta) {
            return response()->json(['error' => 'Sin preguntas todavía'], 404);
        }

        return response()->json($pregunta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pregunta = PreguntaBase::find($id);

        if (!$pregunta) {
            return response()->json(['error' => 'Pregunta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'encuesta_id' => 'required|integer',
            'id_pregunta' => 'required|integer',
            'pregunta' => 'required|string',
            'ponderacion' => 'required|numeric',
            'created_by' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pregunta->update($request->all());
        return response()->json($pregunta, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pregunta = PreguntaBase::find($id);

        if (!$pregunta) {
            return response()->json(['error' => 'Pregunta no encontrada'], 404);
        }

        $pregunta->delete();
        return response()->json(['message' => 'Pregunta eliminada'], 204);
    }
}

