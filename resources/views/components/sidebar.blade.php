<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Dashboards</li>
            <li>
                <a href="{{ route('dashboard') }}" class="mm-active">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Dashboard
                </a>
            </li>
            <li class="app-sidebar__heading">Components</li>
            @can('user-read')
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Manajemen Pengguna
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="metismenu-icon"></i>
                            Pengguna
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}">
                            <i class="metismenu-icon"></i>
                            Role
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            <li>
                @can('blog-read')
                <a href="{{route('blogs.index')}}"">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Blog
                </a>
                @endcan
                @can('category-read')
                <a href="{{route('categories.index')}}">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Kategori
                </a>
                @endcan
                <a href="{{ route('examples.index') }}">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Example
                </a>
            </li>
        </ul>
    </div>
</div>
