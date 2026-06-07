<?php

namespace Database\Factories;

use App\Models\Availability;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Availability>
 */
class AvailabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = now()->addDays(3)->setTime(9, 0);

        return [
            'doctor_id' => Doctor::factory(),
            'starts_at' => $startsAt,
            'ends_at' => $startsAt->copy()->addHours(3),
            'slot_duration_minutes' => 30,
        ];
    }
}
