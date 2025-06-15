<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Encuesta extends Model
{
    //

    use SoftDeletes;
    protected $table = 'encuesta';

    protected $fillable = [
        'id_usuario',
        'id_grupo',
        'titulo',
        'objetivo',
        'indicacion',
        'fecha_inicio',
        'fecha_fin',
        'created_by',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function Usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
    public function Grupo(){
        return $this->belongsTo(GrupoMeta::class, 'id_grupo');
    }

    public function preguntas(){
        return $this->hasMany(PreguntaBase::class, 'encuesta_id');
    }
    public function EncuestaRealizada(){
        return $this->hasMany(RealizaEncuesta::class,'id_encuesta');
    }


}
