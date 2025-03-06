<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['scheduled', 'completed', 'cancelled'];
        $appointmentDate = $this->faker->dateTimeBetween('now', '+30 days');
        $appointmentTime = ['9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
        return [
            'user_id' => User::factory(),
            'doctor_id' => Doctor::factory(),
            'appointment_date' => $appointmentDate,
            'appointment_time' => $this->faker->randomElement($appointmentTime),
            'status'=> $this->faker->randomElement($statuses),
            //
        ];
    }
}
