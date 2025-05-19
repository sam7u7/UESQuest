<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Encuesta;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $encuestas = Encuesta::all();
        return response()->json($encuestas);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'required|integer',
            'id_grupo' => 'required|integer',
            'titulo' => 'required|string',
            'indicacion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $encuesta = Encuesta::create($request->all());
        return response()->json($encuesta, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $encuestas = Encuesta::findOrFail($id);
        return response()->json($encuestas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $encuesta = Encuesta::find($id);
        if (!$encuesta) {
            return response()->json(['error'=>'encuesta no encontrada'], 404);
        }
        $encuesta->updated_at = now(date_default_timezone_get());
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'required|integer',
            'id_grupo' => 'required|integer',
            'titulo' => 'required|string',
            'indicacion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $encuesta->update($request->all());
        return response()->json($encuesta, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $encuesta = Encuesta::find($id);
        if (!$encuesta) return response()->json(['error'=>'encuesta no encontrada'], 404);
        $encuesta->delete();
        return response()->json(['message'=>'encuesta eliminada', 204]);
    }
}
