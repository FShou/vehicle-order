<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = ['passanger', 'cargo'];
        $fuel_type = ['solar', 'pertalite', 'pertamax'];
        $status = ['need_maintenance', 'maintenance', 'in_use','available'];
        return [
           'licence_plate' => strtoupper(Str::random(8)),
            'remaining_fuel_bar' => rand(0,4),
            'distance_covered' => rand(0,10000),
            'type' => $type[array_rand($type)],
            'fuel_type' => $fuel_type[array_rand($fuel_type)],
            'status' => $status[array_rand($status)],
            'last_maintenance_date' => $this->faker->dateTimeBetween('-1 Month','now'),
            'lease_expiration_date' => $this->faker->dateTimeBetween('+1 Day', '+1 Month')
        ];
    }
}
