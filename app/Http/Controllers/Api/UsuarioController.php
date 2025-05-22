<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Usuario::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_rol'   => 'required|integer|exists:rol,id',
            'nombre'   => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'nullable|string',
            'correo'   => 'required|email|unique:"usuario",correo',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Puedes agregar aquí el hash del password si es necesario
        $data = $request->all();
        // $data['password'] = bcrypt($data['password']); // Descomenta si quieres hashear

        $usuario = Usuario::create($data);

        return response()->json($usuario, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'usuario no encontrado'], 404);
        }
        return response()->json($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_rol'   => 'sometimes|integer|exists:rol,id',
            'nombre'   => 'sometimes|string',
            'apellido' => 'sometimes|string',
            'telefono' => 'sometimes|string',
            'correo'   => 'sometimes|email|unique:"usuario",correo,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        // $data['password'] = bcrypt($data['password']); // Descomenta si quieres hashear

        $usuario->update($data);

        return response()->json($usuario, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'usuario no encontrado'], 404);
        }

        $usuario->delete();
        return response()->json(['message' => 'usuario eliminado'], 200);
    }
}
