<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Training;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Training::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=> $this->faker->unique()->randomNumber(5),
            'firstname'=> $this->faker->firstname,
            'middlename'=> $this->faker->lastname,
            'lastname'=> $this->faker->lastname,
            'gender'=> $this->faker->randomElement(['male','female']),
            'civil_status'=> $this->faker->randomElement(['single','married','divorced','widowed']),
            'employment_status'=> $this->faker->randomElement(['probationary','regular','permanent','resigned','terminated']),
            'email' => $this->faker->unique()->safeEmail,
            'position_id' => Position::all(['id'])->random(),
            'school_id' =>  School::all(['id'])->random(),
            
        ];
    }
}
