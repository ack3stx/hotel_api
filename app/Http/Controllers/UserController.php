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

    $usuario = new User(); 
    $usuario->name = $request->input('name');
    $usuario->password = bcrypt($request->input('password'));
    $usuario->email = $request->input('email');
    $usuario->rol = '1';
    $usuario->estado = 'inactivo';
    
    $codigo_verificacion = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $usuario->codigo_verificacion = $codigo_verificacion;
    $usuario->save();


    $rutaFirmada = encrypt([
        'user_id' => $usuario->id,
        'email' => $usuario->email,
        'expires' => now()->addMinutes(10)->timestamp
    ]);

    $url = "http://localhost:4200/confirm-acount?token=" . urlencode($rutaFirmada);

    try {
        Mail::send('Mail.verificacion', 
            [
                'usuario' => $usuario, 
                'codigo_verificacion' => $codigo_verificacion,
                'url' => $url
            ], 
            function ($message) use ($usuario) {
                $message->to($usuario->email)
                       ->subject('Código de Verificación');
        });
    
        return response()->json([
            'message' => 'Registro exitoso. Se ha enviado un código de verificación a tu correo.',
        ], 200);
    } catch (\Exception $e) {
        \Log::error('Error en envío de correo: ' . $e->getMessage());
        return response()->json([
            'message' => 'Error al enviar el correo de verificación',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function verifyEmail(Request $request)
{
    $validator = Validator::make($request->all(), [
        'code' => 'required|string|size:6',
        'token' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        $data = decrypt($request->token);

        if ($data['expires'] < now()->timestamp) {
            return response()->json(['message' => 'El enlace ha expirado'], 400);
        }

        $usuario = User::find($data['user_id']);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        if ($usuario->email !== $data['email']) {
            return response()->json(['message' => 'El correo no coincide'], 400);
        }

        if ($usuario->codigo_verificacion !== $request->code) {
            return response()->json(['message' => 'Código de verificación inválido'], 400);
        }

        if ($usuario->estado === 'activo') {
            return response()->json(['message' => 'Esta cuenta ya está verificada'], 400);
        }

        $usuario->rol = '3';
        $usuario->estado = 'activo';
        $usuario->email_verified_at = now();
        $usuario->codigo_verificacion = null;
        $usuario->save();

        return response()->json([
            'message' => 'Cuenta verificada exitosamente',
            'user' => [
                'id' => $usuario->id,
                'email' => $usuario->email,
                'estado' => $usuario->estado
            ]
        ], 200);

    } catch (\Exception $e) {
        \Log::error('Error en verificación: ' . $e->getMessage());
        return response()->json(['message' => 'Error al verificar la cuenta'], 500);
    }
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

    if($id){
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario, 200);
    }

    $usuarios = User::all();

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
    $email = $request->email;

    $usuario = User::where('email', $email)->first();
    
    if (!$usuario) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
    
    $ultimaActualizacion = $usuario->updated_at;
    $tiempoMinimo = now()->subMinutes(10);
    
    if ($ultimaActualizacion->greaterThan($tiempoMinimo)) {
        // No han pasado 10 minutos
        $minutosRestantes = now()->diffInMinutes($ultimaActualizacion->addMinutes(10), false);
        
        return response()->json([
            'message' => 'Debes esperar '.$minutosRestantes.' minutos más antes de solicitar otro código.',
            'puede_reenviar' => false,
            'tiempo_restante' => $minutosRestantes
        ], 429); // 429 Too Many Requests
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

    try {
        Mail::send('Mail.verificacion', 
            [
                'usuario' => $usuario, 
                'codigo_verificacion' => $codigo_verificacion,
                'url' => $url
            ], 
            function ($message) use ($usuario) {
                $message->to($usuario->email)
                       ->subject('Código de Verificación');
        });
    
        return response()->json([
            'message' => 'Reenvío de correo exitoso. Se ha enviado un nuevo código de verificación a tu correo.',
            'puede_reenviar' => true,
            'siguiente_reenvio' => now()->addMinutes(10)->toDateTimeString()
        ], 200);
    } catch (\Exception $e) {
        \Log::error('Error en envío de correo: ' . $e->getMessage());
        return response()->json([
            'message' => 'Error al enviar el correo de verificación',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function VerificarCuenta(){

        $usuario = auth()->user();

        return response()->json($usuario, 200);
    }
}
