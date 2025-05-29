<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    //
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    protected $table = 'usuario';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_rol', //id del rol al que pertenece
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'password',
        'created_by',
    ];
    protected $dates = [

        'deleted_at',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'password',
    ];

    public function hasRol(string $rol): bool
    {
        return $this->id_rol === $rol;
    }

    public function rol(){
        return $this->belongsTo(Rol::class, 'id_rol');
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
