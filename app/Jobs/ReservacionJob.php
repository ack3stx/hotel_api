<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Reservacion;

class ReservacionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $Reservacion;
    Public $Action;

    /**
     * 
     * @return void
     */
    public function __construct($Reservacion,string $Action){

        $this->Reservacion = $Reservacion;
        $this->Action = $Action;
    }
    

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        sleep(10);

        /*
        Log::info("Registro agregado", [
            "reservacion" => $this->Reservacion,
            "action" => $this->Action

        ]);*/
        Log::stack(['single', 'slack'])->info('Something happened!', [
            "reservacion" => $this->Reservacion,
            "action" => $this->Action
        ]);
    }
}