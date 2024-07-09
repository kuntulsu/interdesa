<?php

namespace App\Livewire;

use App\Models\Server;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;

class ListPppoe extends Component
{
    public Collection $secrets;


    public array $doesntHaveJatuhTempo = [];

    public function mount($server)
    {
        $server = Server::find($server);

        $router = $server->connect();
        $customer = auth()->user()->currentTeam->server->customer;
        $secret = $router->ppp()->getSecret();
        $this->secrets = collect();
        foreach($secret as $secret){
            $this->secrets->push([
                "secret" => $secret,
                "customer" => $customer->where("secret_id", $secret['.id'])->first()
            ]);
        }
    }
    public function render()
    {
        return view('livewire.list-pppoe');
    }
}
