<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreguntaBase extends Model
{
    //
    use SoftDeletes;
    protected $table = 'pregunta_base';
    protected $fillable = [
        'encuesta_id',
        'id_pregunta',
        'pregunta',
        'ponderacion',
        'created_by'
    ];
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function encuesta(){
        return $this->belongsTo(Encuesta::class);
    }
    public function TipoPregunta(){
        return $this->hasMany(TipoPregunta::class,'id_pregunta');
    }
    public function respuestaUsuario(){
        return $this->hasMany(RespuestaUsuario::class,'id_pregunta');
    }
}
