<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::get();
        $users = [
            [
                'email' => 'superadmin@genki.mail',
                'password' => Hash::make('superadmin123#'),
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'roles' => $roles->where('name', RolesEnum::SUPERADMIN->value)->pluck('_id')->toArray(),
                'contacts' => [
                    'phone' => preg_replace('/[^0-9]/', '', fake()->phoneNumber()),
                ],
                'addresses' => [fake()->address()],
                'gender' => fake()->randomElement(['male', 'female']),
            ],
            [
                'email' => 'pharmacist@genki.mail',
                'password' => Hash::make('pharmacist123#'),
                'first_name' => 'Pharmacist',
                'last_name' => 'One',
                'roles' => $roles->where('name', RolesEnum::PHARMACIST->value)->pluck('_id')->toArray(),
                'contacts' => [
                    'phone' => preg_replace('/[^0-9]/', '', fake()->phoneNumber()),
                ],
                'addresses' => [fake()->address()],
                'gender' => fake()->randomElement(['male', 'female']),
            ],
            [
                'email' => 'customer@genki.mail',
                'password' => Hash::make('customer123#'),
                'first_name' => 'Customer',
                'last_name' => 'One',
                'roles' => $roles->where('name', RolesEnum::CUSTOMER->value)->pluck('_id')->toArray(),
                'contacts' => [
                    'phone' => preg_replace('/[^0-9]/', '', fake()->phoneNumber()),
                ],
                'addresses' => [fake()->address()],
                'gender' => fake()->randomElement(['male', 'female']),
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }
    }
}
