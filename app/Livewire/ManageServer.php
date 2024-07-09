<?php

namespace App\Livewire;

use App\Models\Server;
use Livewire\Component;
use App\Models\Mikrotik;
use Laravel\Jetstream\InteractsWithBanner;


class ManageServer extends Component
{
    use InteractsWithBanner;

    public $team;
    public $server;
    public bool $checked = false;

    public string $hostname;
    public string $username;
    public string $password;
    public string|null $mikrotik_software_id = null;
    public int $port = 8728;
    public bool $legacy = false;


    public function mount($team)
    {
        $this->team = $team;
        $this->server = Server::where("team_id", $this->team->id)->first();

        if($this->server){
            $this->hostname = $this->server->hostname;
            $this->username = $this->server->username;
            $this->port = $this->server->port;
        }
    }
    public function updateServerConfig()
    {
        $validated = $this->validate([
            "hostname" => "required|string",
            "username" => "required|string",
            "password" => "required",
            "port" => "required"
        ]);

        // this mean the connection has not been checked yet
        if(!$this->checked){
            $mikrotik = new Mikrotik($this->hostname, $this->username, $this->password, $this->port);

            if($mikrotik->connected){
                $this->checked = true;
                $this->mikrotik_software_id = $mikrotik->mikrotik_software_id;
            }

        }else {
            $server = Server::where("team_id", $this->team->id)->first();

            if($server !== null){

                if($server->mikrotik_software_id != $this->mikrotik_software_id){
                    // do something if the software id differ (merge or recreate new one)
                }
                // server found. do the update instead
                $server->update($validated);
                $this->dispatch('saved');

            }else{
                // not found. creating...
                Server::create(
                    array_merge([
                        "team_id" => $this->team->id,
                        "mikrotik_software_id" => $this->mikrotik_software_id
                    ], $validated)
                );
                
                $this->dispatch('saved');
            }

            $this->checked = false;
        }
        

    }
    public function render()
    {
        return view('livewire.manage-server');
    }
}
