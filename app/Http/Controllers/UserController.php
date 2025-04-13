<?php

namespace App\Http\Controllers;

use App\Models\Token_Users;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RolUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Informacion_persona;
use App\Models\Huesped;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Http;
use Faker\Factory as Faker;
use App\Models\access_token;
use App\Models\Usuario;
use App\Mail\RegistrarUsers;
use App\Mail\Acceso_User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use DateTime;
use DateInterval;
use Twilio\Rest\Client;
use App\Models\Partida;
use App\Models\Historial_Partida;
use App\Models\Intento;
use Illuminate\Support\Facades\Cache;


class UserController extends Controller
{
public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'=> 'required|string|max:255',
        'password' => 'required|string|min:8',
        'email' => 'required|string|email|max:255|unique:users',
    ]);
    
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Generar código de verificación de 6 dígitos
    $codigo_verificacion = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    
    $usuario = new User(); 
    $usuario->name = $request->input('name');
    $usuario->password = bcrypt($request->input('password'));
    $usuario->email = $request->input('email');
    $usuario->rol = '1';
    $usuario->estado = 'inactivo';
    $usuario->codigo_verificacion = $codigo_verificacion;
    $usuario->save();

    $verificationUrl = URL::temporarySignedRoute(
        'activar.cuenta', 
        now()->addMinutes(5),
        [
            'email' => $usuario->email
        ]
    );

    try {
        Mail::send('emails.verification', [
            'usuario' => $usuario,
            'codigo' => $codigo_verificacion,
            'url' => $verificationUrl
        ], function($message) use ($usuario) {
            $message->to($usuario->email)
                    ->subject('Activa tu cuenta');
        });
        
        return response()->json([
            'message' => 'Registro exitoso. Se ha enviado un enlace de verificación a tu correo.',
        ], 200);
    } catch (\Exception $e) {
        \Log::error('Error en envío de correo: ' . $e->getMessage());
        return response()->json([
            'message' => 'Error al enviar el correo de verificación',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function verifyEmail(Request $request, $id, $hash, $code)
{
    // Verificar si la firma de la URL es válida
    if (!$request->hasValidSignature()) {
        return view('email-verification-error', [
            'message' => 'El enlace de verificación ha expirado o es inválido.'
        ]);
    }

    $usuario = User::findOrFail($id);

    // Verificar que el hash coincida con el email del usuario
    if (sha1($usuario->email) !== $hash) {
        return view('email-verification-error', [
            'message' => 'El enlace de verificación es inválido.'
        ]);
    }

    // Verificar el código de verificación
    if ($usuario->codigo_verificacion !== $code) {
        return view('email-verification-error', [
            'message' => 'El código de verificación es inválido.'
        ]);
    }

    // Verificar si la cuenta ya está activada
    if ($usuario->estado === 'activo') {
        return view('email-verification-success', [
            'message' => 'Esta cuenta ya está verificada',
            'usuario' => $usuario
        ]);
    }

    // Activar la cuenta
    $usuario->rol = '3';
    $usuario->estado = 'activo';
    $usuario->email_verified_at = now();
    $usuario->codigo_verificacion = null;
    $usuario->save();

    return view('email-verification-success', [
        'message' => 'Cuenta verificada exitosamente',
        'usuario' => $usuario
    ]);
}

public function login(Request $request)
{
    $validator = validator::make($request->all(), [
        'email' => 'required|string|max:255',
        'password' => 'required|string|max:255',
    ]);
    
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $usuario = User::where('email', $request->input('email'))->first();

    if (!$usuario) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
    else if ($usuario->estado == 'inactivo') {
        return response()->json(['message' => 'Usuario inactivo'], 401);
    }
    else if($usuario->estado == 'ban'){
        return response()->json(['message' => 'Usuario deshabilitado'], 401);
    }

    $credentials = $request->only('email', 'password');

    // Agregar claims personalizados
    $customClaims = ['rol' => $usuario->rol];
    
    // Generar token con claims personalizados
    $token = Auth::guard('jwt')->claims($customClaims)->attempt($credentials);

    if (!$token) {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ], 401);
    }

    try {
        \App\Models\LogAuditoria::create([
            'ip' => $request->ip(),
            'fecha' => now(),
            'endpoint' => $request->fullUrl(),
            'rol_id' => $usuario->rol, 
            'method' => $request->method(),
            'id_user' => (string)$usuario->id 
        ]);

        return response()->json([
            'type' => 'bearer',
            'token' => $token,
            'rol' => $usuario->rol
        ], 200);

    } catch (\Exception $e) {
        \Log::error('Error en login: ' . $e->getMessage());
        return response()->json(['error' => 'Error en el servidor'], 500);
    }
}
    public function desabilitarUsuario(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $usuario = User::where('email', $request->input('email'))->first();
        
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        
        $usuario->estado = 'ban';
        $usuario->save();
        
        return response()->json(['message' => 'Usuario deshabilitado'], 200);
    }
    public function mostrarUsuarios($id = null)
    {
        $usuarioAutenticado = auth()->user();
        
        if (!$usuarioAutenticado) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        if ($id) {
            $usuario = User::find($id);
            if (!$usuario) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
            
            if ($usuario->id === $usuarioAutenticado->id) {
                return response()->json(['error' => 'No puedes solicitar tus propios datos por esta ruta'], 403);
            }
            
            return response()->json($usuario, 200);
        }

        $usuarios = User::where('id', '!=', $usuarioAutenticado->id)->get();

        return response()->json($usuarios, 200);
    }
    public function activar_usuario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $usuario = User::where('email', $request->input('email'))->first();
        
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        
        $usuario->estado = 'activo';
        $usuario->save();
        
        return response()->json(['message' => 'Usuario activado'], 200);
    }


    public function cambiarroluser($id){

        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $usuario->rol = '3';
        $usuario->save();

        return response()->json($usuario, 200);
    }

    public function darroluser($id){

        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $usuario->rol = '2';
        $usuario->save();
        return response()->json($usuario, 200);
    }

    public function actualizarUser(Request $request,$id)
    {

        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        return response()->json($usuario, 200);
    }

    public function renviarcodigo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $usuario = User::where('email', $request->email)->first();
        
        if (!$usuario) {
            return back()->with('error', 'No se encontró ninguna cuenta con este correo electrónico.')->withInput();
        }
        
        // Verificar si la cuenta ya está activada
        if ($usuario->estado === 'activo') {
            return back()->with('success', 'Esta cuenta ya está verificada. Puedes iniciar sesión.');
        }
        
        // Verificar límite de tiempo entre reenvíos
        $ultimaActualizacion = $usuario->updated_at;
        $tiempoMinimo = now()->subMinutes(5);
        
        if ($ultimaActualizacion->greaterThan($tiempoMinimo)) {
            $minutosRestantes = now()->diffInMinutes($ultimaActualizacion->addMinutes(5), false);
            
            // Si quedan 0 minutos o menos, permitir el reenvío
            if ($minutosRestantes <= 0) {
                // Continuar con el reenvío
            } else {
                // En lugar de devolver error, mostrar alerta en la misma página
                return back()->with('warning', 'Debes esperar '.$minutosRestantes.' minutos más antes de solicitar otro enlace.')->withInput();
            }
        }
        
        // Generar nuevo código de verificación
        $codigo_verificacion = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $usuario->codigo_verificacion = $codigo_verificacion;
        $usuario->save();
        
        // Generar URL firmada
        $verificationUrl = URL::temporarySignedRoute(
            'activar.cuenta', 
            now()->addMinutes(5),
            [
                'email' => $usuario->email
            ]
        );
    
        try {
            Mail::send('emails.verification', [
                'usuario' => $usuario,
                'codigo' => $codigo_verificacion,
                'url' => $verificationUrl
            ], function($message) use ($usuario) {
                $message->to($usuario->email)
                        ->subject('Activa tu cuenta');
            });
            
            // Mostrar vista de éxito en lugar de redireccionar directamente
            return view('auth.reenvio-exito', [
                'email' => $usuario->email
            ]);
        } catch (\Exception $e) {
            \Log::error('Error en reenvío de correo: ' . $e->getMessage());
            return back()->with('error', 'Error al enviar el correo de verificación. Por favor, intenta de nuevo más tarde.')->withInput();
        }
    }

    public function VerificarCuenta(){

        $usuario = auth()->user();

        return response()->json($usuario, 200);
    }

