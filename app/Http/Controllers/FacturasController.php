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

public function facturaStream()
{
    return response()->stream(function () {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        header('Access-Control-Allow-Origin: *');
        echo "retry: 1000\n";
        
        $lastTimestamp = null;
        if (isset($_SERVER['HTTP_LAST_EVENT_ID'])) {
            list($lastId, $lastTimestamp) = explode('_', $_SERVER['HTTP_LAST_EVENT_ID'], 2) + [null, null];
            $lastTimestamp = $lastTimestamp ?? now()->subMinutes(5)->toDateTimeString();
        } else {
            $lastTimestamp = now()->subMinutes(5)->toDateTimeString();
        }
        
        $facturas = Factura::withTrashed()
                          ->where(function($query) use ($lastTimestamp) {
                              $query->where('updated_at', '>=', $lastTimestamp)
                                   ->orWhere('deleted_at', '>=', $lastTimestamp);
                          })
                          ->orderBy('updated_at', 'asc')
                          ->get();
        
        echo "event: connected\n";
        echo "data: " . json_encode(['status' => 'connected', 'total' => $facturas->count()]) . "\n\n";
        ob_flush();
        flush();
        
        // Enviar facturas modificadas o eliminadas
        if ($facturas->count() > 0) {
            foreach ($facturas as $factura) {
                $data = json_encode($factura);
                // Usar el mismo tipo de evento para simplificar la lógica del cliente
                $eventType = 'factura-update';
                
                echo "id: {$factura->id}_{$factura->updated_at->timestamp}\n";
                echo "event: {$eventType}\n";
                echo "data: {$data}\n\n";
                
                ob_flush();
                flush();
            }
        } else {
            echo "event: no-updates\n";
            echo "data: " . json_encode(['message' => 'No hay cambios en facturas']) . "\n\n";
            ob_flush();
            flush();
        }
        
        echo "event: complete\n";
        echo "data: " . json_encode(['status' => 'complete', 'timestamp' => date('Y-m-d H:i:s')]) . "\n\n";
        ob_flush();
        flush();
        
    }, 200, [
        'Content-Type' => 'text/event-stream',
        'Cache-Control' => 'no-cache',
        'Connection' => 'close',
        'X-Accel-Buffering' => 'no'
    ]);
}
}
