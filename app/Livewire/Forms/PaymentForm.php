<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Customer;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;

class PaymentForm extends Form
{
    #[Locked] 
    public $profile_id;

    #[Validate("required|numeric")]
    public $price = 0;

    #[Validate("nullable|string")]
    public $note = "";


    public function setForm($profile_id)
    {
        $this->profile_id = $profile_id;
        $server = auth()->user()->currentTeam->server;
        $profile = $server->profiles()
            ->where("profile_id", $this->profile_id)
            ->first();
        if($profile) {
            $this->price = $profile->price;
        }
    }
    public function updatePrice()
    {
        $server = auth()->user()->currentTeam->server;
        $profile = $server->profiles()->create([
            "profile_id" => $this->profile_id,
            "price" => $this->price
        ]);
        if($profile){
            return true;
        }
    }

    public function createPayment(Customer $customer)
    {
        $this->validate();
        $paymentIssued = $customer->payment()->create([
            "amount" => $this->price,
            "user_id" => auth()->user()->id,
            "note" => $this->note
        ]);

        if($paymentIssued) {
            return true;
        }
    }
}
