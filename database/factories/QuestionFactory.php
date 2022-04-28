<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Database\Factories\Creators\Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'title' =>  $this->faker->realText(30),
            'text' => $this->faker->realText(1000),
            'likeCount' => $this->faker->numberBetween(0, 50),
            'dislikeCount' => $this->faker->numberBetween(0, 50),
            'user_id' => '1'
        ];
    }
}
