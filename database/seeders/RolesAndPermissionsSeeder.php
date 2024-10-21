<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'dashboard',
            'user list',
            'user create',
            'user edit',
            'user delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'system trash list',
            'activity log list',
            'system log list',
            
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign existing permissions
        // Super Admin Role
        $super_admin_role = Role::create(['name' => 'super admin']);

        // Admin Role
        $admin_role = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $admin_role->givePermissionTo($permission);
        }

        // Stuff Role
        $stuff_role = Role::create(['name' => 'stuff']);
        $stuff_role->givePermissionTo('dashboard');
        $stuff_role->givePermissionTo('user list');

        // Student Role
        $student_role = Role::create(['name' => 'student']);
        $student_role->givePermissionTo('dashboard');


        // Guest Role
        $guest_role = Role::create(['name' => 'guest']);

    }
}
