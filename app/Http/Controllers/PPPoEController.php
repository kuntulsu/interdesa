<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Customer;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Gate;

class PPPoEController extends Controller
{
    public function list(Request $request, Server $server)
    {
        $team = Jetstream::newTeamModel()->findOrFail(auth()->user()->currentTeam->id);

        if (Gate::denies('view', $team)) {
            abort(403);
        }

        return view('pppoe', [
            'user' => $request->user(),
            'team' => $team,
        ]);
    }

    public function secret_mgmt(Request $request, Server $server, int|string $secret)
    {
        $team = Jetstream::newTeamModel()->findOrFail(auth()->user()->currentTeam->id);
        if (Gate::denies('view', $team)) {
            abort(403);
        }
        $router = $request->user()->currentTeam->server()->first()->connect();
        
        $profile = $router->ppp()->getSecret($secret)[0];
        if($profile) {
            $user_profile = auth()->user()->currentTeam->server->customer()
                ->where("secret_id", $profile['.id'])->first();
            if(!$user_profile){
                $user_profile = new Customer;
                $user_profile->secret_id = $profile['.id'];
                $user_profile->server_id = $server->id;
                $user_profile->mikrotik_software_id = $router->saved_software_id;

                $user_profile->save();
            }
        }else{
            session()->flash("profileNotFound", "Profil Tidak Ditemukan");
            
        }
        

        return view('secret-management', [
            'user' => $request->user(),
            'team' => $team,
            'server' => $server,
            'secret' => $secret,
            'profile' => $profile,
            'user_profile' => $user_profile
        ]);
    }
    public function server_mgmt(Request $request)
    {
        $user = $request->user();
        $server = $user->currentTeam->server;
        return view("server-management", [
            "server" => $server
        ]);
    }
}
