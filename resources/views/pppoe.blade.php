<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List PPPoE') }}
        </h2>
    </x-slot>

    <div>
        @livewire("list-pppoe", ["server" => $user->currentTeam->server()->first()->id])
    </div>
</x-app-layout>

