<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role = fake()->randomElement(['user', 'admin', 'super_admin']);

        return [
            'title' => fake()->randomElement(['Mr.', 'Ms.', 'Mrs.', 'Dr.']),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
            'last_name' => fake()->lastName(),
            'phone' => fake()->optional()->phoneNumber(),
            'address' => fake()->optional()->streetAddress(),
            'city' => fake()->optional()->city(),
            'state' => fake()->optional()->state(),
            'country' => fake()->optional()->country(),
            'zip_code' => fake()->optional()->postcode(),
            'is_user' => $role === 'user',
            'is_admin' => $role === 'admin',
            'is_super_admin' => $role === 'super_admin',
            'profile_picture' => fake()->optional()->imageUrl(640, 480, 'people'),
            'locale' => fake()->locale(),
            'timezone' => fake()->timezone(),
            'theme' => fake()->randomElement(['light', 'dark']),
            'language' => fake()->randomElement(['en', 'es', 'fr', 'de', 'zh']),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
