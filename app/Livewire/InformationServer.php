<?php

namespace App\Livewire;

use App\Models\Server;
use Livewire\Component;

class InformationServer extends Component
{
    public Server $server;
    public bool $connected = false; 
    public function mount($server)
    {
        $this->server = $server;
        
    }
    public function render()
    {
        $router = $this->server->connect();
        $this->connected = $router->connected;
        if($router->connected){
            $resource = $router->getResource();
            $identity = $router->getIdentity();
        }
        

        return view('livewire.information-server', [
            'identity' => $identity[0] ?? null,
            'resource' => $resource[0] ?? null
        ]);
    }
}
