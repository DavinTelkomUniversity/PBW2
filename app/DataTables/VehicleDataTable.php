<?php

namespace App\DataTables;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VehicleDataTable extends DataTable
{
    /**
     *
     * @param QueryBuilder $query Results from query() method.
     */
    // Nama    : Davin Wahyu Wardana
    // NIM     : 6706223003
    // Kelas   : D3IF-4603
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('typeId', function($data) {
            return $data->types->name;
        })
        ->editColumn('status', function ($data) {
            switch ($data->status) {
                case 1:
                    return 'Pinjam';
                    break;
                case 2:
                    return 'Tersedia';
                    break;
                case 3:
                    return 'Hilang';
                    break;
                default:
                    return 'Tidak Diketahui';
            }
        })
        ->editColumn('action', function($data) {
            return view('vehicle.actionVehicle', ['id' => $data->id]);
        })
        ->editColumn('created_at', function ($data) {
            return $data->created_at->format('Y-m-d H:i:s');
        })
        ->editColumn('updated_at', function ($data) {
            return $data->updated_at->format('Y-m-d H:i:s');
        });
    }

    public function query(Vehicle $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vehicle-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add')
                        ->action('window.location.href = "'.route('vehicle.registrasi').'"')
                        ->className('btn-dark')
                        ->text('Tambah'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }
    // Nama    : Davin Wahyu Wardana
    // NIM     : 6706223003
    // Kelas   : D3IF-4603
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('typeId'),
            Column::make('license'),
            Column::make('dailyPrice'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center')
            ->searchable(false)
            ->orderable(false),
        ];
    }
    // Nama    : Davin Wahyu Wardana
    // NIM     : 6706223003
    // Kelas   : D3IF-4603
    protected function filename(): string
    {
        return 'Vehicle_' . date('YmdHis');
    }
}