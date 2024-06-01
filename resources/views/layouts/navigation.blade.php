<nav class="navbar navbar-expand-sm navbar-dark px-5 bg-white">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="logo" href="{{ route('dashboard') }}">Restaurant&nbsp;&nbsp;L</a>
    <div class="collapse navbar-collapse justify-content-end">
        <div class="dropdown">
            <button class="btn dropdown-toggle text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="font-medium text-base">{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu">
                @can('admin')
                    <li><a class="dropdown-item" href="{{route('table.edit')}}">座席編集</a></li>
                    <li><a class="dropdown-item" href="{{route('menu.add')}}">メニュー追加</a></li>
                    <li><a class="dropdown-item" href="{{route('menu.index')}}">メニュー編集</a></li>
                    <li><a class="dropdown-item" href="{{route('salesbook.index')}}">売上</a></li>
                    <li><a class="dropdown-item" href="{{route('profile.edit')}}"><i class="fa-solid fa-gear"></i>&nbsp;&nbsp;各種設定</a></li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                            this.closest('form').submit();">{{ __('Log Out') }}</a></li>
                    </form>     
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                            this.closest('form').submit();">{{ __('Log Out') }}</a></li>
                    </form>                           
                @endcan
            </ul>
        </div>
    </div>
</nav>