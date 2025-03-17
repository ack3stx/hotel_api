<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mantenimiento;
use Illuminate\Support\Facades\Validator;


class MantenimientoController extends Controller
{
    public function nuevoMantenimiento(Request $request){
        
        $Validator = Validator::make($request->all(), [
            'habitacion_id' => 'required',
            'empleados_id' => 'required',
            'tipo' => 'required',
            'descripcion' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
        $mantenimiento = new Mantenimiento();
        $mantenimiento->habitacion_id = $request->habitacion_id;
        $mantenimiento->empleado_id = $request->empleados_id;
        $mantenimiento->tipo = $request->tipo;
        $mantenimiento->descripcion = $request->descripcion;
        $mantenimiento->save();
        return response()->json($mantenimiento, 200);
    }
    public function actualizarMantenimiento(Request $request, $id)
    {
        $Validator = Validator::make($request->all(), [
            'habitacion_id' => 'required',
            'empleados_id' => 'required',
            'tipo' => 'required',
            'descripcion' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }

        $mantenimiento = Mantenimiento::find($id);
        if (!$mantenimiento) {
            return response()->json(['error' => 'Mantenimiento no encontrado'], 404);
        }
        $mantenimiento->habitacion_id = $request->habitacion_id;
        $mantenimiento->empleado_id = $request->empleados_id;
        $mantenimiento->tipo = $request->tipo;
        $mantenimiento->descripcion = $request->descripcion;
        $mantenimiento->save();
        return response()->json($mantenimiento, 200);
    }
    public function eliminarMantenimiento($id)
    {
        $mantenimiento = Mantenimiento::find($id);
        if (!$mantenimiento) {
            return response()->json(['error' => 'Mantenimiento no encontrado'], 404);
        }
        $mantenimiento->delete();
        return response()->json(['message' => 'Mantenimiento eliminado'], 200);
    }
    public function mostrarMantenimientos(){
        $mantenimientos = Mantenimiento::all();
        return response()->json($mantenimientos, 200);
    }
}
