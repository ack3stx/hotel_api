<?php
// app/Console/Commands/VerificarPartidasTerminadas.php

namespace App\Console\Commands;

use App\Jobs\EnviarResumenJuegoSlack;
use Illuminate\Console\Command;
use App\Models\Partida;

class VerificarPartidasTerminadas extends Command
{
    protected $signature = 'partidas:verificar';
    protected $description = 'Verifica partidas terminadas y envía resúmenes';

    public function handle()
    {
        $partidas = Partida::where('updated_at', '>=', now()->subMinutes(5))
                          ->where(function($query) {
                              $query->where('intentos_restantes', 0)
                                   ->orWhere('esta_ganada', true);
                          })
                          ->get();

        foreach($partidas as $partida) {
            $tipo = $this->determinarTipoFin($partida);
            EnviarResumenJuegoSlack::dispatch($partida->id, $tipo)
                                  ->delay(now()->addMinute());
        }
    }

    private function determinarTipoFin($partida)
    {
        if($partida->esta_ganada) return 'ganada';
        return $partida->intentos_restantes === 0 ? 'perdida' : 'abandonada';
    }
}