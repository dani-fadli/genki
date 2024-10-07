<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => RolesEnum::SUPERADMIN->value,
                'permissions' => ['*']
            ],
            [
                'name' => RolesEnum::PHARMACIST->value,
                'permissions' => ['*']
            ],
            [
                'name' => RolesEnum::CUSTOMER->value,
                'permissions' => ['*']
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
