<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    protected $model = PurchaseOrder::class;

    public function definition()
    {
        return [
            'po_number' => $this->faker->unique()->numerify('PO-#####'),
            'supplier_id' => \App\Models\Supplier::factory(),
            'total_amount' => $this->faker->randomFloat(2, 100, 10000),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'seller_id' => \App\Models\Seller::factory(),
        ];
    }
}
