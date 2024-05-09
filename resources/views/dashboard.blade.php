<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-purple-300 dark:bg-yellow-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-yellow-100">
                    {{ __("WELCOME!") }}
                    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                        <livewire:chirps.create />

                        <livewire:chirps.list />
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
