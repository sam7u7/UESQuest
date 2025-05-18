<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    //
    use SoftDeletes;
    protected $table = 'usuarios';
    protected $fillable = [
        'id_rol',
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'password',
    ];
    protected $dates = [
        'created_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function rolUsuario(){
        return $this->belongsTo(Rol::class);
    }
    public function GrupoUsuarioUsuario(){
        return $this->hasMany(GrupoUsuario::class, 'usuario_id');
    }

    public function UsuarioEncuesta(){
        return $this->hasMany(Encuesta::class,'id_usuario');
    }

    public function EncuestaRealizada(){
        return $this->hasMany(Encuesta::class,'id_usuario');
    }
}
