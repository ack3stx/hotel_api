<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Huesped;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class HuespedController extends Controller
{
    public function nuevoHuesped(Request $request){
        
        $Validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
        $user_id = auth()->id();

        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $email = $user->email;


        $huesped = new Huesped();
        $huesped->user_id = $user_id;
        $huesped->nombre = $request->nombre;
        $huesped->apellido = $request->apellido;
        $huesped->telefono = $request->telefono;
        $huesped->direccion = $request->direccion;
        $huesped->correo = $email;
        $huesped->save();
        return response()->json($huesped,200);
    }

    public function actualizarHuesped(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }

        $id_user = auth()->id();
        $huesped = Huesped::where('user_id', $id_user)->first();

        $huesped->nombre = $request->nombre;
        $huesped->apellido = $request->apellido;
        $huesped->telefono = $request->telefono;
        $huesped->direccion = $request->direccion;
        $huesped->save();
        return response()->json($huesped,200);
    }
    public function eliminarHuesped($id)
    {
        $huesped = Huesped::find($id);
        if (!$huesped) {
            return response()->json(['error' => 'Huesped no encontrado'], 404);
        }
        $huesped->delete();
        return response()->json(['message' => 'Huesped eliminado'],200);
    }

    public function mostrarHuespedes(){
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
    
}
