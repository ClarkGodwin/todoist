<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 * determines through which rules fake datas will be created when we instanciate this class
 * for example with: Task::factory()->count(4)->create()
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
            'day' => now(),
            'status' => $this->faker->randomElement(TaskStatus::cases())->value,
        ];
    }
}
