<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Training;
use App\Models\User;

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
            'title'=> $this->faker->realText($maxNbChars = 200, $indexSize = 2) ,
            'date_from'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_to'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
          
            'level'=> $this->faker->randomElement(['national','regional','division']),
            'type'=> $this->faker->randomElement( ['managerial', 'supervisory', 'technical', 'others']),
            'hours' => $this->faker->randomDigit,
            'sponsor' => $this->faker->catchPhrase,
            'employee_id' => Employee::all(['id'])->random(),
            'encoded_by' => $this->faker->name,
            
        ];
    }
}
