<?php

namespace Database\Factories\Domain\Scheduling\Models;

use App\Domain\Scheduling\Models\Scheduling;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchedulingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scheduling::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'doctor_id' => function () {
                return \App\Domain\Doctor\Models\Doctor::factory()->create()->id;
            },
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'animal_name' => $this->faker->firstName,
            'animal_type' => $this->faker->randomElement(['cão', 'gato', 'pássaro', 'réptil']),
            'age' => $this->faker->numberBetween(1, 15),
            'symptoms' => $this->faker->sentence,
            'date' => $this->faker->date(),
            'period' => $this->faker->randomElement(['manhã', 'tarde']),
        ];
    }
}
