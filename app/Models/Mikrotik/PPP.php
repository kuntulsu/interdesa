<?php

namespace App\Models\Mikrotik;

use Illuminate\Support\Collection;
use RouterOS\Client;
use RouterOS\Query;

class PPP {
    protected $where = [];

    public $hostname;
    public $username;
    public $password;
    public int $port = 8728;
    public Client $client;


    public function config($hostname, $username, $password, $port=8728)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;

        $this->client = new Client([
            "host" => $this->hostname,
            "user" => $this->username,
            "pass" => $this->password,
            "port" => $this->port ?? 8728
        ]);
    }
    public function getLatency(string $remote_address)
    {
        $query = new Query("/ping");
        $query->equal("address", $remote_address);
        $query->equal("count", 1);

        $response = $this->client->query($query)->read();

        return $response;
    }
    public function dropActiveConnection(string|array $ppp_name)
    {
        $query = new Query('/ppp/active/print');
        if(is_array($ppp_name)){
            $query->operations("|");
            foreach($ppp_name as $name){
                $query->where("name", $name);
            }
        }else{
            $query->where("name", $ppp_name);
        }
        $response = $this->client->query($query)->read();
        if(!empty($response)) {
            $active_connection = $response[0];
            $query = new Query("/ppp/active/remove");
            $query->equal("numbers", $active_connection['.id']);
            $this->client->query($query)->read();
        }
    }
    public function disableSecret(string|array $ppp_id, string $ppp_name = null)
    {
        $query = new Query("/ppp/secret/set");
        if(is_array($ppp_id)){
            $query->operations("|");
            foreach($ppp_id as $id){
                $query->equal(".id", $id);
            }
        }else{
            $query->equal(".id", $ppp_id);
        }
        $query->equal("disabled", "yes");
        $response = $this->client->query($query)->read();
        if($ppp_name){  
            $this->dropActiveConnection($ppp_name);
        }
    }
    public function enableSecret(string $ppp_id)
    {

        $query = new Query('/ppp/secret/set');
        $query->equal(".id", $ppp_id);
        $query->equal("disabled", "no");
        $response = $this->client->query($query)->read();
    }
    public function getTraffic(string $ppp_name)
    {
        $query = new Query("/interface/monitor-traffic");
        $query->equal("interface", $ppp_name);
        $query->equal("once");

        $response = $this->client->query($query)->read();
        return $response;
    }
    public function getSecret(string|array $id = null, string | array $name = null)
    {
        $query = new Query("/ppp/secret/print");
        if(is_array($id)){
            foreach($id as $secret_id) {
                $query->where(".id", $secret_id);
            }
        }
        if(is_string($id)){
            $query->where(".id", $id);
        }
        
        if(is_array($name)){
            foreach($name as $secret_name){
                $query->where("name", $secret_name);
            }            
        }
        if(is_string($name)) {
            $query->where("name", $name);
        }


        if(is_array($id) || is_array($name)){
            $query->operations("|");
        }

        $response = $this->client->query($query)->read();

        return $response;
    }
    public function updateSecret(array $array)
    {
        $query = new Query("/ppp/secret/set");
        $query->equal('.id', $array['.id']);
        foreach($array as $key => $value){
            if($key == ".id" || empty($value)){
                continue;
            }

            $query->equal($key, $value);
        }

        $response = $this->client->query($query)->read();

        if(isset($response['after'])){
            session()->flash("mikrotikResponseError", $response['after']['message']);
        }
        return $response;
    }
    public function getProfile($id = null, $name = null)
    {
        $query = new Query("/ppp/profile/print");
        if($id){
            $query->where(".id", $id);
        }
        if($name) {
            $query->where("name", $name);
        }
        $response = $this->client->query($query)->read();

        return $response;
    }
}