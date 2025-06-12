<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoRespuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoRespuestaController extends Controller
{
    /**
     * Mostrar todas las respuestas.
     */
    public function index()
    {
        $respuestas = TipoRespuesta::all();
        return response()->json($respuestas);
    }

    public function respuestaPregunta(Request $request){

        //dd($request->id);
        $respuestas = TipoRespuesta::where('id_pregunta',$request->id)->get();
        //dd($respuestas->toArray());
        return response()->json($respuestas);
    }


    /**
     * Almacenar una nueva respuesta.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pregunta' => 'required|integer',
            'respuesta' => 'required|string',
            'correcta' => 'required|boolean',
            'orden' => 'required|integer',
            'otra' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $respuesta = TipoRespuesta::create($request->all());
        return response()->json($respuesta, 201);
    }

    /**
     * Mostrar una respuesta específica.
     */
    public function show(string $id)
    {
        $respuesta = TipoRespuesta::find($id);
        if (!$respuesta) {
            return response()->json(['error' => 'Respuesta no encontrada'], 404);
        }

        return response()->json($respuesta);
    }

    /**
     * Actualizar una respuesta específica.
     */
    public function update(Request $request, string $id)
    {
        $respuesta = TipoRespuesta::find($id);
        if (!$respuesta) {
            return response()->json(['error' => 'Respuesta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_tipo_pregunta' => 'required|integer',
            'respuesta' => 'required|string',
            'correcta' => 'required|boolean',
            'orden' => 'required|integer',
            'otra' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $respuesta->update($request->all());
        return response()->json($respuesta);
    }

    /**
     * Eliminar una respuesta.
     */
    public function destroy(string $id)
    {
        $respuesta = TipoRespuesta::find($id);
        if (!$respuesta) {
            return response()->json(['error' => 'Respuesta no encontrada'], 404);
        }

        $respuesta->delete();
        return response()->json(['message' => 'Respuesta eliminada'], 204);
    }
}
