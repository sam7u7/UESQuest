<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;


class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        $user = Usuario::where('correo', $request->correo)->first();
        /*if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }*/
        if (!$user) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }
        if ($user->locked_until && Carbon::now()->lessThan($user->locked_until)) {
            return response()->json(['message' => 'Cuenta bloqueada. Se ha enviado una nueva contraseña a su correo.'], 403);
        }
        if (!Auth::attempt(['correo' => $request->correo, 'password' => $request->password])) {
            // Credenciales inválidas
            $user->increment('login_attempts'); // Incrementar intentos fallidos
            $remainingAttempts = 3 - $user->login_attempts;

            if ($user->login_attempts >= 3) {
                // Bloquear la cuenta
                $user->locked_until = Carbon::now()->addMinutes(15); // Bloquear por 15 minutos
                $user->login_attempts = 0; // Resetear intentos después de bloquear

                // Generar nueva contraseña provisional
                $newPassword = Str::random(10);
                $user->password = Hash::make($newPassword);
                $user->save();

                // Enviar la nueva contraseña por correo
                Mail::raw("Su cuenta ha sido bloqueada debido a múltiples intentos fallidos. Su nueva contraseña provisional es: {$newPassword}. Por favor, inicie sesión y cámbiela de inmediato.", function ($message) use ($user) {
                    $message->to($user->correo)
                        ->subject('Su cuenta ha sido bloqueada - Nueva Contraseña Provisional');
                });

                return response()->json(['message' => 'Cuenta bloqueada. Se ha enviado una nueva contraseña a su correo.'], 403);
            }

            $user->save(); // Guardar los intentos fallidos
            return response()->json(['message' => "Credenciales inválidas. Intentos restantes: {$remainingAttempts}"], 401);
        }
        // Inicio de sesión exitoso
        $user->login_attempts = 0; // Resetear intentos
        $user->locked_until = null; // Desbloquear cuenta
        $user->save();

        // Generar token con Sanctum
        $token = $user->createToken('AccesoAPI')->plainTextToken;

        return response()->json([
            'message' => 'Success',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada']);
    }

    public function me(Request $request){
        return response()->json($request->user());
    }
    public function sendProvisionalPassword(Request $request)
    {
        $request->validate(['correo' => 'required|email']);

        $user = Usuario::where('correo', $request->correo)->first();

        // Es importante no revelar si el correo existe o no por seguridad.
        // Siempre devuelve un mensaje genérico de éxito.
        if ($user) {
            // Generar nueva contraseña provisional
            $newPassword = Str::random(10);
            $user->password = Hash::make($newPassword);
            $user->save();
            /*$resend = Resend::client('re_FroE7Tey_LUcCeXnEABaLXcJsb1uYZRZe');

            $resend->emails->send([
                'from' => 'onboarding@resend.dev',
                'to' => $request->correo,
                'subject' => 'Contraseña provisional',
                'html' => '<p>Congrats on sending your <strong>first email</strong>!</p>'
            ]);*/
            // Enviar la nueva contraseña por correo
            Mail::raw("Su nueva contraseña provisional para acceder es: {$newPassword}. Por favor, inicie sesión y cámbiela de inmediato.", function ($message) use ($user) {
                $message->to($user->correo)
                    ->subject('Contraseña Provisional para su Cuenta');
            });
        }

        return response()->json(['message' => 'Si su correo está registrado, recibirá una contraseña provisional en su bandeja de entrada.']);
    }


}
