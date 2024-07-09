<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Customer;
use Livewire\Attributes\Validate;

class CustomerInformationForm extends Form
{
    #[Validate("required|string")]
    public null|string $secret_id;

    #[Validate("required|integer")]
    public null|int $server_id;

    #[Validate("nullable|numeric")]
    public null|string $nik;

    #[Validate("nullable|string")]
    public null|string $nama;

    #[Validate("nullable|string|min:10")]
    public null|string $alamat;

    #[Validate('nullable|numeric')]
    public null|string $telp;

    #[Validate('nullable|date')]
    public null|string $jatuh_tempo;

    #[Validate('date')]
    public null|string $created_at;

    public function setForm($profile)
    {
        $this->secret_id = $profile->secret_id;
        $this->server_id = $profile->server_id;

        
        $this->nik = $profile->nik;
        $this->nama = $profile->nama;
        $this->alamat = $profile->alamat;
        $this->telp = $profile->telp;
        $this->jatuh_tempo = $profile->jatuh_tempo;
        $this->created_at = $profile->created_at;

    }
    public function update()
    {
        $this->validate();
        $customer = auth()->user()->currentTeam->server->customer()
            ->where("secret_id", $this->secret_id)
            ->firstOrFail(); 
        $customer->nik = $this->nik ?? null;
        $customer->nama = $this->nama ?? null;
        $customer->alamat = $this->alamat ?? null;
        $customer->telp = $this->telp ?? null;
        $customer->jatuh_tempo = $this->jatuh_tempo ?? null;
        $customer->created_at = $this->created_at ?? null;
        $customer->save();
        return true;
        
    }
}
