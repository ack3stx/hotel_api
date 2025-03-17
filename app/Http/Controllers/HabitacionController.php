<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use Illuminate\Support\Facades\Validator;


class HabitacionController extends Controller
{
    public function nuevaHabitacion(Request $request){
        
        $Validator = Validator::make($request->all(), [
            'numero' => 'required',
            'tipo' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
        $habitacion = new Habitacion();
        $habitacion->numero_habitacion = $request->numero;
        $habitacion->tipo_habitacion = $request->tipo;
        $habitacion->precio_habitacion = $request->precio;
        $habitacion->descripcion_habitacion = $request->descripcion;
        $habitacion->save();
        return response()->json([
            'message' => 'Habitacion Creada Correctamente',
            'data' => $habitacion
        ], 200);
    }
    public function actualizarHabitacion(Request $request, $id)
    {
        $Validator = Validator::make($request->all(), [
            'numero' => 'required',
            'tipo' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }

        $habitacion = Habitacion::find($id);
        if (!$habitacion) {
            return response()->json(['error' => 'Habitacion no encontrada'], 404);
        }

        $habitacion->numero_habitacion = $request->numero;
        $habitacion->tipo_habitacion = $request->tipo;
        $habitacion->precio_habitacion = $request->precio;
        $habitacion->descripcion_habitacion = $request->descripcion;
        $habitacion->save();
        return response()->json([
            'message' => 'Habitacion actualizada Correctamente',
            'data' => $habitacion
        ], 200);
    }
    public function eliminarHabitacion($id)
    {
        $habitacion = Habitacion::find($id);
        if (!$habitacion) {
            return response()->json(['error' => 'Habitacion no encontrada'], 404);
        }
        $habitacion->delete();
        return response()->json(['message' => 'Habitacion eliminada Exitosamente'],200);
    }
    public function mostrarHabitaciones(){
        $habitaciones = Habitacion::all();
        return response()->json($habitaciones,200);
    }
}