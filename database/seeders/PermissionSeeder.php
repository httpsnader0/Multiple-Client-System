<?php

namespace Database\Seeders;

use App\Models\User\Role;
use App\Support\Traits\PermissionTrait;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    use PermissionTrait;

    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            [
                'ar' => 'مدير',
                'en' => 'Administrator',
            ],
            [
                'ar' => 'مستخدم',
                'en' => 'User',
            ],
            [
                'ar' => 'مشرف',
                'en' => 'Customer Service',
            ],
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => [
                    'ar' => $role['ar'],
                    'en' => $role['en'],
                ],
            ]);
        }

        foreach ($this->permissions()['permissionGroups'] as $permissionGroup) {
            foreach ($permissionGroup as $permission) {
                if (is_array($permission)) {
                    foreach ($permission as $singlePermission) {
                        Permission::create([
                            'name' => $singlePermission,
                        ]);
                    }
                } else {
                    foreach ($this->permissions()['permissionMaps'] as $permissionMap) {
                        Permission::create([
                            'name' => $permissionMap . ' ' . $permission,
                        ]);
                    }
                }
            }
        }

        Role::find(2)->givePermissionTo(Permission::whereIn('id', [1, 2, 3, 4, 5, 6])->get());
    }
}
