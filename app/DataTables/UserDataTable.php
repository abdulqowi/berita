<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('button', function ($row) {
                $btn = '
                    <a class="btn btn-sm btn-success" href="javascript:void(0)" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#showModal">Button</a>
                ';
                return $btn;
            })
            ->addColumn('action', function ($row) {
                $btn =
                '<div class="dropdown d-inline-block">
                    <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn-primary btn-sm text-white"></a>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                        <form action="" method="post">
                            <a href="javascript:void(0)" id="showDetails" data-id="' . $row['id'] . '" tabindex="0" class="dropdown-item">Detail</a>
                            <a href="' . route('users.edit', $row['id']) . '" tabindex="0" class="dropdown-item">Edit</a>
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
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('user-table')
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
        return 'User_' . date('YmdHis');
    }
}
