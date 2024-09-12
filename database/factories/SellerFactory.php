<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    protected $model = Seller::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'subscription_status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
