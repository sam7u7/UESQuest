<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RespuestaUsuario extends Model
{
    //
    use SoftDeletes;

    protected $table = 'respuesta_usuario';

    protected $fillable = [
        'respuesta_texto',
        'id_realiza_encuesta',
        'id_pregunta',
        'id_respuesta',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function pregunta(){
        return $this->belongsTo(preguntaBase::class, 'id_pregunta');
    }
    public function respuesta(){
        return $this->belongsTo(TipoRespuesta::class);
    }
    public function realizaEncuesta(){
        return $this->belongsTo(RealizaEncuesta::class);
    }
}
