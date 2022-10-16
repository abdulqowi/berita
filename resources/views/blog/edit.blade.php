@extends('layouts/app', ['title' => 'Edit blog'])

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Edit blog
                        <div class="page-title-subheading">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">blogs</a></li>
                                <li class="active breadcrumb-item" aria-current="page">Edit blog</li>
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

        <div class="main-card mb-3 card">
            <div class="card-header">
                <h5 class="card-title">Edit blog</h5>
            </div>
            <div class="card-body" >
                <form action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="title">Judul <span class="text-danger">*</span></label>
                                <input name="title" id="title" placeholder="Masukkan judul" type="title"
                                    class="form-control form-control-xs @error('title') is-invalid @enderror"
                                    value="{{ $blog->title ?? old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="image">Gambar</label>
                                <input name="image" id="image" placeholder="Masukkan image" type="file"
                                    class="form-control form-control-xs @error('image') is-invalid @enderror"
                                    value="{{ $blog->image ?? old('image') }}">
                                @error('image')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="category">Kategori</label>
                                        <select name="category[]" id="category"
                                            placeholder="Masukkan meta deskripsi (tidak wajib)" type="category"
                                            class="form-control form-control-xs select2 
                                            @error('category') is-invalid 
                                            @enderror"
                                            value="{{ $blog->category ?? old('category') }}"multiple>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{
                                                    $blog->categories()->find($category->id) ? 'selected' : ''
                                                }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="meta_desc">Meta Description</label>
                                        <input name="meta_desc" id="meta_desc"
                                            placeholder="Masukkan meta deskripsi (tidak wajib)" type="meta_desc"
                                            class="form-control form-control-xs @error('meta_desc') is-invalid @enderror"
                                            value="{{ $blog->meta_desc ?? old('meta_desc') }}">
                                        @error('meta_desc')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative form-group">
                                <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                                <input name="meta_keyword" id="meta_keyword" placeholder="Masukkan keyword (tidak wajib)"
                                    type="meta_keyword"
                                    class="form-control form-control-xs @error('meta_keyword') is-invalid @enderror"
                                    value="{{ $blog->meta_keyword ?? old('meta_keyword') }}">
                                @error('meta_keyword')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="body">Body <span class="text-danger">*</span></label>
                                <textarea name="body" id="body" type="text"
                                    class="form-control form-control-xs @error('body') is-invalid @enderror" value="{{ $blog->body ?? old('body') }}">{{ $blog->body }}</textarea>
                                @error('body')
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
@section('custom-styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            'placeholder': 'pilih kategori' 
        });
    });
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>
@endsection
