<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $data['password'] = bcrypt($data['password']);

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
            'correo'   => 'sometimes|email|unique:"usuario",correo,' . $id. ',id',
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only([
            'id_rol', 'nombre', 'apellido', 'telefono', 'correo'
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

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

    public function storeRegularUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'   => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'nullable|string',
            'correo'   => 'required|email|unique:usuario,correo',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $request->only(['nombre', 'apellido', 'telefono', 'correo', 'password']);

        // Encriptar la contraseña
        $data['password'] = bcrypt($data['password']);

        // Agregar valores por defecto
        $data['id_rol'] = 2;
        $data['created_by'] = 'prueba@prueba.com';

        $usuario = Usuario::create($data);

        return response()->json($usuario, 201);
    }
    /**
     * Update the specified resource as regular user.
     */
    public function updateRegularUser(Request $request, string $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'   => 'sometimes|string',
            'apellido' => 'sometimes|string',
            'telefono' => 'sometimes|string',
            'correo'   => 'sometimes|email|unique:usuario,correo,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only(['nombre', 'apellido', 'telefono', 'correo']);

        // Solo encriptar y actualizar la contraseña si viene en la solicitud
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $usuario->update($data);

        return response()->json($usuario, 200);
    }
    /**
     * Display the authenticated user's own resource.
     */
    public function showOwn()
    {
        $usuario = auth()->user();
        return response()->json($usuario);
    }


    public function cambiarPassword(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'password_actual'  => 'required|string',
            'nueva_password'   => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Verifica la contraseña actual
        if (!Hash::check($request->password_actual, $usuario->password)) {
            return response()->json(['error' => 'La contraseña actual es incorrecta.'], 403);
        }

        // Cambia la contraseña
        $usuario->password = bcrypt($request->nueva_password);
        $usuario->save();

        return response()->json(['message' => 'Contraseña actualizada con éxito.'], 200);
    }
}
