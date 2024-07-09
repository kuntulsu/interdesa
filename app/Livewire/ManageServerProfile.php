<?php

namespace App\Livewire;

use Livewire\Component;

class ManageServerProfile extends Component
{
    private function getSecretProfile()
    {
        $server = auth()->user()->currentTeam->server;
        $router = $server->connect();
        $profile = $router->ppp()->getProfile();

        return $profile;
    }
    private function parseProfiles($mktk_profile, $local_profile)
    {
        $profiles = [];
        foreach($mktk_profile as $mprof){
            $mprof['local_profile'] = $local_profile->where("profile_id", $mprof['.id'])->first()?->toArray();
            array_push($profiles, $mprof);
        }

        return $profiles;
    }
    public function mount()
    {

    }
    public function render()
    {
        $mktk_profile = $this->getSecretProfile();
        $local_profile = auth()->user()->currentTeam->server_profile;
        
        $profiles = $this->parseProfiles($mktk_profile, $local_profile);
        return view('livewire.manage-server-profile', [
            "profiles" => $profiles
        ]);
    }
}
