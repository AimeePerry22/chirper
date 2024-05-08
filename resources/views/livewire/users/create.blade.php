<?php

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

new class extends Component {

    public string $name;
    public string $email;
    public string $password;
    public string $password_confirmation;

    public function store()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        $this->dispatch('user-created');

        return redirect('users');
    }
}; ?>


<div>
    <x-modal name="create-user" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="store" class="p-6 space-y-6">

            <header>
                <h2 class="text-lg font-medium text-blue-500- dark:text-gray-100">
                    {{ __('Create a new user!') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Enter a unique email and password!') }}
                </p>
            </header>

            <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Enter your name')" />
            <x-text-input
                wire:model="name"
                placeholder="{{ __('Enter a name') }}"
                class="block w-full border-red-600 focus:border-red-300 focus:ring focus:ring-red-900 focus:ring-opacity-100 rounded-md shadow-sm"
            ></x-text-input>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>


            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Enter email')" />
                <x-text-input
                    wire:model="email"
                    placeholder="{{ __('Enter a valid email') }}"
                    class="block w-full border-yellow-600 focus:border-yellow-300 focus:ring focus:ring-yellow-900 focus:ring-opacity-100 rounded-md shadow-sm"
                ></x-text-input>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                  placeholder="{{ __('Create a password') }}"
                                  class="block w-full border-green-600 focus:border-green-300 focus:ring focus:ring-green-900 focus:ring-opacity-100 rounded-md shadow-sm"
                                  type="password"
                                  name="password"
                                  autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                              placeholder="{{ __('Confirm password') }}"
                              class="block w-full border-purple-600 focus:border-purple-300 focus:ring focus:ring-purple-900 focus:ring-opacity-100 rounded-md shadow-sm"
                              type="password"
                              name="password_confirmation" autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-action-message class="me-3" on="user-created">
                    {{ __('User Created.') }}
                </x-action-message>
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('create new user') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
