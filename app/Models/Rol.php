<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    //
    use softDeletes;
    protected $table = 'rol';

    protected $fillable = [
        'nombre_rol',
        'created_by',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function usuarios(){
        return $this->hasMany(Usuario::class, 'id_rol');
    }
}
