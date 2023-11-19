<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'nim' => fake()->randomNumber(5, true),
      'name' => fake()->name(),
      'gender' => fake()->randomElement(['male', 'female']),
      'graduated_at' => fake()->year(),
    ];
  }
}
