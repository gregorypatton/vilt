<?php

namespace Database\Factories;

use App\Models\ContractorSignoff;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractorSignoffFactory extends Factory
{
    protected $model = ContractorSignoff::class;

    public function definition(): array
    {
        return [
            'contractor_id' => \App\Models\Contractor::factory(),
            'work_order_line_item_id' => \App\Models\WorkOrderLineItem::factory(),
            'quantity_signed' => $this->faker->numberBetween(1, 100),
            'signed_at' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
