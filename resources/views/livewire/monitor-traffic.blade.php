<div wire:poll.5s.visible x-on:secret-updated.window="$wire.$refresh()">
    @if($this->connected)
    <div class="max-w-7xl flex flex-col lg:flex-row mx-auto ">
        @if($interfaceNotFound)
            <x-section>
                <x-alert>
                    Interface Not Found / Offline
                </x-alert>
            </x-section>
        @else
            <x-section class=" w-full">
                <x-card format="Mbps">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                        </svg>
                        
                    </x-slot:icon>
                    <x-slot:header>
                        Download
                    </x-slot:header>
                    <x-slot:body>
                        {{ parseBitToMegaBit($traffic['tx-bits-per-second']) }}
                    </x-slot:body>
                    <x-slot:footer>
                        {{ $traffic['tx-packets-per-second'] }} Packet/s
    
                    </x-slot:footer>
                </x-card>
            </x-section>
            <x-section class=" w-full">
                <x-card format="Mbps">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                        </svg>
                        
                        
                    </x-slot:icon>
                    <x-slot:header>
                        Upload
                    </x-slot:header>
                    <x-slot:body>
                        {{ parseBitToMegaBit($traffic['rx-bits-per-second']) }}
                    </x-slot:body>
                    <x-slot:footer>
                        {{ $traffic['rx-packets-per-second'] }} Packet/s
                    </x-slot:footer>
                </x-card>
            </x-section>
            <x-section class=" w-full">
                <x-card>
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                          </svg>
                          
                        
                        
                    </x-slot:icon>
                    <x-slot:header>
                        Latencies
                    </x-slot:header>
                    <x-slot:body>
                        @if (isset($latencies['time']))
                            {{ $latencies['time'] }}
                        @else
                            <span class="text-red-600">{{ __("timeout") }}</span>
                        @endif    
                    </x-slot:body>
                    <x-slot:footer>
                        {{ $latencies['host'] }}
                    </x-slot:footer>
                </x-card>
            </x-section>
        @endif
    </div>
    @else
        <x-section>
            device unreachable / offline
        </x-section>
    @endif
    
</div>