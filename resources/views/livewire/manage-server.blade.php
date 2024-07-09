<div>
    <x-section-border />
    <x-form-section submit="updateServerConfig">

        <x-slot name="title">
            {{ __('Server Configuration') }}
        </x-slot>
    
        <x-slot name="description">
            {{ __('Server Credentials for Our Connection') }}
        </x-slot>
    
        <x-slot name="form">

            @if (!$server)
                <div class="col-span-6 sm:col-span-4">
                    <p class="text-black dark:text-white">{{ __("No Servers. Please Create One") }}</p>  
                </div>            
            @endif
    
            <!-- Hostname -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="hostname" value="{{ __('Hostname (Reachable IP Address / Public IP / Public DNS)') }}" />
                
                <x-input id="hostname"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model="hostname"
                            :disabled="! Gate::check('create', $team)" />
    
                <x-input-error for="hostname" class="mt-2" />
            </div>
            <!-- Username -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="username" value="{{ __('Username for Mikrotik Logon') }}" />
    
                <x-input id="username"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model="username"
                            :disabled="! Gate::check('create', $team)" />
    
                <x-input-error for="username" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="password" value="{{ __('Password for Mikrotik Logon') }}" />
    
                <x-input id="password"
                            type="password"
                            class="mt-1 block w-full"
                            wire:model="password"
                            :disabled="! Gate::check('create', $team)" />
    
                <x-input-error for="password" class="mt-2" />
            </div>
            <!-- Port -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="port" value="{{ __('API Port Mikrotik (default: 8728)') }}" />
    
                <x-input id="port"
                            type="number"
                            class="mt-1 block w-full"
                            wire:model="port"
                            :disabled="! Gate::check('create', $team)" />
    
                <x-input-error for="port" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                @if (session("mikrotikConnectError"))
                    <x-alert>
                        {{ session("mikrotikConnectError") }}
                    </x-alert>
                @endif
            </div>
        </x-slot>
    
        @if (Gate::check('create', $team))
            <x-slot name="actions">
                <x-action-message class="me-3" on="saved">
                    {{ __('Updated Successfully') }}
                </x-action-message>
    
                @if($checked)
                    <x-button>
                        {{ __('Save') }}
                    </x-button>
                @else
                <x-button>
                    {{ __('Check Connection') }}
                </x-button>
                @endif
                
            </x-slot>
        @endif
    </x-form-section>
    
    
</div>