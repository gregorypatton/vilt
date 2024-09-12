<?php

namespace Database\Factories;

use App\Models\Part;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartFactory extends Factory
{
    protected $model = Part::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'stock_quantity' => $this->faker->numberBetween(1, 1000),
            'supplier_id' => \App\Models\Supplier::factory(),
            'seller_id' => \App\Models\Seller::factory(),
        ];
    }
}
