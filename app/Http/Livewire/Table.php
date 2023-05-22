<?php

namespace App\Http\Livewire;

use App\Models\User\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class Table extends DataTableComponent
{
    protected $actionDisplay = ['show', 'edit', 'delete'];

    public $enableBulk = false, $orderBy = 'id', $orderType = 'desc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-hover table-row-bordered gy-5 gs-7 border table-rounded',
        ]);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'text-center align-middle text-nowrap bg-light',
            ];
        });
        $this->setTdAttributes(function (Column $column) {
            return [
                'class' => 'text-center align-middle',
            ];
        });
        $this->setFooterTdAttributes(function (Column $column) {
            return [
                'class' => 'text-nowrap border border-right-0 border-left-0 bg-light',
            ];
        });
        $this->setDefaultSort($this->orderBy, $this->orderType);
        $this->setDefaultSortingLabels(__('Ascending'), __('Descending'));
        if ($this->enableBulk) {
            $this->setBulkActions(['selectedExportExcel' => 'Export Excel']);
        }
        $this->setAdditionalSelects('*');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setPerPage(10);
        $this->setFooterEnabled();
    }

    public function builder(): Builder
    {
        return Role::query();
    }

    public function columns(): array
    {
        return [];
    }

    protected function image($profile)
    {
        return view('dashboard.layouts.packages.livewire.images', ['profile' => $profile]);
    }

    protected function active($active, $query)
    {
        return view('dashboard.layouts.packages.livewire.active', ['active' => $active, 'id' => $query->id, 'route' => $this->route]);
    }

    protected function action($query, $extra = '')
    {
        $content = '';
        if (in_array('show', $this->actionDisplay)) {
            $content .= view('dashboard.layouts.packages.livewire.show', ['route' => $this->route, 'id' => $query->id]);
        }
        if (in_array('edit', $this->actionDisplay)) {
            $content .= view('dashboard.layouts.packages.livewire.edit', ['route' => $this->route, 'id' => $query->id]);
        }
        if (in_array('delete', $this->actionDisplay)) {
            $content .= view('dashboard.layouts.packages.livewire.delete', ['route' => $this->route, 'id' => $query->id]);
        }
        return view('dashboard.layouts.packages.livewire.actions', compact('content', 'extra'));
    }

    protected $listeners = [
        'refresh' => '$refresh',
        'filterByActive' => 'filterByActive',
        'filterByCreatedAt' => 'filterByCreatedAt',
    ];

    public function filters(): array
    {
        return [
            SelectFilter::make('Status', 'active')->options([
                '1' => __('Active'),
                '0' => __('Inactive'),
            ]),
            TextFilter::make('Created At', 'createdAt'),
        ];
    }

    public function filterByActive($value)
    {
        $this->resetComputedPage();
        $this->setFilter('active', $value);
        $this->emit('refresh');
    }

    public function filterByCreatedAt($value)
    {
        $this->resetComputedPage();
        $this->setFilter('createdAt', $value == null ? null : Carbon::parse($value[0])->format('Y-m-d') . ' - ' . Carbon::parse($value[1])->format('Y-m-d'));
        $this->emit('refresh');
    }
}
