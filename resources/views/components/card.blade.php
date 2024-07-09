@props(['format' => null])

<div>
    <div {{ $attributes->merge(['class' => 'text-white']) }}>
        <div class="grid grid-flow-col grid-cols-2">
            <div id="icon" class="w-full">
                <div class="mx-auto">
                    {{ $icon }}
                </div>
            </div>
            <div class="flex flex-col w-full justify-center">
                <div class="font-bold tracking-wide text-center text-2xl uppercase">
                    {{ $header }}
                </div>
                <div class="w-full py-6">
                    <div class="font-bold tracking-wider text-center truncate text-4xl">
                        <span>{{ $body }} <span class="text-sm tracking-normal">{{ $format }}</span></span> 
                    </div>
                    
                </div>
                <div class="w-full text-center text-sm">
                    @if(isset($footer))
                        {{ $footer }}
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</div>