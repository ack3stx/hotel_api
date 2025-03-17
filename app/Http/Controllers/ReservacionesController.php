<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservacion;
use Illuminate\Support\Facades\Validator;
use App\Models\Huesped;
use App\Models\Habitacion;



class ReservacionesController extends Controller
{
    
    public function nuevaReservacion(Request $request){

        $Validator = Validator::make($request->all(), [
            'fecha_entrada' => 'required',
            'fecha_salida' => 'required',
            'habitacion_id' => 'required',
            'huesped_id' => 'required',
            'precio_total' => 'required',
            'estado_reservacion' => 'required',
            'metodo_pago' => 'required',
            'monto_pagado' => 'required',
            'estado' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
        $reservacion = new Reservacion();
        $reservacion->fecha_entrada = $request->fecha_entrada;
        $reservacion->fecha_salida = $request->fecha_salida;
        $reservacion->habitacion_id = $request->habitacion_id;
        $reservacion->huesped_id = $request->huesped_id;
        $reservacion->precio_total = $request->precio_total;
        $reservacion->estado_reservacion = $request->estado_reservacion;
        $reservacion->metodo_pago = $request->metodo_pago;
        $reservacion->monto_pagado = $request->monto_pagado;
        $reservacion->estado = $request->estado;
        $reservacion->save();
        return response()->json($reservacion,200);
    }

    public function actualizarReservacion(Request $request){
        $Validator = Validator::make($request->all(), [
            'fecha_entrada' => 'required',
            'fecha_salida' => 'required',
            'precio_total' => 'required',
            'metodo_pago' => 'required',
            'monto_pagado' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
        $reservacion = Reservacion::find($request->id);
        if (!$reservacion) {
            return response()->json(['error' => 'Reservacion no encontrada'], 404);
        }
        $reservacion->fecha_entrada = $request->fecha_entrada;
        $reservacion->fecha_salida = $request->fecha_salida;
        $reservacion->precio_total = $request->precio_total;
        $reservacion->metodo_pago = $request->metodo_pago;
        $reservacion->monto_pagado = $request->monto_pagado;
        $reservacion->save();
        return response()->json($reservacion,200);
    }
    
    public function eliminarReservacion($id)
    {
        $reservacion = Reservacion::find($id);
        if (!$reservacion) {
            return response()->json(['error' => 'Reservacion no encontrada'], 404);
        }
        $reservacion->delete();
        return response()->json(['message' => 'Reservacion eliminada correctamente'],200);
    }
    public function mostrarReservacion($id = null)
{
    if ($id == null) {
        // Para todas las reservaciones
        $reservaciones = Reservacion::all();
        
        // Enriquecer cada reservación con datos de huésped y habitación
        $datosCompletos = $reservaciones->map(function($reservacion) {
            return [
                'reservacion' => $reservacion,
                'huesped' => Huesped::find($reservacion->huesped_id),
                'habitacion' => Habitacion::find($reservacion->habitacion_id)
            ];
        });
        
        return response()->json([
            'success' => true,
            'data' => $datosCompletos
        ], 200);
    } else {
        // Para una reservación específica
        $reservacion = Reservacion::find($id);
        
        if (!$reservacion) {
            return response()->json(['error' => 'Reservacion no encontrada'], 404);
        }
        
        // Obtener datos del huésped y la habitación
        $huesped = Huesped::find($reservacion->huesped_id);
        $habitacion = Habitacion::find($reservacion->habitacion_id);
        
        return response()->json([
            'success' => true,
            'data' => [
                'reservacion' => $reservacion,
                'huesped' => $huesped,
                'habitacion' => $habitacion
            ]
        ], 200);
    }
}

public function reservacionUsuario()
{
    $id = auth()->user()->id;
    $huesped = Huesped::where('user_id', $id)->first();
    
    if (!$huesped) {
        return response()->json(['error' => 'Huesped no encontrado'], 404);
    }
    
    $reservacion = Reservacion::where('huesped_id', $huesped->id)->get();
    return response()->json($reservacion, 200);
}
public function cancelarReservacion($id)
{
    $reservacion = Reservacion::find($id);
    if (!$reservacion) {
        return response()->json(['error' => 'Reservacion no encontrada'], 404);
    }
    $reservacion->estado_reservacion = 'Cancelada';
    $reservacion->save();
    return response()->json($reservacion, 200);
}

public function datosReservacion($id){
    $reservacion = Reservacion::find($id);
    if (!$reservacion) {
        return response()->json(['error' => 'Reservacion no encontrada'], 404);
    }
    $data = [
        'reservacion' => $reservacion,
        'huesped' => Huesped::find($reservacion->huesped_id),
        'habitacion' => Habitacion::find($reservacion->habitacion_id)
    ];
    return response()->json([
        'data' => $data,
    ], 200);
}
}