<x-form-section submit="updateCustomer">
    <x-slot name="title">
        {{ __('Informasi Pribadi') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Informasi Pribadi Pelanggan PPPoE') }}
    </x-slot>

    <x-slot name="form" >

        <div class="col-span-6 sm:col-span-4">
            <x-label for="nik" value="{{ __('Nomor Induk Kependudukan') }}" />
            <x-input id="nik" type="number" class="mt-1 block w-full" wire:model="customerForm.nik" />
            <x-input-error for="customerForm.nik" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="nama" value="{{ __('Nama Pelanggan') }}" />
            <x-input id="nama" type="text" class="mt-1 block w-full" wire:model="customerForm.nama" />
            <x-input-error for="customerForm.nama" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="alamat" value="{{ __('Alamat') }}" />
            <x-input id="alamat" type="text" class="mt-1 block w-full" wire:model="customerForm.alamat" />
            <x-input-error for="customerForm.alamat" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="telp" value="{{ __('Nomor Telepon') }}" />
            <x-input id="telp" type="text" class="mt-1 block w-full" wire:model="customerForm.telp" />
            <x-input-error for="customerForm.telp" class="mt-2" />
        </div>

        @if (!isset($customerForm->jatuh_tempo))
            <div class="col-span-6 sm:col-span-4">
                <x-label for="jatuh_tempo" value="{{ __('Jatuh Tempo') }}" />
                <x-input id="jatuh_tempo" type="date" class="mt-1 block w-full" wire:model="customerForm.jatuh_tempo"/>
                <x-input-error for="customerForm.jatuh_tempo" class="mt-2" />
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4">
            <x-danger-button type="button" wire:click="showCustomer">cancel</x-danger-button>
            <x-button>save</x-button>
            
        </div>
    </x-slot>


</x-form-section>