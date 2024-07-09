<?php

namespace App\Livewire;

use App\Models\Server;
use Livewire\Attributes\On;
use Livewire\Component;

class MonitorTraffic extends Component
{
    public Server $server;

    public $address;
    public $interface;
    public bool $interfaceNotFound = false;
    public $connected  = false;
    public function mount(string $interface, string $address)
    {
        $this->server = auth()->user()->currentTeam->server()->firstOrFail();
        $this->address = $address;
        $this->interface = $interface;
        // if(is_null($router->client)){
        //     dd("cannot connect to server");
        // }


    }
    #[On("secret-updated")]
    public function refreshUpdatedSecret($profile)
    {
        $this->interface = $profile['name'];
        $this->address = $profile['remote-address'];
    }
    public function render()
    {
        $this->interfaceNotFound = false;
        $router = $this->server->connect();

        $this->connected = $router->connected;
        $traffic = $router->ppp()->getTraffic("<pppoe-$this->interface>");
        $latencies = $router->ppp()->getLatency($this->address);
        if(isset($traffic['after'])){

            $errorMsg = str($traffic['after']['message']);
            if($errorMsg->startsWith("input does not match")) {
                $this->interfaceNotFound = true;
            }
        }

        return view('livewire.monitor-traffic', [
            "traffic" => $traffic[0] ?? null,
            "latencies" => $latencies[0] ?? null
        ]);
    }
}
