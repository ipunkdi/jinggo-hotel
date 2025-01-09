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
        $roles = [
            'general manager',
            'administration & finance manager',
            'room division manager',
            'front desk',
            'housekeeper',
            'sales & marketing manager'
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role], ['name' => $role]);
        }

        $permissions = [
        // Reservation Permissions
        'view reservation',
        'create reservation',
        'manage reservation',
        'cancel reservation',
        'no show',
        'edit price',
        'book unavailable offers',
        'book unavailable service',
        'remove warning',

        // Groups & blocks Permissions
        'view groups',
        'create groups',
        'delete groups',
        'manage groups',
        'view blocks',
        'pick reservations',
        
        // Room rack Permissions
        'view room rack',
        'manage room rack',
        'view maintenances',
        'manage out of service maintenances',
        'manage out of order maintenances',
        'manage out of inventory maintenances',

        // Housekeeping Permissions
        'view housekeeping',
        'manage housekeeping',

        // Availability Permissions
        'view availability',
        'manage availability',

        // Inventory Permissions
        'view units',
        'manage units',
        'view unit groups',
        'manage unit groups',
        'view unit attributes',
        'manage unit attributes',

        // Rates Permissions
        'view rates',
        'manage rates',
        'view policies',
        'manage policies',
        'view services',
        'manage services',
        'view age categories',
        'manage age categories',

        // Finance Permissions
        'view accounting',
        'view invoices finance',
        'create invoice',
        'manage open ar invoices',
        'cancel invoices',
        'view receipts',
        'view folios',
        'create folio',
        'manage folio',
        'delete folio',
        'close folio',
        'correct folio',
        'reopen folio',
        'split folio charges',
        'add allowance and refund folio payments',
        'define folio charges manually',
        'add allowance',
        'manage deposit items',
        'add payment',
        'read routing',
        'manage routing',

        // Payment Permissions
        'view invoices payment',
        'view settlements',
        'view payment transaction details',
        'view authorizations',
        'create authorizations',
        'manage authorizations',

        // Reports Permissions
        'view general manager report',
        'view revenues report',
        'view emergency report',
        'view ordered services report',
        'view guest statistic report',
        'view cashier report',
        'view guest count report',

        // Audit / Logs Permissions
        'view reservation logs',
        'view folio logs',
        'view accounting logs',

        // Settings Permissions
        'view account',
        'manage account',
        'view account users',
        'manage account users',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission], ['name' => $permission]);
        }

        $rolesPermissions = [
            'general manager' => Permission::all(),

            'administration & finance manager' => [
                // permissions
            ],

            'room division manager' => [
                // permissions
            ],

            'front desk' => [
                'view reservation',
                'create reservation',
                'manage reservation',
                'view groups',
                'manage groups',
                'view blocks',
                'pick reservations',
                'view room rack',
                'manage room rack',
                'view maintenances',
                'manage out of service maintenances',
                'view housekeeping',
                'manage housekeeping',
                'view availability',
                'view invoices finance',
                'create invoice',
                'cancel invoices',
                'view receipts',
                'view folios',
                'create folio',
                'manage folio',
                'delete folio',
                'add payment',
                'read routing',
                'manage routing',
                'view authorizations',
                'create authorizations',
                'view emergency report',
                'view ordered services report',
                'view cashier report',
                'view guest count report',
            ],

            'housekeeper' => [
                // permissions
            ],

            'sales & marketing manager' => [
                // permissions
            ],
        ];
    }
}
