<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder('id')->first()->id,
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'day' => $this->faker->now(),
            'status' => $this->faker->randomElement(TaskStatus::cases())->value,
        ];
    }
}
