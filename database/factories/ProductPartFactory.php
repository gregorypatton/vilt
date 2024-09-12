<?php

namespace Database\Factories;

use App\Models\ProductPart;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPartFactory extends Factory
{
    protected $model = ProductPart::class;

    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'part_id' => \App\Models\Part::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
