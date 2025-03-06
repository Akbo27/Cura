<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specializations = [
            'Cardiology',
            'Dermatology',
            'Endocrinology',
            'Family Medicine',
            'Gastroenterology',
            'Neurology',
            'Obstetrics',
            'Oncology',
            'Ophthalmology',
            'Orthopedics',
            'Pediatrics',
            'Psychiatry',
            'Radiology',
            'Urology'
        ];

        return [

            'name' => $this->faker->name(),
            'specialization' => $this->faker->randomElement($specializations),
            'hospital_id' => Hospital::factory(),
            //
        ];
    }
}
