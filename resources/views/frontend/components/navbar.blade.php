<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <div>
            <img src="{{ asset('img/logo.png') }}" class="img" width="40">
            <a class="navbar-brand" href="{{ route('home' )}}">IRP</a>
        </div>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <div class="search">
                <form action="">
                    <input type="text" placeholder="Cari . . ." name="query">
                        <span>
                            <i class="fas fa-search"></i>
                        </span>
                    </input>
                </form>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about_us') }}">Tentang Kami</a>
                </li>
                @guest

                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Author'))
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Admin</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
