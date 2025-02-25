<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales>
 */
class SalesFactory extends Factory
{
    protected $model = Sales::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'invoice_number' => $this->faker->unique()->numerify('INVS-' . date('Ym') . '-#####'),
            'sale_date' => $this->faker->date(),
            'total_amount' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
