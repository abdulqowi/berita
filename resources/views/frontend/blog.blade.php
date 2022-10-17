@extends('layouts.frontend', compact('title'))

@section('meta')
    <meta name="title" content="{{ $post->title ?? 'IRP Blog' }}">
    <meta name="description" content="{{ $post->meta_desc ?? 'Sebuah sarana blog publik untuk saling berbagi - Remaja generasi millenial bisa' }}">
    <meta name="keyword" content="{{ $post->meta_keyword ?? 'Forum, Remaja, IRP' }}">
    <meta name="image" content="{{ $post->takeImage ?? '' }}">
@endsection

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ $post->takeImage }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1 class="subheading">{{ $post->title }}</h1>
                        <h3 class="meta">{{ $post->meta_description}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card my-3">
                        <div class="card-header">ADS</div>
                        <div class="card-body">
                            Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Quia sed officia, laborum odit, ullam accusamus labore, aperiam laboriosam provident dolorum molestias ipsa est numquam at dolores similique illo doloribus, necessitatibus.
                        </div>
                    </div>
                    <div class="my-5">
                        <h1>{{ $post->title }}</h1>
                        <small class="text-comment"> Penulis : {{ $post->user->name }};
                            Kategori :
                            @foreach ($post->categories as $category)
                            <a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a>
                            @endforeach
                            Terbit : {{ date('d-m-Y', strtotime($post->created_at)) }};
                            <!-- <div class="d-flex justify-content-left">
                                @can('update', $post)
                                <form action="{{ route('post.edit', $post->slug) }}">
                                    <button class="badge badge-success">edit <i class="fas fa-pencil-alt"></i></button>
                                </form>
                                @endcan
                                @can('delete', $post)
                                    <form action="{{ route('post.delete', $post->slug) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="badge badge-danger" type="submit" onclick="return confirm('Apakah yakin ingin menghapus postingan ini?')">hapus <i class="fas fa-trash"></i></button>
                                    </form>
                                @endcan
                            </div> -->
                        </small>
                        <hr>
                        @if ($post->thumbnail)
                            <img src="{{ $post->takeImage }}" class="img-fluid">
                        @endif
                        <div style="word-wrap: break-word;">
                            {!! $post->body !!}
                        </div>
                    </div>
                        <div class="d-flex flex-row my-3">
                            <a href="whatsapp://send?text={{ url($post->slug) }}" class="btn btn-sm btn-success"><i class="fab fa-brands fa-whatsapp"></i></a>
                            <a href="{{ url($post->slug) }}" class="btn btn-sm btn-primary ml-2"><i class="fab fa-facebook"></i></a>
                            <a class="btn btn-sm btn-info ml-2"><i class="fab fa-telegram"></i></a>
                            <a class="btn btn-sm btn-info ml-2"><i class="fab fa-twitter"></i></a>
                        </div>
                    <hr>

                    <div class="card my-3">
                        <div class="row">
                            <div class="col-md-1">
                                @if (auth()->user())
                                <img src="{{ auth()->user()->takeImage }}" class="rounded-circle" height="50" width="50" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card my-3">
                        <h3>ADS</h3>
                    </div>
                    <div class="card my-3">
                        <h3 class="post-title">Postingan Terkait</h3>
                        <ul class="list-group list-group-flush">
                            @foreach ($post_related as $post)
                                <li class="list-group-item">
                                    <div>
                                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                    <div>
                                        <a href="" class="text-comment">{{ $post->user->name }}</a><small class="text-comment"> - {{ $post->created_at->diffForHumans() }}</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('custom-scripts')
    <script src="{{ asset('frontend/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('frontend/vendor/ckeditor5/ckeditor.js.map') }}"></script>
    <script src="{{ asset('frontend/vendor/ckeditor5/translations/id.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection
