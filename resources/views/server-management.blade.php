<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Server Management') }}
        </h2>
    </x-slot>

    <x-section>
        <livewire:manage-server-profile />
    </x-section>
</x-app-layout>