<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Http\Livewire\Table;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RoleTable extends Table
{
    protected $route = 'dashboard.roles';

    public function builder(): Builder
    {
        return Role::query()->whereNotIn('id', [1])
            ->when($this->getAppliedFilterWithValue('active') || $this->getAppliedFilterWithValue('active') == '0', function ($query) {
                $query->whereActive($this->getAppliedFilterWithValue('active'));
            })
            ->when($this->getAppliedFilterWithValue('createdAt'), function ($query) {
                $query->whereBetween('created_at', [Str::before($this->getAppliedFilterWithValue('createdAt'), ' - ') . ' 00:00:00', Str::after($this->getAppliedFilterWithValue('createdAt'), ' - ') . ' 23:59:59']);
            })
        ;
    }

    public function columns(): array
    {
        return [

            Column::make(__('ID'), 'id')->searchable()->sortable(),

            Column::make(__('Name'), 'name')->searchable()->sortable(),

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
}
