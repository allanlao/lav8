<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->company(50),
            'division' =>$this->faker->randomElement(['Ilocos Sur','Ilocos Norte','La Union','Pangasinan I']),
            'district' =>$this->faker->numberBetween(1,5)
        ];
    }
}