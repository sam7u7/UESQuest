<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RespuestaUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RespuestaUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(RespuestaUsuario::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $respuestas = $request->all();
        foreach ($respuestas as $repuesta) {
           RespuestaUsuario::create([
              'id_realiza_encuesta' => $repuesta['id_realiza_encuesta'],
              'id_pregunta'=>$repuesta['id_pregunta'],
               'id_respuesta'=>$repuesta['id_respuesta'],
               'created_at'=>$repuesta['created_at'],
               'updated_at'=>$repuesta['updated_at'],
               'respuesta_texto'=>$repuesta['respuesta_texto'],
           ]);
        }

        /*$validator = Validator::make($request->all(), [
            'respuesta' => 'string',
            'id_realiza_encuesta' => 'integer',
            'id_pregunta' => 'integer',
            'id_respuesta' => 'integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }*/
        //$Repuesta = RespuestaUsuario::create($request->all());
        return response()->json($respuestas, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $respuesta = RespuestaUsuario::find($id);
        return response()->json($respuesta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $respuesta = RespuestaUsuario::find($id);
        if(!$respuesta) return response()->json(["error" => "Respuesta no encontrada"], 404);
        $validator = Validator::make($request->all(), [
            'respuesta' => 'string',
            'id_realiza_encuesta' => 'integer',
            'id_pregunta' => 'integer',
            'id_respuesta' => 'integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $respuesta->update($request->all());
        return response()->json($respuesta, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $respuesta = RespuestaUsuario::find($id);
        if(!$respuesta) return response()->json(["error" => "Respuesta no encontrada"], 404);
        $respuesta->delete();
        return response()->json(['message' => 'Respuesta eliminada'], 200);
    }
}
