@extends('layouts/app', ['title' => 'Edit Example'])

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Edit Example
                        <div class="page-title-subheading">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Examples</a></li>
                                <li class="active breadcrumb-item" aria-current="page">Edit Example</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('examples.index') }}" class="btn-shadow btn-sm mr-3 btn btn-primary">
                        Kembali
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-header">
                <h5 class="card-title">Edit Example</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('examples.update', $example->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input name="first_name" id="first_name" placeholder="Masukkan nama" type="first_name" class="form-control form-control-xs @error('first_name') is-invalid @enderror" value="{{ $example->first_name ?? old('first_name') }}">
                                @error('first_name')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input name="last_name" id="last_name" placeholder="Masukkan last_name" type="last_name" class="form-control form-control-xs @error('last_name') is-invalid @enderror" value="{{ $example->last_name ?? old('last_name') }}">
                                @error('last_name')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
