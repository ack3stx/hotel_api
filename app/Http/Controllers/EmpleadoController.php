<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Validator;


class EmpleadoController extends Controller
{
    public function nuevoEmpleado(Request $request){
    
        $Validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'correo' => 'required',
        ]);
        
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
    
        $estado = "activo";
    
        $empleado = new Empleado();
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->telefono = $request->telefono;
        $empleado->correo = $request->correo; // Usar el correo del request
        $empleado->direccion = $request->direccion;
        $empleado->estado = $estado; // Usar directamente la variable $estado, no $request->$estado
        $empleado->save();
        
        return response()->json([
            'message' => 'Empleado creado correctamente',
            'data' => $empleado
        ], 201);
    }
    public function actualizarEmpleado(Request $request, $id)
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

        $empleado = Empleado::find($id);
        if (!$empleado) {
            return response()->json(['error' => 'Empleado no encontrado'], 404);
        }

        $correo = "example@gmail.com";
        $estado = "activo";

        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->telefono = $request->telefono;
        $empleado->correo = $correo;
        $empleado->direccion = $request->direccion;
        $empleado->estado = $estado;
        $empleado->save();
        return response()->json($empleado,200);
    }
    public function eliminarEmpleado($id)
    {
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return response()->json(['error' => 'Empleado no encontrado'], 404);
        }

        $empleado->estado = "inactivo";
        $empleado->save();
        return response()->json(['message' => 'Empleado eliminado']);
    }
    public function mostrarEmpleados(){
        $empleados = Empleado::all();
        return response()->json($empleados);
    }
}
