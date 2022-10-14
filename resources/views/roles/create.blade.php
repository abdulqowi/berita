@extends('layouts/app', ['title' => 'TRambah Role'])

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Tambah Role
                        <div class="page-title-subheading">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Roles</a></li>
                                <li class="active breadcrumb-item" aria-current="page">Tambah role</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('roles.index') }}" class="btn-shadow btn-sm mr-3 btn btn-primary">
                        Kembali
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-header">
                <h5 class="card-title">Tambah Role</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="post">
                    @csrf

                    @include('roles.partials.form-control')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')

<script>
    function toggle(source) {
        checkboxes = document.getElementsByName('permission[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>

@endsection
