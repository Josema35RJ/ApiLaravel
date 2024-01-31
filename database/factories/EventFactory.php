<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Node\Block\Paragraph;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event' => fake()->name(),
            'user_id' => \App\Models\User::all()->random()->id,
            'emotion_id' => \App\Models\Emotion::all()->random()->id,
            'description' =>  fake()->paragraph,
            'deleted' => 0,
        ];
    }
}
