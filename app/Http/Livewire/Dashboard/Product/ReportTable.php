<?php

namespace App\Http\Livewire\Dashboard\Product;

use App\Http\Livewire\Table;
use App\Models\Product\Purchase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ReportTable extends Table
{
    public function builder(): Builder
    {
        return Purchase::query()
            ->when($this->getAppliedFilterWithValue('createdAt'), function ($query) {
                $query->whereBetween('created_at', [Str::before($this->getAppliedFilterWithValue('createdAt'), ' - ') . ' 00:00:00', Str::after($this->getAppliedFilterWithValue('createdAt'), ' - ') . ' 23:59:59']);
            })
        ;
    }

    public function columns(): array
    {
        return [

            Column::make(__('ID'), 'id')->searchable()->sortable(),

            Column::make(__('Client'), 'user_id')->format(function ($value, $column, $row) {
                return $column->user ? '<a href="' . route('dashboard.clients.show', $column->user_id) . '">' . $column->user->name . '</a>' : '';
            })->html()->searchable()->sortable(),

            Column::make(__('User'), 'product_id')->format(function ($value, $column, $row) {
                return $column->product ? ($column->product->user ? '<a href="' . route('dashboard.users.show', $column->product->user_id) . '">' . $column->product->user->name . '</a>' : '') : '';
            })->html()->searchable()->sortable(),

            Column::make(__('Product'), 'product_id')->format(function ($value, $column, $row) {
                return $column->product ? '<a href="' . route('dashboard.products.show', $column->product_id) . '">' . $column->product->name . '</a>' : '';
            })->html()->searchable()->sortable(),

            Column::make(__('Total'), 'total')->searchable()->sortable(),

            Column::make(__('Created At'), 'created_at')->format(function ($value, $column, $row) {
                return dateTableFormat($column->created_at);
            })->html()->searchable()->sortable(),

        ];
    }
}
