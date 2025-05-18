<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TipoPregunta extends Model
{
    //
    use SoftDeletes;

    protected $table = 'tipo_pregunta';

    protected $fillable = [
        'id_pregunta',
        'tipo_pregunta',
        'indicacion',
        'created_by',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    public function pregunta_base(){
        return $this->belongsTo(PreguntaBase::class);
    }
    public function TipoRespuesta(){
        return $this->hasMany(TipoRespuesta::class,'id_tipo_pregunta');
    }
    public function RespuestaTipoPregunta(){
        return $this->hasMany(RespuestaUsuario::class,'id_pregunta');
    }
}
