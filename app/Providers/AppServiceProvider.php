<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Factura;
use App\Observers\FacturaObserver;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            // Asegurar que el directorio de bloqueos exista
            $lockDir = storage_path('app/sse_locks');
            if (!file_exists($lockDir)) {
                mkdir($lockDir, 0755, true);
            }
            
            // Registrar el observer
            Factura::observe(FacturaObserver::class);
            
            Log::info('FacturaObserver registrado correctamente');
        } catch (\Exception $e) {
            // Registrar el error pero permitir que la aplicación continúe
            Log::error('Error al registrar FacturaObserver', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}