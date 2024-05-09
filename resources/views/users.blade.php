<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
                    {{ __('Users') }}
                </h2>
            </div>
            <div>
                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'create-user')"
                >{{ __('Create User') }}</x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <livewire:users.create :roles="$roles" />
        <livewire:users.list />
    </div>

</x-app-layout>
