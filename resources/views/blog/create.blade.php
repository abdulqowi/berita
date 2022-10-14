@extends('layouts/app', ['title' => 'Tambah Example'])

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Tambah Blog
                        <div class="page-title-subheading">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Blog</a></li>
                                <li class="active breadcrumb-item" aria-current="page">Tambah Blog</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('blogs.index') }}" class="btn-shadow btn-sm mr-3 btn btn-primary">
                        Kembali
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="main-card mb-2 card">
            <div class="card-header">
                <h5 class="card-title">Tambah Blog</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-10">
                            <div class="position-relative form-group">
                                <label for="first_name">Judul<span class="text-danger">*</span></label>
                                <input class="col-md-6" name="title" id="title" placeholder="Masukkan Judul" type="first_name"
                                    class="form-control form-control-xs @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div>
                                    <label for="gambar">Upload Gambar</label>
                                    <input name="image" id="image" placeholder="Masukkan Judul" type="file"
                                        class="form-control col-md-5 @error('name') is-invalid @enderror"
                                        value=""> 
                                </div>
                            </div>
                            <div class="position-relative form-group">
                                <label for="first_name">Artikel<span class="text-danger">*</span></label>
                                <textarea name="body" id="editor" placeholder="Masukkan Blog" type="first_name"
                                    class="form-control form-control-xs @error('name') is-invalid @enderror"
                                    ></textarea>
                                @error('name')
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

@section('custom-scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>
@endsection