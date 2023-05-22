<?php
namespace App\Support\Traits;

trait PermissionTrait
{
    public function permissions()
    {
        $permissionGroups = [
            'Users' => [
                'Role',
                'Administrator',
                'Customer Service',
                'User',
                'Client',
            ],
        ];
        
        $permissionMaps = [
            'Index',
            'Create',
            'Show',
            'Edit',
            'Delete',
            'Active',
        ];

        return [
            'permissionGroups' => $permissionGroups,
            'permissionMaps' => $permissionMaps,
        ];
    }
}
