<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\SecretForm;
use Livewire\Attributes\On;

class ManageSecret extends Component
{
    public $profile;
    public $action = "show";
    public SecretForm $secretForm;
    public string $ppp_name;
    public string $ppp_id;
    public function mount($profile)
    {
        $this->profile = $profile;
        $this->ppp_id = $this->profile['.id'];
        $this->ppp_name = $this->profile['name'];
    }
    public function showUpdateForm()
    {
        $server = auth()->user()->currentTeam->server()->first();
        $this->secretForm->setForm($this->profile, $server);
        $this->action = "update";
    }
    public function aktifkanPelanggan()
    {
        $server = auth()->user()->currentTeam->server;
        $router = $server->connect();
        $router->ppp()->enableSecret($this->ppp_id);

        $this->dispatch("ppp-secret-enabled");  
    }
    public function isolirPelanggan()
    {
        $server = auth()->user()->currentTeam->server;
        $router = $server->connect();
        $router->ppp()->disableSecret($this->ppp_id, $this->ppp_name);

        $this->dispatch("ppp-secret-disabled");
    }
    public function showSecret()
    {
        $this->action = "show";
    }
    public function updateSecret()
    {
        $server = auth()->user()->currentTeam->server;
        $router = $server->connect();
        $response = $this->secretForm->update();

        // set the form to use the updated data
        $this->profile = $response;
        
        $router->ppp()->dropActiveConnection($this->ppp_name);
        $this->ppp_name = $response['name'];

        

        $this->action = "show";
        $this->dispatch('secret-updated', profile:$response);


    }
    public function refreshProfileData()
    {
        $router = auth()->user()->currentTeam->server->connect();
        $this->profile = $router->ppp()->getSecret($this->ppp_id)[0];
    }
    public function render()
    {
        
        return view('livewire.manage-secret');
    }
}
