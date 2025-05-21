<?php

namespace App\DataTables;

use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CourseCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<CourseCategory> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.course-category.edit', $query->id) . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                $delete = "<a href='" . route('admin.course-category.destroy', $query->id) . "' class='btn btn-danger ml-2' id='delete'><i class='fas fa-trash'></i></a>";

                return $edit . $delete;
            })
            ->addColumn('icon', function($query){
                return '<i style="font-size: 40px;" class="'.$query->icon.'"></i>';
            })
            ->addColumn('status', function($query){
                if($query->status === 1){
                    return '<span class="badge badge-primary">Yes</span>';
                }else if($query->status === 0) {
                    return '<span class="badge badge-danger">No</span>';
                }
            })
            ->addColumn('show_at_trending', function($query){
                if($query->show_at_trending === 1){
                    return '<span class="badge badge-primary">Yes</span>';
                }else if($query->show_at_trending === 0) {
                    return '<span class="badge badge-danger">No</span>';
                }
            })
            ->rawColumns(['action', 'icon', 'status', 'show_at_trending'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<CourseCategory>
     */
    public function query(CourseCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('coursecategory-table')
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
            Column::make('icon'),
            Column::make('name'),
            Column::make('status'),
            Column::make('show_at_trending'),
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
        return 'CourseCategory_' . date('YmdHis');
    }
}
