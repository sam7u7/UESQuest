<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Encuesta;
use App\Models\PreguntaBase;
use App\Models\TipoPregunta;
use App\Models\TipoRespuesta;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Resources\EncuestaResource;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $encuestas = Encuesta::with(['usuario','grupo'])->get();
        return response()->json($encuestas);

    }
    public function encuestaPregunta(){
        $encuestas = Encuesta::with('preguntas.tipoPreguntas')->get();
        return response()->json($encuestas);
    }

    public function showEncuestaPregunta($id)
    {
        /*$encuesta = Encuesta::with(['preguntas.tipoPregunta'])->find($id);

        if (!$encuesta) {
            return response()->json(['message' => 'Encuesta no encontrada'], 404);
        }

        return response()->json($encuesta);*/
        $encuesta[] = Encuesta::find($id);
        $encuesta['preguntas'] = PreguntaBase::where('encuesta_id',$id)->get();
        foreach ($encuesta['preguntas'] as $pregunta) {
            $pregunta['tipo_preguntas'] = TipoPregunta::where('id',$pregunta->id_tipo_pregunta)->get();
        }
        return response()->json($encuesta);
    }

    public function showEncuestaPreguntasRespuestas($id){

        $encuesta[] = Encuesta::find($id);
        $encuesta['preguntas'] = PreguntaBase::where('encuesta_id',$id)->get();
        foreach ($encuesta['preguntas'] as $pregunta) {
            $pregunta['tipo_respuestas'] = TipoRespuesta::where('id_pregunta',$pregunta->id)->get();
            $pregunta['tipo_preguntas'] = TipoPregunta::where('id',$pregunta->id_tipo_pregunta)->get();
        }

        //$encuesta = Encuesta::with('preguntas.tipoRespuesta','preguntas.tipoPregunta')->findOrFail($id);
        return response()->json($encuesta);

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
            'objetivo' => 'required|string',
            'indicacion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'created_by' => 'required|string',
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
            'id_grupo' => 'required|integer',
            'titulo' => 'required|string',
            'objetivo' => 'required|string',
            'indicacion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'created_by' => 'required|string',
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
