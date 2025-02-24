<?php

namespace Database\Seeders;

use BalajiDharma\LaravelCategory\Models\CategoryType;
use BalajiDharma\LaravelMenu\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminCoreSeeder extends Seeder
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
            'admin user',
            'user list',
            'user create',
            'user edit',
            'user delete',
            'menu list',
            'menu create',
            'menu edit',
            'menu delete',
            'menu.item list',
            'menu.item create',
            'menu.item edit',
            'menu.item delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role1 = Role::firstOrCreate(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $role2 = Role::firstOrCreate(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $role2->givePermissionTo($permission);
        }

        // create roles and assign existing permissions
        $role3 = Role::firstOrCreate(['name' => 'writer']);
        $role3->givePermissionTo('admin user');
        foreach ($permissions as $permission) {
            if (Str::contains($permission, 'list')) {
                $role3->givePermissionTo($permission);
            }
        }

        // create demo users
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            array_merge(\App\Models\User::factory()->raw(), [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com'
            ])
        );
        $user->assignRole($role1);

        $user = \App\Models\User::firstOrCreate(
            ['email' => 'admin@example.com'],
            array_merge(\App\Models\User::factory()->raw(), [
                'name' => 'Admin User',
                'email' => 'admin@example.com'
            ])
        );
        $user->assignRole($role2);

        $user = \App\Models\User::firstOrCreate(
            ['email' => 'test@example.com'],
            array_merge(\App\Models\User::factory()->raw(), [
                'name' => 'Example User',
                'email' => 'test@example.com'
            ])
        );
        $user->assignRole($role3);

        // create menu
        $menu = Menu::firstOrCreate(
            ['machine_name' => 'admin'],
            [
                'name' => 'Admin',
                'description' => 'Admin Menu',
            ]
        );

        $menu_items = [
            [
                'name' => 'Dashboard',
                'uri' => '/<admin>',
                'enabled' => 1,
                'weight' => 0,
                'icon' => 'M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z',
            ],
            [
                'name' => 'Users',
                'uri' => '/<admin>/user',
                'enabled' => 1,
                'weight' => 3,
                'icon' => 'M16 17V19H2V17S2 13 9 13 16 17 16 17M12.5 7.5A3.5 3.5 0 1 0 9 11A3.5 3.5 0 0 0 12.5 7.5M15.94 13A5.32 5.32 0 0 1 18 17V19H22V17S22 13.37 15.94 13M15 4A3.39 3.39 0 0 0 13.07 4.59A5 5 0 0 1 13.07 10.41A3.39 3.39 0 0 0 15 11A3.5 3.5 0 0 0 15 4Z',
            ],
            [
                'name' => 'Payment',
                'uri' => '/<admin>/payment',
                'enabled' => 1,
                'weight' => 3,
                'icon' => 'M21 7H3V5H21V7M21 17H3V9H21V17M19 14A1 1 0 1 0 17 14A1 1 0 0 0 19 14Z',
            ],
            
        ];

        foreach ($menu_items as $item) {
            $menu->menuItems()->updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }

        $category_types = [
            
        ];

        foreach ($category_types as $category_type) {
            CategoryType::updateOrCreate(
                ['machine_name' => $category_type['machine_name']],
                $category_type
            );
        }

        $forumCategoryType = CategoryType::firstWhere(['machine_name' => 'forum_category']);

        $forumCategoryType->categories()->updateOrCreate(
            ['name' => 'General'],
            [
                'description' => 'General Forum Category',
                'name' => 'General'
            ]
        );
    }
}
