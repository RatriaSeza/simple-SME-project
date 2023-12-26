<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employee = new Employee();
        $join_date = fake()->date();

        return [
            'employee_id' => $employee->generate_id($join_date),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'nick_name' => fake()->firstName(),
            'birth_date' => fake()->date(),
            'position' => fake()->name(),
            'gender' => collect(Employee::GENDER)->random(),
            'education' => fake()->word(),
            'id_number' => fake()->isbn13(),
            'marital_status' => collect(Employee::MARITAL_STATUS)->random(),
            'join_date' => $join_date,
        ];
    }
}
