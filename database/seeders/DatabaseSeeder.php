<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'member']);

        $users = User::factory(100)->create();

        foreach ($users as $user) {
            $user->assignRole('member');
        }

        Role::create(['name' => 'admin']);

        $user = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'test@example.com',
        ]);

        $user->assignRole('admin');

        Role::create(['name' => 'premium']);

        $user = User::factory()->create([
            'name' => 'Test premium',
            'email' => 'premium@example.com',
        ]);

        $user->assignRole('premium');

        Role::create(['name' => 'guest']);

        $user = User::factory()->create([
            'name' => 'Testguest ',
            'email' => 'testguest@example.com',
        ]);
        $user->assignRole('guest');

        Role::create(['name' => 'VIP']);

        $user = User::factory()->create([
            'name' => 'TestVIP ',
            'email' => 'testVIP@example.com',
        ]);
        $user->assignRole('VIP');

        Role::create(['name' => 'verified']);

        $user = User::factory()->create([
            'name' => 'verifieduser ',
            'email' => 'testverify@example.com',
        ]);
        $user->assignRole('verified');
    }


}



