<?php

namespace Database\Factories;

use App\Models\WorkOrderLineItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkOrderLineItem>
 */
class WorkOrderLineItemFactory extends Factory
{
    protected $model = WorkOrderLineItem::class;

    public function definition(): array
    {
        return [
            'work_order_id' => \App\Models\WorkOrder::factory(),
            'product_id' => \App\Models\Product::factory(),
            'total_required' => $this->faker->numberBetween(1, 100),
            'total_completed' => $this->faker->numberBetween(0, 100),
        ];
    }
}
