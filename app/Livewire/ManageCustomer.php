<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\CustomerInformationForm;
class ManageCustomer extends Component
{
    public CustomerInformationForm $customerForm;
    public string $action = 'show';
    public function mount($profile)
    {
        $this->customerForm->setForm($profile);
    }
    public function showUpdateForm()
    {
        $this->action = "update";
    }
    public function showCustomer()  
    {
        $this->action = "show";
    }
    public function updateCustomer()
    {
        $this->customerForm->update();
        $this->action = "show";
        $this->dispatch("customer-updated");
    }
    public function render()
    {
        return view('livewire.manage-customer');
    }
}
