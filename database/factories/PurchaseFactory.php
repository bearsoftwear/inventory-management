<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_id' => Supplier::inRandomOrder()->first()->id,
            'invoice_number' => $this->faker->unique()->numerify('INVP-' . date('Ym') . '-#####'),
            'purchase_date' => $this->faker->date(),
            'total_amount' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}

