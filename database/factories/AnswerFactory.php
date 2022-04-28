<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question_id' => '1',
            'user_id' => '1',
            'text' => $this->faker->realText(300),
            'likeCount' => $this->faker->numberBetween(0, 50),
            'dislikeCount' => $this->faker->numberBetween(0, 50),

        ];
    }
}
