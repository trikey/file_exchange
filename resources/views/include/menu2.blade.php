<div class="menu visible-lg">
    <ul class="menu-list">
        @if(!Auth::guest())
            <li class="menu-item">
                <a href="/folders#/filebox"><span class="icon-basket"></span>{{ trans('menu.basket') }}<span class="basket-count"></span></a>
            </li>
        @endif
        @if(!Auth::guest() && (Auth::user()->isAdmin || Auth::user()->isModerator))
                <li class="menu-item"><a href="{{ url('/users') }}">{{ trans('menu.users_list') }}</a></li>
                <li class="menu-item"><a href="{{ url('/folders') }}">{{ trans('menu.files_and_folders_list') }}</a></li>
        @elseif(!Auth::guest() && Auth::user()->canAccess)
            <li class="menu-item"><a href="{{ url('/folders') }}">{{ trans('menu.files_and_folders_list') }}</a></li>
        @endif

        @if(Auth::guest())
            <li class="menu-item"><a href="{{ url('/login') }}">{{ trans('menu.login') }}</a></li>
            <li class="menu-item"><a href="{{ url('/register') }}">{{ trans('menu.register') }}</a></li>
            <li class="menu-item"><a href="{{ url('/password/reset') }}">{{ trans('menu.forgot_password') }}</a></li>
        @else
            <li class="menu-item"><a href="{{ url('/logout') }}">{{ trans('menu.logout') }}</a></li>
        @endif
        <li  class="menu-item header-dropdown">
            <a href="#">{{ trans('menu.select_language') }}</a>
            <ul class="header-dropdown-menu" role="menu">
                <li><a href="?lang=en">English</a></li>
                <li><a href="?lang=ru">Русский</a></li>
            </ul>
        </li>
    </ul>
</div>