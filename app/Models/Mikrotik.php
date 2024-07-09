<?php

namespace App\Models;

use RouterOS\Query;
use RouterOS\Client;
use App\Models\Mikrotik\PPP;
use Exception;

class Mikrotik {
    public $hostname;
    public $username;
    public $password;
    public $mikrotik_software_id;
    public $saved_software_id;
    public $isSameSoftwareId;
    public int $port = 8728;
    public bool $connected = false;
    public $client;
    function __construct($hostname, $username, $password, $port=8728, $saved_software_id = null)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
        $this->saved_software_id = $saved_software_id;
        try{
            $this->client = new Client([
                "host" => $this->hostname,
                "user" => $this->username,
                "pass" => $this->password,
                "port" => $this->port ?? 8728
            ]);

            $this->connected = true;

            $this->getMikrotikSoftwareId();

            // check if current software id is different from saved software id

            $this->isSameSoftwareId = ($this->mikrotik_software_id == $this->saved_software_id)
                ? true
                : false;

        }catch(Exception $e){
            session()->flash("mikrotikConnectError", $e->getMessage());
            return false;
        }
    }

    public function getMikrotikSoftwareId()
    {
        $query = new Query("/system/license/print");

        $response = $this->client->query($query)->read();

        $this->mikrotik_software_id = $response[0]['software-id'];
    }
    public function ppp()
    {
        if($this->connected) {
            $ppp = new PPP;
            $ppp->config($this->hostname, $this->username, $this->password, $this->port);
            return $ppp;
        }else {
            throw new Exception("hello");
        }
    }

    public function getResource()
    {
        

        $query = new Query("/system/resource/print");

        $response = $this->client->query($query)->read();
        
        return $response;
    }
    public function getIdentity()
    {
        $query = new Query("/system/identity/print");

        $response = $this->client->query($query)->read();
        
        return $response;
    }

}