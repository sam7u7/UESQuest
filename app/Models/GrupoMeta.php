<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoMeta extends Model
{
    //
    use SoftDeletes;
    protected $table = 'grupo_meta';

    protected $fillable = [
        'nombre_grupo',
        'descripcion_grupo',
        'created_by',
    ];
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function GrupoUsuarioGrupo(){
        return $this->hasMany(GrupoUsuario::class, 'grupo_id');
    }
    public function GrupoMetaEncuesta(){
        return $this->hasMany(Encuesta::class, 'id_grupo');
    }
}
