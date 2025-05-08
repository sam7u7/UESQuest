<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    //
    protected $table = 'usuarios';
    protected $fillable = [
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

    public function rol(){
        return $this->belongsTo(Rol::class);
    }
}
