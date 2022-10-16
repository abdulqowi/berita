<?php

namespace App\DataTables;

use App\Models\Blog;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="dropdown d-inline-block">
                <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn-primary btn-sm text-white"></a>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                    <form action="' . route('blogs.destroy', $row['id']) . '" method="post">
                        ' . csrf_field() . '' . method_field('DELETE') . '
                        <a href="javascript:void(0)" id="showDetails" data-id="'.$row['id'].'" tabindex="0" class="dropdown-item">Detail</a>
                        <a href="' . route('blogs.edit', $row['id']) . '" tabindex="0" class="dropdown-item">Edit</a>
                        <button type="submit" class="dropdown-item">Hapus</button>
                    </form>
                </div>
            </div>';
                return $btn;
            })
            ->rawColumns(['action', 'button']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Blog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Blog::latest()->with('user', 'categories')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('blogs-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Blogs_' . date('YmdHis');
    }
}
