<?php

namespace App\DataTables;

use App\Models\InstructorRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InstructorRequestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<InstructorRequest> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.instructor-request.edit', $query->id) . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                $delete = "<a href='" . route('admin.instructor-request.destroy', $query->id) . "' class='btn btn-danger ml-2' id='delete'><i class='fas fa-trash'></i></a>";

                return $edit . $delete;
            })
            ->addColumn('document', function ($query) {
                $edit = "<a href='" . route('admin.instructor-doc-download', $query->id) . "' class='btn btn-primary'><i class='fas fa-download'></i></a>";

                return $edit;
            })
            ->addColumn('status', function ($query) {
                if ($query->approve_status === 'pending') {
                    return '<span class="badge badge-warning">Pending</span>';
                } else if ($query->approve_status === 'approved') {
                    return '<span class="badge badge-primary">Approved</span>';
                }elseif($query->approve_status === 'rejected'){
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->rawColumns(['action', 'document', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<InstructorRequest>
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('approve_status', 'pending')->orWhere('approve_status', 'rejected')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('instructorrequest-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('status'),
            Column::make('document'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'InstructorRequest_' . date('YmdHis');
    }
}
