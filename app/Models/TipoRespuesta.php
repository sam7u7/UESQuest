<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoRespuesta extends Model
{
    //
    use SoftDeletes;

    protected $table = 'tipo_respuesta';
    protected $fillable = [
        'id_pregunta',
        'respuesta',
        'correcta',
        'orden',
        'created_by'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function preguntaBase(){
        return $this->belongsTo(PreguntaBase::class, 'id_pregunta');
    }
    public function preguntaTipoRespuesta(){
        return $this->hasMany(RespuestaUsuario::class,'id_respuesta');
    }
}
