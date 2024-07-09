<x-form-section>
    <x-slot name="title">
        {{ __('Informasi Teknis') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Informasi Teknis Pelanggan PPPoE') }}
    </x-slot>
    
    <x-slot name="form">

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            @if (data_get($this->profile, "disabled") == "true")
                <x-alert>
                    Status User PPPoE ini adalah <i>Disabled</i>
                </x-alert>
            @endif
            <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                <li class="pb-3 sm:pb-4">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            Username
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ $this->profile['name'] }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        $320
                    </div>
                </div>
                </li>
                <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            Password
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ $this->profile['password'] }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        $3467
                    </div>
                </div>
                </li>
                <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            Paket Dipakai
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ $this->profile['profile'] }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        $67
                    </div>
                </div>
                </li>
                <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            Local Address
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ $this->profile['local-address'] ?? null }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        $2367
                    </div>
                </div>
                </li>
                <li class="pt-3 pb-0 sm:pt-4">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            Remote Address
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ $this->profile['remote-address'] ?? null }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        $367
                    </div>
                </div>
                </li>
            </ul>

        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-button type="button" wire:click="showUpdateForm">
                ubah data pppoe 
            </x-button>
            @if(data_get($this->profile, "disabled") == "false")
            <x-danger-button type="button" wire:click="isolirPelanggan" wire:confirm="user pppoe ini akan terputus dari server dan tidak bisa login kembali, lanjutkan?">
                Isolir Profil Pelanggan
            </x-button>
            @elseif (data_get($this->profile, "disabled") == "true")
            <x-success-button type="button" wire:click="aktifkanPelanggan" wire:confirm="jika alasan user ini terdisable adalah karena lewat jatuh tempo, tolong aktifkan melalui pembayaran">
                Aktifkan Profil Pelanggan
            </x-button>
            @endif
        </div>
    </x-slot>


</x-form-section>