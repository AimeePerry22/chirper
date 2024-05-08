<?php

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public Collection $users;

    public ?User $editing = null;


    public function mount(): void
    {
        $this->getUsers();
    }

    #[On('Users-created')]
    public function getUsers(): void
    {
        $this->users = User::latest()
            ->get();
    }

    public function edit(User $user): void
    {
        $this->editing = $user;

        $this->getUsers();
    }


    #[On('users-edit-canceled')]
    #[On('users-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getChirps();
    }


    public function delete(User $users): void
    {
        $this->authorize('delete', $users);
        $users->delete();
        $this->getUsers();
    }

}; ?>

<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">



    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    email
                </th>
                <th scope="col" class="px-6 py-3">
                 date created
                </th>
                <th scope="col" class="px-6 py-3">
                    when last updated
                </th>
                <th>
                    Delete
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-purple-800 dark:border-purle-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <p x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="text-blue-500 hover:text-blue-400 cursor-pointer hover:underline">{{ $user->name }}</p>
                    </th>
                    <td class="px-6 py-4">
                        {{$user->email}}
                    </td>
                    <td class="px-6 py-4">
                       {{$user->created_at}}
                    </td>
                    <td class="px-6 py-4">
                        {{$user->updated_at}}
                    </td>
                    <td>
                        <p wire:click="delete({{ $user->id }})" wire:confirm="Are you sure to delete this user?">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="purple-200" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="regular" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
