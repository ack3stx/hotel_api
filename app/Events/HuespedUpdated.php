<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Huesped;
use Illuminate\Broadcasting\PrivateChannel;

class HuespedUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $huesped;
    public $action;

    public function __construct(Huesped $huesped, $action)
    {
        $this->huesped = $huesped;
        $this->action = $action;
    }

    public function broadcastOn()
{
    \Log::info('Evento HuespedUpdated broadcasting en canal', [
        'canal' => 'Huesped',
        'huesped_id' => $this->huesped->id
    ]);
    return new PrivateChannel('Huesped');
}

    public function broadcastAs()
    {
        return 'evento.huesped';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->huesped->id,
            'nombre' => $this->huesped->nombre,
            'apellido' => $this->huesped->apellido,
            'telefono' => $this->huesped->telefono,
            'direccion' => $this->huesped->direccion,
            'correo' => $this->huesped->correo,
            'action' => $this->action,
            'timestamp' => now()->toDateTimeString()
        ];
    }
}