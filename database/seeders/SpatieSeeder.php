<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'manager', 'staff'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $models = ['category', 'customer', 'product', 'purchase', 'sales', 'supplier', 'user'];
        $permissions = ['index', 'create', 'store', 'show', 'edit', 'update', 'delete'];
        foreach ($models as $model) {
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission . ' ' . $model]);
            }
        }

        $givePermitionTo = ['admin' => $models, 'manager' => ['product', 'purchase', 'sales'], 'staff' => ['product', 'purchase', 'sales']];
        foreach ($givePermitionTo as $role => $roleModels) {
            foreach ($roleModels as $model) {
                foreach ($permissions as $permission) {
                    echo $role . ' can ' . $permission . ' ' . $model . PHP_EOL;
                    $roleInstance = Role::findByName($role);
                    $permission = Permission::findByName($permission . ' ' . $model);
                    $roleInstance->givePermissionTo($permission);
                }
            }
        }
    }
}
