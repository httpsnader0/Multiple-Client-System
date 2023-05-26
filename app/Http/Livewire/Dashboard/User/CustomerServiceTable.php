<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Enums\UserTypeEnum;
use App\Http\Livewire\Table;
use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class CustomerServiceTable extends Table
{
    protected $route = 'dashboard.customer-services';

    public function builder(): Builder
    {
        return User::query()->whereType(UserTypeEnum::CUSTOMER_SERVICE())
            ->when($this->getAppliedFilterWithValue('active') || $this->getAppliedFilterWithValue('active') == '0', function ($query) {
                $query->whereActive($this->getAppliedFilterWithValue('active'));
            })
            ->when($this->getAppliedFilterWithValue('createdAt'), function ($query) {
                $query->whereBetween('created_at', [Str::before($this->getAppliedFilterWithValue('createdAt'), ' - ') . ' 00:00:00', Str::after($this->getAppliedFilterWithValue('createdAt'), ' - ') . ' 23:59:59']);
            })
            ->when($this->getAppliedFilterWithValue('role'), function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->whereId($this->getAppliedFilterWithValue('role'));
                });
            })
        ;
    }

    public function columns(): array
    {
        return [

            Column::make(__('ID'), 'id')->searchable()->sortable(),

            Column::make(__('Profile Image'), 'id')->format(function ($value, $column, $row) {
                return $this->image($column->profile);
            }),

            Column::make(__('Name'), 'name')->searchable()->sortable(),

            Column::make(__('Email Address'), 'email')->searchable()->sortable(),

            Column::make(__('Roles'), 'id')->format(function ($value, $column, $row) {
                return $column->roleId ? '<a href="' . route('dashboard.roles.show', $column->roleId) . '">' . $column->roleName . '</a>' : '';
            })->html()->searchable()->sortable(),

            Column::make(__('Created At'), 'created_at')->format(function ($value, $column, $row) {
                return dateTableFormat($column->created_at);
            })->html()->searchable()->sortable(),

            Column::make(__('Status'), 'active')->format(function ($value, $column, $row) {
                return $this->active($value, $column);
            })->sortable(),

            Column::make(__('Actions'), 'id')->format(function ($value, $column, $row) {
                return $this->action($column);
            }),

        ];
    }

    public function mount()
    {
        $this->getListeners();
    }

    public function getListeners()
    {
        return array_merge($this->listeners, [
            'filterByRole' => 'filterByRole',
        ]);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status', 'active')->options([
                '1' => __('Active'),
                '0' => __('Inactive'),
            ]),
            TextFilter::make('Created At', 'createdAt'),
            SelectFilter::make('Roles', 'role')->options(
                Role::query()->orderByDesc('id')->get()->keyBy('id')->map(fn($query) => $query->name)->toArray()
            ),
        ];
    }

    public function filterByRole($value)
    {
        $this->resetComputedPage();
        $this->setFilter('role', $value);
        $this->emit('refresh');
    }
}
