
<x-section>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Our products
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Pelanggan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Telp
                    </th>
                    <th scope="col" class="px-6 py-3">
                        PPPoE Username
                    </th>
                    <th scope="col" class="px-6 py-3">
                        PPPoE Profile
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Jatuh Tempo
                    </th>

                </tr>
            </thead>
            <tbody>
                {{-- @dd($secrets) --}}

                @foreach ($secrets as $secret)
                <tr 
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-600 hover:cursor-pointer" 
                href="{{ route('dashboard.pppoe.mgmt', ['server' => auth()->user()->currentTeam->server()->first()->id, 'secret' => $secret['secret']['.id']]) }}" 
                wire:navigate>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ data_get($secret, "customer.nama") }}
                    </th>
                    <td class="px-6 py-4">
                        {{ data_get($secret, "customer.alamat") }}
                    </td>
                    <td class="px-6 py-4">
                        {{ data_get($secret, "customer.telp") }}
                    </td>
                    <td class="px-6 py-4">
                        {{ data_get($secret, "secret.name") }}
                    </td>
                    <td class="px-6 py-4">
                        {{ data_get($secret, "secret.profile") }}
                    </td>
                    @php
                        $jatuh_tempo = data_get($secret, "customer.jatuh_tempo");
                        if($jatuh_tempo){
                            $jatuh_tempo = \Carbon\Carbon::create($jatuh_tempo);
                        }else {
                            // push first evaluate later
                            array_push($this->doesntHaveJatuhTempo, $secret);
                        }

                    @endphp
                    <td class="px-6 py-4 {{ evaluateColorJatuhTempo($jatuh_tempo) }}">
                        
                        {{ $jatuh_tempo?->format("d-F-Y") }}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-section>