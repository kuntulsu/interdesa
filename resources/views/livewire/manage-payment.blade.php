<div 
x-on:customer-updated.window="$wire.$refresh()"
x-on:profile-price-updated.window="$wire.$refresh()"
x-on:payment-paid.window="$wire.$refresh()"
x-on:secret-updated.window="$wire.$refresh()"

>
    @if(is_null($customer->jatuh_tempo))
        <x-alert>
            Untuk Menggunakan Fungsi Pembayaran, Silahkan Definisikan "Jatuh Tempo" Pada Kolom Informasi Pelanggan Terlebih dahulu
        </x-alert>
    @else
        

    <div class="flex flex-col lg:flex-row">
        <div class="w-full flex flex-col justify-between gap-5">
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Pembayaran</h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Jatuh Tempo: <span class="font-bold text-white">{{ Carbon\Carbon::create($customer->jatuh_tempo)->format("d F Y") }}</span>
                </p>
            </div>
            <div>
                @if ($action == "show")
                <x-button wire:click="showPaymentForm">Lakukan Pembayaran</x-button>
                @else
                <x-danger-button wire:click="hidePaymentForm">Cancel</x-button>
                @endif
            </div>

        </div>
        <div class="w-full">
            @if ($action == "create")
                @if (!$server_profile)
                    <x-alert>Profile Harga Tidak Ditemukan, Tentukan Harga Terlebih Dahulu</x-alert>
                @endif
            <form
                class="grid grid-flow-row gap-3"
                @if (!$server_profile)
                    wire:submit="updateProfilePrice"
                @else
                    wire:submit="issuePayment"
                @endif
            >
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="customer_name" value="Nama Pelanggan" />
                    <x-input id="customer_name" value="{{ $customer->nama }}" type="text" class="mt-1 block w-full"
                    :disabled="true"
                    />
                    <x-input-error for="customer_name" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="price" value="Harga Paket ({{ $profile['name'] ?? null }})" />
                    <x-input id="price" type="number" class="mt-1 block w-full" wire:model="paymentForm.price" 
                    :disabled="$server_profile ? true : false"
                    />
                    <x-input-error for="paymentForm.price" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="paymentForm.price" value="Nominal Terbayarkan" />
                    <x-input id="paymentForm.price" wire:model="paymentForm.price" type="number" class="mt-1 block w-full" autofocus="true"
                    />
                    <x-input-error for="paymentForm.price" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="paymentForm.note" value="Catatan" />
                    <x-textarea id="paymentForm.note" wire:model="paymentForm.note" type="text" class="mt-1 block w-full">
                    </x-textarea>
                    <x-input-error for="paymentForm.note" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-button type="submit">Save</x-button>
                </div>
            </form>
            @else
            {{-- table / show --}}
            <div class="w-full relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs dark:bg-white  text-gray-900 uppercase dark:text-slate-900">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nominal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Catatan
                            </th>
                            <th scope="col" colspan="2" class="px-6 py-3">
                                Tanggal
                            </th>
        
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customer->payment as $payment)
                        <tr class="bg-white dark:bg-gray-800 border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if (isset($payment->amount) && !is_null($payment->amount))
                                    IDR {{ number_format($payment->amount, 0) }}
                                @endif
                            </th>
                            <td class="px-6 py-4">
                                {{ $payment->note }}
                            </td>
                            <td class="px-6 py-4">
                                {{ Carbon\Carbon::create($payment->created_at)->format("d-F-Y") }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route("payment.print", $payment->id) }}" class="group">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 group-hover:text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                      </svg> 
                                </a>
                            </td>
        
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No Data</td>
                        </tr>
                        @endforelse
        
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    @endif
</div>
