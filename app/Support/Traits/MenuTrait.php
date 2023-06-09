<?php
namespace App\Support\Traits;

trait MenuTrait
{
    public function menu()
    {
        return [
            'Products' => [
                [
                    'permissions' => 'Index Product',
                    'icon' => 'bi bi-list-nested',
                    'title' => __('Products'),
                    'route' => route('dashboard.products.index'),
                    'active' => 'dashboard.products.*',
                ],
                [
                    'permissions' => 'Report',
                    'icon' => 'bi bi-list-nested',
                    'title' => __('Reports'),
                    'route' => route('dashboard.reports.index'),
                    'active' => 'dashboard.reports.*',
                ],
            ],
            'Users' => [
                [
                    'permissions' => 'Index Role',
                    'icon' => 'bi bi-shield-lock',
                    'title' => __('Roles'),
                    'route' => route('dashboard.roles.index'),
                    'active' => 'dashboard.roles.*',
                ],
                [
                    'permissions' => 'Index Administrator',
                    'icon' => 'bi bi-people',
                    'title' => __('Administrators'),
                    'route' => route('dashboard.administrators.index'),
                    'active' => 'dashboard.administrators.*',
                ],
                [
                    'permissions' => 'Index Customer Service',
                    'icon' => 'bi bi-people',
                    'title' => __('Customer Services'),
                    'route' => route('dashboard.customer-services.index'),
                    'active' => 'dashboard.customer-services.*',
                ],
                [
                    'permissions' => 'Index User',
                    'icon' => 'bi bi-people',
                    'title' => __('Users'),
                    'route' => route('dashboard.users.index'),
                    'active' => 'dashboard.users.*',
                ],
                [
                    'permissions' => 'Index Client',
                    'icon' => 'bi bi-people',
                    'title' => __('Clients'),
                    'route' => route('dashboard.clients.index'),
                    'active' => 'dashboard.clients.*',
                ],
            ],
        ];
    }
}
