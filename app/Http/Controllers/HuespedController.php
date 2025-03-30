<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Huesped;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Events\HuespedUpdated;

class HuespedController extends Controller
{
    public function nuevoHuesped(Request $request){
        
        $Validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'correo' => 'required|email',
        ]);
        
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
        
        $user_id = auth()->id();

        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $huesped = new Huesped();
        $huesped->user_id = $user_id;
        $huesped->nombre = $request->nombre;
        $huesped->apellido = $request->apellido;
        $huesped->telefono = $request->telefono;
        $huesped->direccion = $request->direccion;
        $huesped->correo = $request->correo;
        $huesped->save();
        
        // Disparar evento WebSockets
        event(new HuespedUpdated($huesped,'created'));        
        return response()->json($huesped,200);
    }

    public function actualizarHuesped(Request $request, $id)
    {
        $Validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'correo' => 'required|email',
        ]);
        
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }

        $huesped = Huesped::find($id);
        if (!$huesped) {
            return response()->json(['error' => 'Huesped no encontrado'], 404);
        }

        $huesped->nombre = $request->nombre;
        $huesped->apellido = $request->apellido;
        $huesped->telefono = $request->telefono;
        $huesped->direccion = $request->direccion;
        $huesped->correo = $request->correo;
        $huesped->save();
        
        // Disparar evento WebSockets
        event(new HuespedUpdated($huesped,'updated'));        
        return response()->json($huesped,200);
    }
    
    public function eliminarHuesped($id)
    {
        $huesped = Huesped::find($id);
        if (!$huesped) {
            return response()->json(['error' => 'Huesped no encontrado'], 404);
        }
        
        // Opcional: Enviar evento de eliminación antes de eliminar
        event(new HuespedUpdated($huesped,'deleted'));   
        $huesped->delete();
        return response()->json(['message' => 'Huesped eliminado'],200);
    }

    public function mostrarHuespedes($id = null){
        if ($id) {
            $huesped = Huesped::find($id);
            if (!$huesped) {
                return response()->json(['error' => 'Huesped no encontrado'], 404);
            }
            return response()->json($huesped,200);
        }

        $huesped = Huesped::all();
        return response()->json($huesped,200);
    }

    public function getHuespedActual(){
        $user_id = auth()->id();
        
        $huesped = Huesped::where('user_id', $user_id)->first();
        
        if (!$huesped) {
            return response()->json(['message' => 'No se encontró información de huésped'], 404);
        }
        
        return response()->json($huesped, 200);
    }
    
    // Método opcional para probar WebSockets manualmente
    public function testWebsocket($id)
    {
        $huesped = Huesped::find($id);
        if (!$huesped) {
            return response()->json(['error' => 'Huesped no encontrado'], 404);
        }
        
        return response()->json([
            'message' => 'Evento enviado al canal huesped.' . $huesped->user_id,
            'huesped_id' => $huesped->id,
            'user_id' => $huesped->user_id
        ]);
    }
}