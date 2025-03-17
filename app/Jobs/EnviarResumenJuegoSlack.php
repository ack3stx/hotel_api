<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Partida;

class EnviarResumenJuegoSlack implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $partida_id;
    protected $tipo_fin;

    public function __construct($partida_id, $tipo_fin)
    {
        $this->partida_id = $partida_id;
        $this->tipo_fin = $tipo_fin;
    }

    public function handle()
{
    try {
        Log::info("Iniciando job para partida {$this->partida_id}");
        
        $partida = Partida::with('intentos')->find($this->partida_id);
        
        if (!$partida) {
            Log::error("Partida {$this->partida_id} no encontrada");
            return;
        }
        
        Log::info("Partida encontrada, generando resumen...");
        $resumen = $this->generarResumen($partida);
        
        Log::info("Enviando a Slack...");
        $this->enviarASlack($resumen);
        
        Log::info("Resumen enviado exitosamente");
    } catch (\Exception $e) {
        Log::error("Error en job: " . $e->getMessage());
        Log::error("Stack trace: " . $e->getTraceAsString());
        throw $e;
    }
}

    private function generarResumen($partida)
    {
        $resumen = "🎮 Resumen de Partida #{$partida->id}\n";
        $resumen .= "Estado: " . $this->obtenerEstado() . "\n";
        $resumen .= "Palabra: {$partida->palabra_oculta}\n\n";
        $resumen .= "Intentos realizados:\n";

        foreach ($partida->intentos as $intento) {
            $resumen .= "- Letra: {$intento->palabra} " . 
                       ($intento->es_correcta ? '✅' : '❌') . "\n";
        }

        return $resumen;
    }

    private function obtenerEstado()
    {
        return match($this->tipo_fin) {
            'abandonada' => '⛔ Abandonada',
            'ganada' => '🏆 Ganada',
            'perdida' => '💀 Perdida',
            default => '❓ Desconocido'
        };
    }

    private function enviarASlack($mensaje)
    {
        $webhook = env('LOG_SLACK_WEBHOOK_URL');
        
        if (!$webhook) {
            Log::error('Slack webhook URL no configurada');
            return;
        }

        $response = Http::post($webhook, [
            'text' => $mensaje
        ]);

        if (!$response->successful()) {
            Log::error("Error de Slack: " . $response->body());
            throw new \Exception('Error enviando mensaje a Slack');
        }
    }
}