<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoUsuario extends Model
{
    //
    use SoftDeletes;
    protected $table = 'grupos_usuario';
    protected $fillable = [
        'grupo_id',
        'usuario_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function usuarioGrupoUsuario(){
        return $this->belongsTo(Usuario::class);
    }
    public function grupo(){
        return $this->belongsTo(GrupoUsuario::class);
    }

}
