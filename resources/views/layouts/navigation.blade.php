<nav class="navbar navbar-expand-sm navbar-light bg-white px-4 py-0">
    <div class="container-fluid">
        <a class="logo" href="{{ route('dashboard') }}">Restaurant L</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <button class="btn dropdown-toggle text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="font-medium text-base">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @can('admin')
                            <li><a class="dropdown-item" href="{{ route('table.edit') }}">座席編集</a></li>
                            <li><a class="dropdown-item" href="{{ route('menu.add') }}">メニュー追加</a></li>
                            <li><a class="dropdown-item" href="{{ route('menu.index') }}">メニュー編集</a></li>
                            <li><a class="dropdown-item" href="{{ route('salesbook.index') }}">売上</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear"></i>&nbsp;&nbsp;権限設定</a></li>
                        @endcan
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>