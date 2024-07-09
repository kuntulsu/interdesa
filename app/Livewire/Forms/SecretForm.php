<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class SecretForm extends Form
{
    public $server;
    public $profile;
    public $secret_id;
    public $profile_id;
    public $username;
    public $password;
    public $paket;

    #[Validate("nullable|ipv4")]
    public $local_address;

    #[Validate("nullable|ipv4")]
    public $remote_address;

    public function setForm($profile, $server)
    {
        $this->server = $server;
        $router = $server->connect();
        $this->secret_id = $profile['.id'];
        $this->profile = $profile;
        $this->username = $profile['name'];
        $this->password = $profile['password'];
        $this->paket = $router->ppp()->getProfile();
        $this->local_address = $profile['local-address'] ?? null;
        $this->remote_address = $profile['remote-address'] ?? null;

        // define the default of the form
        foreach($this->paket as $paket){
            if($paket['name'] == $profile['profile']){
                $this->profile_id = $paket['name'];
            }
        }
        
    }

    public function update()
    {
        $this->validate();
        $router = $this->server->connect();
        $payload = [
            ".id" => $this->secret_id,
            "name" => $this->username,
            "password" => $this->password,
            "profile" => $this->profile_id,
            "local-address" => $this->local_address,
            "remote-address" => $this->remote_address
        ];
        $response = $router->ppp()->updateSecret($payload);

        $this->reset();

        return $payload;
    }
}
