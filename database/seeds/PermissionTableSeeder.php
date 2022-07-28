<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'user-list',
           'user-create',
           'user-edit',
           'user-delete',

           'car-list',
           'car-create',
           'car-edit',
           'car-delete',

           'shop-list',
           'shop-create',
           'shop-edit',
           'shop-delete',

           'township-list',
           'township-create',
           'township-edit',
           'township-delete',

           'state-division-list',
           'state-division-create',
           'state-division-edit',
           'state-division-delete',

           'licence-group-list',
           'licence-group-create',
           'licence-group-edit',
           'licence-group-delete',

           'licence-sub-list',
           'licence-sub-create',
           'licence-sub-edit',
           'licence-sub-delete',

           'licence-list',
           'licence-create',
           'licence-edit',
           'licence-delete',

           'licence-fee-list',
           'licence-fee-create',
           'licence-fee-edit',
           'licence-fee-delete'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
