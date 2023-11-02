<?php

namespace App\DataTables;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('startDate', function ($data) {
            return $data->startDate;
        })
        ->editColumn('endDate', function ($data) {
            return $data->endDate;
        })
        ->editColumn('userId', function ($data) {
            return User::find($data->userId)->name;
        })
        ->editColumn('vehicleId', function ($data) {
            return Vehicle::find($data->vehicleId)->name;
        })
        ->editColumn('status', function ($data) {
            return $data->status;
        })
            ->editColumn('action', function($data) {
                return view('transaction.actionTransaction', ['id' => $data->id]);
            });
    }

    public function query(Transaction $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transaction-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('add')
                    ->action('window.location.href = "'.route('transaction.registrasi').'"')
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

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('userId')
                ->title('Petugas')
                ->searchable(false),
            Column::make('vehicleId')
                ->title('Vehicle')
                ->searchable(false),
            Column::make('startDate')
                ->title('Tanggal Pinjam'),
            Column::make('endDate')
                ->title('Tanggal Selesai'),
            Column::make('status')
                ->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->searchable(false)
                ->orderable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Transaction_' . date('YmdHis');
    }
}
