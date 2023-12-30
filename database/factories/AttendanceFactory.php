<?php

namespace Database\Factories;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTimeThisYear()->format('Y-m-d');

        return [
            'employee_id' => Employee::get()->random()->employee_id,
            'attendance_date' => $date,
            'day' => Carbon::parse($date)->format('l'),
            'time_in' => fake()->dateTimeBetween('08:00:00', '10:00:00')->format('H:i:s'),
            'time_out' => fake()->dateTimeBetween('15:00:00', '18:00:00')->format('H:i:s'),
            'break_time_start' => fake()->dateTimeBetween('11:30:00', '12:30:00')->format('H:i:s'),
            'break_time_end' => fake()->dateTimeBetween('12:30:00', '13:00:00')->format('H:i:s'),
            'working_hours' => fake()->dateTimeBetween('07:00:00', '13:00:00')->format('H:i:s'),
        ];
    }
}
