<?php

namespace Database\Factories;

use App\Enums\RolesEnum;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = 'customer123#';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'password' => Hash::make(static::$password ?? 'password'),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'roles' => Role::where('name', RolesEnum::CUSTOMER->value)->pluck('id')->toArray(),
            'contacts' => [
                'phone' => preg_replace('/[^0-9]/', '', fake()->phoneNumber()),
            ],
            'addresses' => [fake()->address()],
            'gender' => fake()->randomElement(['male', 'female']),
        ];
    }
}
