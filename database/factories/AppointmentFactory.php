<?php

namespace Database\Factories;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Appointment>
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
        $startTime = now()->addDays(3)->setTime(9, 0);

        return [
            'patient_id' => Patient::factory(),
            'doctor_id' => Doctor::factory(),
            'start_time' => $startTime,
            'end_time' => $startTime->copy()->addMinutes(30),
            'status' => AppointmentStatus::Pending,
            'cancellation_reason' => null,
        ];
    }
}
