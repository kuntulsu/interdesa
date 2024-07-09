<div wire:poll.5s.visible>
    @if($this->connected)
    <x-section>
        
        <div class="flex flex-col">
            <div class="w-full text-right">
                <span class="text-white text-xs h-3 font-bold">
                    <span class="animate-pulse inline-block w-3 h-3 bg-red-600 rounded-full"></span>
                    Live Update
                </span>
            </div>
            <div class="flex flex-col md:flex-row justify-between text-white gap-2">
                <div class="flex gap-2 w-full">
                    <x-server-icon class="!w-14 !h-14"/>
                    <div class="flex flex-col gap-1 font-bold tracking-wider">
                        <div>Server Name : {{ $identity['name'] }}</div>
                        <div>Device : 
                            <span>{{ $resource['cpu'] }}</span>
                            <span>{{ $resource['cpu-frequency'] }}Mhz</span>
                            <span>(x{{ $resource['cpu-count'] }})</span>
                            <span>({{ $resource['architecture-name'] }})</span>
                        </div>
                        <div>Software : 
                            <span>{{ $resource['platform'] }}</span>
                            <span>{{ $resource['version'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row gap-2 justify-between font-bold tracking-wider w-full">
                    <div class="flex flex-col justify-center gap-2 text-center">
                        <span>CPU</span>
                        <span>{{ $resource['cpu-load'] }}%</span>
                    </div>
                    <div class="flex flex-col justify-center gap-2 text-center">
                        <span>Memory</span>
                        <span>
                            @php
                                $total = $resource['total-memory'];
                                $free = $resource['free-memory'];
                                $percent = ($total - $free) / $total *100;
                                $percent = number_format($percent, 2);
                            @endphp
                            {{ $percent }}%
                        </span>
                    </div>
                    <div class="flex flex-col justify-center gap-2 text-center">
                        <span>Disk</span>
                        <span>
                            @php
                                $total = $resource['total-hdd-space'];
                                $free = $resource['free-hdd-space'];
                                $percent = ($total - $free) / $total *100;
                                $percent = number_format($percent, 2);
                            @endphp
                            {{ $percent }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-section>
    @else
        <x-section>
            <x-alert>
                Device is unreachable / offline
            </x-alert>
        </x-section>
    @endif
</div>
