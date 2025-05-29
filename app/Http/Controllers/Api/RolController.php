<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Rol::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator  = Validator::make($request->all(), [
            'nombre_rol' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //dd(request()->all);
        $rol = Rol::create([
            'nombre_rol' => $request->nombre_rol,
            'created_by' => 'samael',
        ]);


        return response()->json($rol, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $rol = Rol::find($id);
        //if (isset($rol)) return response()->json(['error'=>'rol no encontrado'], 404);
        return response()->json($rol);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $rol = Rol::find($id);
        if (!$rol) return response()->json(['error'=>'rol no encontrado'], 404);

        $rol->updated_at = now(date_default_timezone_get());
        $validator  = Validator::make($request->all(), [
            'nombre_rol' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $rol->update($request->all());
        return response()->json($rol, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $rol = Rol::find($id);
        if (!$rol) return response()->json(['error'=>'rol no encontrado'], 404);

        $rol->delete();
        return response()->json(['messaage' => 'rol eliminado', 200]);
    }
}
