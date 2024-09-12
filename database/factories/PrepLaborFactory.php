<?php

namespace Database\Factories;

use App\Models\PrepLabor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrepLaborFactory extends Factory
{
    protected $model = PrepLabor::class;

    public function definition(): array
    {
        return [
            'seller_id' => \App\Models\Seller::factory(),
            'labor_name' => $this->faker->name(),
            'labor_cost' => $this->faker->randomFloat(2, 20, 500),
        ];
    }
}
