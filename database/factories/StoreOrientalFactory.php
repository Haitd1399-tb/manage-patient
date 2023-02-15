<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoreOrientalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_Oriental' => $this->faker->text(50),
            'note_Oriental' => $this->faker->text(500),
        ];
    }
}
