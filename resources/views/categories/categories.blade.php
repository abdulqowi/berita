@extends('layouts/app', ['title' => 'Kategori'])

@section('content')
@include('sweetalert::alert')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Kategori
                        <div class="page-title-subheading">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="active breadcrumb-item" aria-current="page">Kategori</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('categories.create') }}" class="btn-shadow btn-sm mr-3 btn btn-primary">
                        Tambah
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-header">
                <h5 class="card-title">Data Kategori</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="mb-0 table table-striped table-hover table-bordered table-sm" id="data-table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center" width="3%">No</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th class="text-center" width="3%"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $example)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $example->name }}</td>
                                <td>{{ $example->slug }}</td>
                                <td class="text-center">
                                    <div class="dropdown d-inline-block">
                                        <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn-primary btn-sm text-white"></a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                            <form action="{{ route('categories.destroy', $example->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('categories.edit', $example->id) }}" tabindex="0" class="dropdown-item">Edit</a>
                                                <button type="submit" class="dropdown-item">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('custom-scripts')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template') }}/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
$(function() {
    $('#data-table').DataTable({});
});
</script>

@endsection
