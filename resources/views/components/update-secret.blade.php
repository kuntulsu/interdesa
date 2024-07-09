<x-form-section submit="updateSecret">
    <x-slot name="title">
        {{ __('Informasi Teknis') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Informasi Teknis Pelanggan PPPoE') }}
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <x-label for="username" value="{{ __('Username PPPoE') }}" />
            <x-input id="username" type="text" class="mt-1 block w-full" wire:model="secretForm.username" />
            <x-input-error for="secretForm.username" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('password PPPoE') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="secretForm.password" />
            <x-input-error for="secretForm.password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="paket" value="{{ __('Paket') }}" />
            <x-select id="paket" class="mt-1 block w-full" wire:model="secretForm.profile_id">
                @foreach ($this->secretForm->paket as $paket)
                    <option
                     value="{{ $paket['name'] }}"
                     @if($paket['name'] == $profile['profile']) selected @endif
                    >
                     {{ $paket['name'] }}
                    </option>
                @endforeach
            </x-select>
            <x-input-error for="secretForm.paket" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="local_address" value="{{ __('Local Address PPPoE') }}" />
            <x-input id="local_address" type="text" class="mt-1 block w-full" wire:model="secretForm.local_address" />
            <x-input-error for="secretForm.local_address" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="remote_address" value="{{ __('Remote Address PPPoE') }}" />
            <x-input id="remote_address" type="text" class="mt-1 block w-full" wire:model="secretForm.remote_address" />
            <x-input-error for="secretForm.remote_address" class="mt-2" />
        </div>

        

        <div class="col-span-6 sm:col-span-4">
            <x-danger-button type="button" wire:click="showSecret">cancel</x-danger-button>
            <x-button>save</x-button>
        </div>
    </x-slot>


</x-form-section>