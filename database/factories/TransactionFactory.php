<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status'   => Arr::random(TransactionStatus::cases()),
            'quantity' => rand(1000, 50000000),
        ];
    }
}
