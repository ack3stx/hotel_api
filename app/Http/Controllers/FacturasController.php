<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use Illuminate\Support\Facades\Validator;


class FacturasController extends Controller
{
    public function nuevaFactura(Request $request){
        
        $Validator = Validator::make($request->all(), [
            'metodo_pago' => 'required',
            'monto_pagado' => 'required',
            'reservacion_id' => 'required',
            'estado' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
        $factura = new Factura();
        $factura->reservacion_id = $request->reservacion_id;
        $factura->metodo_pago = $request->metodo_pago;
        $factura->monto_pagado = $request->monto_pagado;
        $factura->estado = $request->estado;
        $factura->save();
        return response()->json($factura);
    }
    public function actualizarFactura(Request $request, $id){
        $Validator = Validator::make($request->all(), [
            'metodo_pago' => 'required',
            'monto_pagado' => 'required',
            'reservacion_id' => 'required',
            'estado' => 'required',
        ]);
        if($Validator->fails()){
            return response()->json($Validator->errors(), 422);
        }
        $factura = Factura::find($id);
        if (!$factura) {
            return response()->json(['error' => 'Factura no encontrada'], 404);
        }
        $factura->reservacion_id = $request->reservacion_id;
        $factura->metodo_pago = $request->metodo_pago;
        $factura->monto_pagado = $request->monto_pagado;
        $factura->estado = $request->estado;
        $factura->save();
        return response()->json($factura);
    }
    public function eliminarFactura($id)
    {
        $factura = Factura::find($id);
        if (!$factura) {
            return response()->json(['error' => 'Factura no encontrada'], 404);
        }
        $factura->delete();
        return response()->json(['message' => 'Factura eliminada'],200);
    }
    public function mostrarFacturas($id = null){
        if ($id) {
            $facturas = Factura::find($id);
            if (!$facturas) {
                return response()->json(['error' => 'Factura no encontrada'], 404);
            }
            return response()->json($facturas,200);
        }
        $facturas = Factura::all();
        return response()->json($facturas,200);
    }
}
