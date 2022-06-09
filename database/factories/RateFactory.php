<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = ['like', 'dislike'];

        return [
            'user_id' => '1',
            'type' => $type[rand(0, 1)],
            'rateable_id' => '1',
            'rateable_type' => 'asdgdsfgfb'
        ];
    }
}
