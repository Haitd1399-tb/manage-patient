<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;

class PatientFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'user_id' => 1,
            'age' => 12,
            'phone_number' => $this->faker->phoneNumber,
            'province_id' => 1,
            'district_id' => 1,
            'ward_id' => 1,
            'village' => $this->faker->text(40),
            'treated' => 0,
            'debit' => 0,
            'validate' => $this->faker->dateTime,
            'anamnesis' => $this->faker->text(100),
            'quanlity' => 1,
            'note' => $this->faker->text(500),
        ];
    }
}
