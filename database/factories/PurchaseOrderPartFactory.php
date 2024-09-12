<?php

namespace Database\Factories;

use App\Models\PurchaseOrderPart;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderPartFactory extends Factory
{
    protected $model = PurchaseOrderPart::class;

    public function definition()
    {
        return [
            'purchase_order_id' => \App\Models\PurchaseOrder::factory(),
            'part_id' => \App\Models\Part::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'cost' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
