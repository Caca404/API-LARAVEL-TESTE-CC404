<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// Factory is a class to padronize a new object to put into database, consequently, it helps to code
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Faker is a package that helps the factory to randomize a new object 
        $type = $this->faker->randomElement(['PJ', 'PF']);
        $name = $type == 'PF' ? $this->faker->name() : $this->faker->company();

        return [
            "name" => $name,
            "type" => $type,
            "email" => $this->faker->email(),
            "address" => $this->faker->address(),
            "city" => $this->faker->city(),
            "state" => $this->faker->state(),
            "postal_code" => $this->faker->postcode()
        ];
    }
}
