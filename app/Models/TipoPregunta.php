<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TipoPregunta extends Model
{
    //
    use SoftDeletes;

    protected $table = 'tipo_pregunta';
    //protected $primaryKey = 'id';

    protected $fillable = [
        'tipo_pregunta',
        'indicacion',
        'created_by',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    public function preguntaBase(){
        return $this->hasMany(PreguntaBase::class,'id_tipo_pregunta');
    }

    public function RespuestaTipoPregunta(){
        return $this->hasMany(RespuestaUsuario::class,'id_pregunta');
    }
}
