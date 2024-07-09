<?php

namespace App\Livewire;

use App\Livewire\Forms\PaymentForm;
use App\Models\Server;
use Livewire\Component;
use App\Models\Mikrotik;


class ManagePayment extends Component
{
    public $server;
    public int|string $secret_id;
    public bool $connected = false;
    public string $action = "show";
    public PaymentForm $paymentForm;
    public \App\Models\Customer $customer;
    private function connectServer(): Mikrotik
    {
        $router = $this->server->connect();
        if($router->connected){
            $this->connected = true;
        }

        return $router;
    }
    private function getClientSecret(Mikrotik $router)
    {
        $secret = $router->ppp()->getSecret($this->secret_id);
        if(is_array($secret) && empty($secret)){ //empty array = secret not found
            return null;
        }

        return $secret;
    }
    public function showPaymentForm()
    {
        $this->action = "create";
    }
    public function hidePaymentForm()
    {
        $this->action = "show";
    }
    private function getClientInformation(): \App\Models\Customer
    {
        $customer = auth()->user()->currentTeam->server->customer()
            ->where([
                "secret_id" => $this->secret_id
            ])->with(["payment" => function ($query) {
                $query->orderBy("created_at", "desc");
                $query->limit(5);
            }])->first();

        return $customer;
    }
    public function isAnyUpcomingBill()
    {

    }
    public function mount(Server $server, int|string $secret_id)
    {
        $this->server = $server;
        $this->secret_id = $secret_id;
    }
    public function updateProfilePrice()
    {
        $priceUpdated = $this->paymentForm->updatePrice();
        if($priceUpdated) {
            $this->dispatch("profile-price-updated");
        }
    }
    public function issuePayment()
    {
        $paid = $this->paymentForm->createPayment($this->customer);

        if($paid) {
            $this->dispatch("payment-paid");
            $this->action = "show";
        }
    }
    public function render()
    {
        $this->customer = $this->getClientInformation(); //local client info
        if ($this->action == "create") {
            $router = $this->connectServer();
            $client = $this->getClientSecret($router);
            $profile_name = $client[0]['profile'] ?? null;
            $profile = $router->ppp()->getProfile(name:$profile_name);
            $server_profile = auth()->user()->currentTeam->server->profiles()
                ->where("profile_id", $profile[0]['.id'])
                ->first(); //local profile info : (harga paket)

            $this->paymentForm->setForm($profile[0]['.id']);
        }
        return view('livewire.manage-payment', [
            "customer" => $this->customer,
            "profile" => $profile[0] ?? null,            
            "server_profile" => $server_profile ?? null
        ]);
    }
}
