<?php

namespace Database\Factories;

use App\Models\StoreDrug;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreDrugFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreDrug::class;
    /**
     * 
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_Drug' => $this->faker->name,
            'money_Drug' => 100000,
            'quanlity_Drug' => 1,
        ];
    }
}