public function solicitarNuevoToken(Request $request)
{
    $validator = Validator::make($request->all(), [
        'token' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        $data = decrypt($request->token);
        
        $usuario = User::find($data['user_id']);
        
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        
        $ultimaActualizacion = $usuario->updated_at;
        $tiempoMinimo = now()->subMinutes(10);
        
        if ($ultimaActualizacion->greaterThan($tiempoMinimo)) {
            $minutosRestantes = now()->diffInMinutes($ultimaActualizacion->addMinutes(10), false);
            
            return response()->json([
                'message' => 'Debes esperar '.$minutosRestantes.' minutos antes de solicitar otro código.',
                'puede_reenviar' => false,
                'tiempo_restante' => $minutosRestantes
            ], 429);
        }
        
        $codigo_verificacion = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $usuario->codigo_verificacion = $codigo_verificacion;
        $usuario->save();
        
        $rutaFirmada = encrypt([
            'user_id' => $usuario->id,
            'email' => $usuario->email,
            'expires' => now()->addMinutes(10)->timestamp
        ]);

        $url = "http://localhost:4200/confirm-acount?token=" . urlencode($rutaFirmada);

        Mail::send('Mail.verificacion', 
            [
                'usuario' => $usuario, 
                'codigo_verificacion' => $codigo_verificacion,
                'url' => $url
            ], 
            function ($message) use ($usuario) {
                $message->to($usuario->email)
                       ->subject('Nuevo Código de Verificación');
        });
        
        return response()->json([
            'message' => 'Se ha enviado un nuevo código de verificación a tu correo.',
            'nuevo_token' => $rutaFirmada
        ], 200);
        
    } catch (\Exception $e) {
        \Log::error('Error en solicitud de nuevo token: ' . $e->getMessage());
        return response()->json(['message' => 'Error al procesar la solicitud'], 500);
    }
}

    public function darrolguest($id){
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $usuario->rol = '1';
        $usuario->save();
        return response()->json($usuario, 200);
    }


public function refreshToken(Request $request)
{
    try {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'message' => 'Token no proporcionado'
            ], 401);
        }
        
        JWTAuth::setToken($token);
        
        $user = JWTAuth::authenticate();
        
        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado'
            ], 401);
        }
        
        JWTAuth::invalidate();
        
        $newToken = JWTAuth::fromUser($user);
        
        return response()->json([
            'message' => 'Token refrescado exitosamente',
            'token' => $newToken,
            'user' => [
                'id' => $user->id,
                'name' => $user->name ?? $user->nombre,
                'email' => $user->email,
                'rol' => $user->rol
            ]
        ]);
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        return response()->json([
            'message' => 'El token ha expirado'
        ], 401);
    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        return response()->json([
            'message' => 'El token es inválido'
        ], 401);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error al refrescar token',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function verificarCodigo(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'codigo' => 'required|string|size:6'
    ]);

    $usuario = User::where('email', $request->email)
                  ->where('codigo_verificacion', $request->codigo)
                  ->first();

    if (!$usuario) {
        return back()->with('error', 'Código de verificación incorrecto. Inténtalo de nuevo.');
    }

    if ($usuario->estado === 'activo') {
        return back()->with('success', 'Esta cuenta ya está activada. Puedes iniciar sesión.');
    }

    $usuario->estado = 'activo';
    $usuario->rol = '3';
    $usuario->email_verified_at = now();
    $usuario->codigo_verificacion = null;
    $usuario->save();

    return view('auth.cuenta-activada', ['usuario' => $usuario]);
}



}
