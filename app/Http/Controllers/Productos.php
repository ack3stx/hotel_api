<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;

class Productos extends Controller
{
    //
    public function Insertar(Request $request){

        $Validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'precio' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->save();
        return response()->json($producto);
    }
    public function Actualizar(Request $request, $id)
{
    $Validator = Validator::make($request->all(), [
        'nombre' => 'required',
        'precio' => 'required',
    ]);
    if($Validator->fails()){
        return response()->json($Validator->errors(), 422);
    }

    $producto = Producto::find($id);
    if (!$producto) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    $producto->nombre = $request->nombre;
    $producto->precio = $request->precio;
    $producto->save();
    return response()->json($producto);
}
    public function Eliminar($id)
{
    $producto = Producto::find($id);
    if (!$producto) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }
    $producto->delete();
    return response()->json(['message' => 'Producto eliminado correctamente']);
}
    public function Mostrar(){
        $producto = Producto::all();
        return response()->json($producto);
    }
}
