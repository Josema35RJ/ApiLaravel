<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mood>
 */
class MoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'emotion_id' => \App\Models\Emotion::all()->random()->id,
            'description' => fake()->paragraph,
            'deleted' => 0,
        ];
    }
}
