<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create Permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage sellers']);
        Permission::create(['name' => 'manage products']);
        Permission::create(['name' => 'manage work-orders']);
        Permission::create(['name' => 'manage roles and permissions']);
        Permission::create(['name' => 'manage signoffs']); // Added to avoid undefined permission issue

        Permission::create(['name' => 'print labels']);
        Permission::create(['name' => 'generate reports']);
        Permission::create(['name' => 'view all reports']);
        Permission::create(['name' => 'view production reports']);
        Permission::create(['name' => 'view office reports']);

        Permission::create(['name' => 'manage contractors']);
        Permission::create(['name' => 'sign off work']);
        Permission::create(['name' => 'view work-orders']);
        Permission::create(['name' => 'view signoffs']); // New permission for former contractors

        // Create Roles
        $adminRole = Role::create(['name' => 'administrator']);
        $sellerRole = Role::create(['name' => 'seller']);
        $formerContractorRole = Role::create(['name' => 'former_contractor']);
        $contractorRole = Role::create(['name' => 'contractor']);
        $contractorLeadRole = Role::create(['name' => 'contractor_lead']); // New role for contractor leads

        // Assign Permissions to Administrator
        $adminRole->givePermissionTo([
            'manage users',
            'manage sellers',
            'manage products',
            'manage work-orders',
            'view all reports',
            'generate reports',
            'manage contractors',
            'manage roles and permissions',
            'print labels',
        ]);

        // Assign Permissions to Seller
        $sellerRole->givePermissionTo([
            'manage products',
            'manage signoffs',
            'manage work-orders',
            'view all reports',
            'generate reports',
            'manage contractors',
            'print labels',
        ]);

        // Assign Permissions to Contractor
        $contractorRole->givePermissionTo([
            'view work-orders',
            'sign off work',
            'view production reports',
        ]);

        // Assign Permissions to Former Contractor
        $formerContractorRole->givePermissionTo([
            'view work-orders',
            'view signoffs',
            'view production reports',
        ]);

        // Assign Permissions to Contractor Lead
        $contractorLeadRole->givePermissionTo([
            'view work-orders',
            'sign off work',
            'view production reports',
            'manage work-orders',    // Can manage work-orders
            'generate reports',      // Can generate relevant reports
        ]);
    }
}
