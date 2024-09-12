<?php

namespace Database\Factories;

use App\Models\PartInventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartInventoryFactory extends Factory
{
    protected $model = PartInventory::class;

    public function definition()
    {
        return [
            'part_id' => \App\Models\Part::factory(),
            'location_id' => \App\Models\Location::factory(),
            'quantity' => $this->faker->numberBetween(1, 500),
            'last_change_user' => \App\Models\User::factory(),
            'last_change_ts' => now(),
            'seller_id' => \App\Models\Seller::factory(),
        ];
    }
}
