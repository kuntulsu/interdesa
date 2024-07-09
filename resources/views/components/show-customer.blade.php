<x-form-section>
    <x-slot name="title">
        {{ __('Informasi Pribadi') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Informasi Pribadi Pelanggan PPPoE') }}
    </x-slot>

    <x-slot name="form">

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                <li class="pb-3 sm:pb-4">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                NIK
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {!! $customerForm->nik ?? "<i>Tidak Ada Data</i>" !!}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $320
                        </div>
                    </div>
                </li>

                <li class="pb-3 sm:pb-4">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Nama Pelanggan
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {!! $customerForm->nama ?? "<i>Tidak Ada Data</i>" !!}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $320
                        </div>
                    </div>
                </li>

                <li class="pb-3 sm:pb-4">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Alamat
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {!! $customerForm->alamat ?? "<i>Tidak Ada Data</i>" !!}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $320
                        </div>
                    </div>
                </li>
                <li class="pb-3 sm:pb-4">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Nomor Telepon
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {!! $customerForm->telp ?? "<i>Tidak Ada Data</i>" !!}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $320
                        </div>
                    </div>
                </li>

                <li class="pb-3 sm:pb-4">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Jatuh Tempo
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {!! $customerForm->jatuh_tempo ?? "<i>Tidak Ada Data</i>" !!}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $320
                        </div>
                    </div>
                </li>
                <li class="py-3 sm:pb-4">
                    <x-button type="button" wire:click="showUpdateForm">ubah data pelanggan</x-button>
                    <x-action-message class="me-3" on="saved">
                        Updated Successfully
                    </x-action-message>
                </li>
                
            </ul>

        </div>
    </x-slot>


</x-form-section>