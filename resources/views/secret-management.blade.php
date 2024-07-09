<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Secret Management') }}
        </h2>
        <span class="text-sm  text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user_profile?->nama }}
        </span>
    </x-slot>
    <div>
        
        <x-section>
            <livewire:manage-secret :profile="$profile"/>            
        </x-section>
        <div>
            @if(isset($profile['remote-address']))
            <livewire:monitor-traffic :interface="$profile['name']" :address="$profile['remote-address']" lazy="on-load"/>
            @endif
        </div>
        <x-section>
            <livewire:manage-payment :server="$server->id" :secret_id="$secret"/>
        </x-section>
        <x-section>
            <livewire:manage-customer :profile="$user_profile"/>
        </x-section>
    </div>
</x-app-layout>

