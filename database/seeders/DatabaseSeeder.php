<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Seller;
use App\Models\Contractor;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Greg Seller user
        $gregSeller = User::create([
            'name' => 'Greg Seller',
            'email' => 'greg_seller@patton.dev',
            'password' => Hash::make('password'),
            'is_administrator' => true,
        ]);

        // Create a Seller profile for Greg Seller
        $seller = Seller::create([
            'name' => 'Greg\'s Business',
            'subscription_status' => 'active',
            'user_id' => $gregSeller->id,
        ]);

        // Create Greg Contractor user
        $gregContractor = User::create([
            'name' => 'Greg Contractor',
            'email' => 'greg_contractor@patton.dev',
            'password' => Hash::make('password'),
        ]);

        // Create a Contractor profile for Greg Contractor
        $contractor = Contractor::create([
            'user_id' => $gregContractor->id,
            'name' => 'Greg Contractor',
            'email' => 'greg_contractor@patton.dev',
            'phone_number' => '123-456-7890',
            'pin_number' => Hash::make('0000'),
        ]);

        // Seed locations for the seller
        $locations = \App\Models\Location::factory(3)->create(['seller_id' => $seller->id]);

        // Seed products for the seller
        $products = \App\Models\Product::factory(10)->create(['seller_id' => $seller->id])->each(function ($product) {
            \App\Models\ProductPart::factory(5)->create(['product_id' => $product->id]);
        });

        // Seed parts and inventory for the seller
        $parts = \App\Models\Part::factory(10)->create(['seller_id' => $seller->id])->each(function ($part) use ($locations, $seller) {
            \App\Models\PartInventory::factory(5)->create([
                'part_id' => $part->id,
                'location_id' => $locations->random()->id,
                'last_change_user' => $seller->user_id,  // Assuming this tracks who last changed the inventory
                'seller_id' => $seller->id,
                'last_change_ts' => now(),
            ]);
        });

        // Seed suppliers
        $suppliers = \App\Models\Supplier::factory(5)->create();

        // Seed purchase orders and purchase order parts for the seller
        $purchaseOrders = \App\Models\PurchaseOrder::factory(5)->create(['seller_id' => $seller->id, 'supplier_id' => $suppliers->random()->id])->each(function ($po) use ($parts) {
            \App\Models\PurchaseOrderPart::factory(3)->create([
                'purchase_order_id' => $po->id,
                'part_id' => $parts->random()->id,
            ]);
        });

        // Seed work orders for the contractor with valid purchase_order_id
        $workOrders = \App\Models\WorkOrder::factory(5)->create([
            'contractor_id' => $contractor->id,
            'purchase_order_id' => $purchaseOrders->random()->id,  // Assign random purchase order
        ])->each(function ($workOrder) use ($products) {
            // Seed work order line items with a valid product_id
            \App\Models\WorkOrderLineItem::factory(3)->create([
                'work_order_id' => $workOrder->id,
                'product_id' => $products->random()->id,  // Assign random product
                'total_required' => rand(1, 10),  // Required field
                'total_completed' => rand(0, 5),  // Required field
            ]);
        });

        // Seed contractor signoffs for the work orders
        $workOrders->each(function ($workOrder) use ($contractor) {
            $workOrder->lineItems->each(function ($lineItem) use ($contractor) {
                \App\Models\ContractorSignoff::factory(1)->create([
                    'work_order_line_item_id' => $lineItem->id,
                    'contractor_id' => $contractor->id,
                    'quantity_signed' => rand(1, $lineItem->total_required),  // Signed off amount
                    'signed_at' => now(),
                ]);
            });
        });

        // Seed prep labors for the seller
        \App\Models\PrepLabor::factory(2)->create(['seller_id' => $seller->id, 'labor_name' => 'Labor 1', 'labor_cost' => rand(50, 200)]);

        // Seed reports for Greg Seller
        \App\Models\Report::factory(10)->create(['user_id' => $gregSeller->id]);

        // Seed settlements for the seller
        \App\Models\Settlement::factory(5)->create([
            'seller_id' => $seller->id,
            'amount' => rand(1000, 5000),
            'status' => 'pending',  // Required field
        ]);
    }
}
