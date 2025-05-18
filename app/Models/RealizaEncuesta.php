<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RealizaEncuesta extends Model
{
    //
    use SoftDeletes;

    protected $table = 'realiza_encuesta';
    protected $fillable = [
        'id_usuario',
        'id_encuesta',
        'created_by'
    ];
    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function encuesta(){
        return $this->belongsTo(Encuesta::class);
    }
    public function usuarioRealiza(){
        return $this->belongsTo(Usuario::class);
    }
    public function preguntaRealizaPregunta(){
        return $this->hasMany(RespuestaUsuario::class,'id_realiza_encuesta');
    }
}
