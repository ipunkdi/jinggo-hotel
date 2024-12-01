<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role
        Role::create(['name' => 'general manager']);
        Role::create(['name' => 'administration & finance manager']);
        Role::create(['name' => 'room division manager']);
        Role::create(['name' => 'front desk']);
        Role::create(['name' => 'housekeeper']);
        Role::create(['name' => 'sales & marketing manager']);

        // Reservation Permissions
        Permission::create(['name' => 'view reservation']);
        Permission::create(['name' => 'create reservation']);
        Permission::create(['name' => 'manage reservation']);
        Permission::create(['name' => 'cancel reservation']);
        Permission::create(['name' => 'no show']);
        Permission::create(['name' => 'edit price']);
        Permission::create(['name' => 'book unavailable offers']);
        Permission::create(['name' => 'book unavailable service']);
        Permission::create(['name' => 'remove warning']);

        // Groups & blocks Permissions
        Permission::create(['name' => 'view groups']);
        Permission::create(['name' => 'create groups']);
        Permission::create(['name' => 'delete groups']);
        Permission::create(['name' => 'manage groups']);
        Permission::create(['name' => 'view blocks']);
        Permission::create(['name' => 'pick reservations']);
        
        // Room rack Permissions
        Permission::create(['name' => 'view room rack']);
        Permission::create(['name' => 'manage room rack']);
        Permission::create(['name' => 'view maintenances']);
        Permission::create(['name' => 'manage out of service maintenances']);
        Permission::create(['name' => 'manage out of order maintenances']);
        Permission::create(['name' => 'manage out of inventory maintenances']);

        // Housekeeping Permissions
        Permission::create(['name' => 'view housekeeping']);
        Permission::create(['name' => 'manage housekeeping']);

        // Availability Permissions
        Permission::create(['name' => 'view availability']);
        Permission::create(['name' => 'manage availability']);

        // Inventory Permissions
        Permission::create(['name' => 'view units']);
        Permission::create(['name' => 'manage units']);
        Permission::create(['name' => 'view unit groups']);
        Permission::create(['name' => 'manage unit groups']);
        Permission::create(['name' => 'view unit attributes']);
        Permission::create(['name' => 'manage unit attributes']);

        // Rates Permissions
        Permission::create(['name' => 'view rates']);
        Permission::create(['name' => 'manage rates']);
        Permission::create(['name' => 'view policies']);
        Permission::create(['name' => 'manage policies']);
        Permission::create(['name' => 'view services']);
        Permission::create(['name' => 'manage services']);
        Permission::create(['name' => 'view age categories']);
        Permission::create(['name' => 'manage age categories']);

        // Finance Permissions
        Permission::create(['name' => 'view accounting']);
        Permission::create(['name' => 'view invoices finance']);
        Permission::create(['name' => 'create invoice']);
        Permission::create(['name' => 'manage open ar invoices']);
        Permission::create(['name' => 'cancel invoices']);
        Permission::create(['name' => 'view receipts']);
        Permission::create(['name' => 'view folios']);
        Permission::create(['name' => 'create folio']);
        Permission::create(['name' => 'manage folio']);
        Permission::create(['name' => 'delete folio']);
        Permission::create(['name' => 'close folio']);
        Permission::create(['name' => 'correct folio']);
        Permission::create(['name' => 'reopen folio']);
        Permission::create(['name' => 'split folio charges']);
        Permission::create(['name' => 'add allowance and refund folio payments']);
        Permission::create(['name' => 'define folio charges manually']);
        Permission::create(['name' => 'add allowance']);
        Permission::create(['name' => 'manage deposit items']);
        Permission::create(['name' => 'add payment']);
        Permission::create(['name' => 'read routing']);
        Permission::create(['name' => 'manage routing']);

        // Payment Permissions
        Permission::create(['name' => 'view invoices payment']);
        Permission::create(['name' => 'view settlements']);
        Permission::create(['name' => 'view payment transaction details']);
        Permission::create(['name' => 'view authorizations']);
        Permission::create(['name' => 'create authorizations']);
        Permission::create(['name' => 'manage authorizations']);

        // Reports Permissions
        Permission::create(['name' => 'view general manager report']);
        Permission::create(['name' => 'view revenues report']);
        Permission::create(['name' => 'view emergency report']);
        Permission::create(['name' => 'view ordered services report']);
        Permission::create(['name' => 'view guest statistic report']);
        Permission::create(['name' => 'view cashier report']);
        Permission::create(['name' => 'view guest count report']);

        // Audit / Logs Permissions
        Permission::create(['name' => 'view reservation logs']);
        Permission::create(['name' => 'view folio logs']);
        Permission::create(['name' => 'view accounting logs']);

        // Settings Permissions
        Permission::create(['name' => 'view account']);
        Permission::create(['name' => 'manage account']);
        Permission::create(['name' => 'view account users']);
        Permission::create(['name' => 'manage account users']);

        // Role & Permissions General Manager
        $roleGeneralManager = Role::findByName('general manager');
        $roleGeneralManager->givePermissionTo('view account');
        $roleGeneralManager->givePermissionTo('manage account');
        $roleGeneralManager->givePermissionTo('view account users');
        $roleGeneralManager->givePermissionTo('manage account users');

        // Role & Permissions Front Desk
        $roleFrontDesk = Role::findByName('front desk');
        $roleFrontDesk->givePermissionTo('view reservation');
        $roleFrontDesk->givePermissionTo('create reservation');
        $roleFrontDesk->givePermissionTo('manage reservation');
        $roleFrontDesk->givePermissionTo('view groups');
        $roleFrontDesk->givePermissionTo('manage groups');
        $roleFrontDesk->givePermissionTo('view blocks');
        $roleFrontDesk->givePermissionTo('pick reservations');
        $roleFrontDesk->givePermissionTo('view room rack');
        $roleFrontDesk->givePermissionTo('manage room rack');
        $roleFrontDesk->givePermissionTo('view maintenances');
        $roleFrontDesk->givePermissionTo('manage out of service maintenances');
        $roleFrontDesk->givePermissionTo('view housekeeping');
        $roleFrontDesk->givePermissionTo('manage housekeeping');
        $roleFrontDesk->givePermissionTo('view availability');
        $roleFrontDesk->givePermissionTo('view invoices finance');
        $roleFrontDesk->givePermissionTo('create invoice');
        $roleFrontDesk->givePermissionTo('cancel invoices');
        $roleFrontDesk->givePermissionTo('view receipts');
        $roleFrontDesk->givePermissionTo('view folios');
        $roleFrontDesk->givePermissionTo('create folio');
        $roleFrontDesk->givePermissionTo('manage folio');
        $roleFrontDesk->givePermissionTo('delete folio');
        $roleFrontDesk->givePermissionTo('add payment');
        $roleFrontDesk->givePermissionTo('read routing');
        $roleFrontDesk->givePermissionTo('manage routing');
        $roleFrontDesk->givePermissionTo('view authorizations');
        $roleFrontDesk->givePermissionTo('create authorizations');
        $roleFrontDesk->givePermissionTo('view emergency report');
        $roleFrontDesk->givePermissionTo('view ordered services report');
        $roleFrontDesk->givePermissionTo('view cashier report');
        $roleFrontDesk->givePermissionTo('view guest count report');
    }
}
