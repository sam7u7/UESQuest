<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RealizaEncuesta;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class RealizaEncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(RealizaEncuesta::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'required|integer',
            'id_encuesta' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try{
            $realizaEncuesta = RealizaEncuesta::create($request->all());
        }catch(QueryException $e){
            $mensajeError = $e->getMessage();

                return response()->json([
                    'message' => 'Este usuario ya ha realizado esta encuesta.',
                    'details' => $mensajeError
                ], 409);

            return response()->json('mesagge');
        }

        return response()->json($realizaEncuesta,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $realizaEncuesta = RealizaEncuesta::find($id);
        return response()->json($realizaEncuesta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $realizaEncuesta = RealizaEncuesta::find($id);
        if(!$realizaEncuesta)return response()->json(['error'=>'No se encontro prueba realizada']);
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'required|integer',
            'id_encuesta' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'date|after:fecha_inicio',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $realizaEncuesta->update($request->all());
        return response()->json($realizaEncuesta,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $realizaEncuesta = RealizaEncuesta::find($id);
        if(!$realizaEncuesta)return response()->json(['error'=>'No se encontro prueba realizada']);
        $realizaEncuesta->delete();
        return response()->json(['success'=>'Eliminado correctamente.',200]);
    }
}
