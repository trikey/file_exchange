<div class="menu visible-lg">
    <ul class="menu-list">
        @if(!Auth::guest())
        <li class="menu-item menu-search">
            <a href="#">
                <span class="icon icon-search open-search"></span>
            </a>
            <div class="search-form">
                <div class="close-search-form">
                    <span class="icon icon-close close-search"></span>
                </div>
                <form action="{{ Route::getCurrentRoute()->getPath() == 'users' ? route('users_search') : route('search') }}" method="get">
                    <input type="text" name="query" class="search-filed" value="{{ isset($_REQUEST["query"]) ? $_REQUEST["query"] : '' }}"/>
                    <input type="submit" class="search-btn" value=""/>
                </form>
            </div>
        </li>
        @endif
        {{--<li class="menu-item"><a href="{{ url('/') }}">Главная</a></li>--}}
        @if(!Auth::guest() && (Auth::user()->isAdmin || Auth::user()->isModerator))
                {{--<li class="menu-item"><a href="{{ url('/users/create') }}">Добавить пользователя</a></li>--}}
                <li class="menu-item"><a href="{{ url('/users') }}">{{ trans('menu.users_list') }}</a></li>
                {{--<li class="menu-item"><a href="{{ url('/folders/create') }}">Добавить папку</a></li>--}}
                <li class="menu-item"><a href="{{ url('/folders') }}">{{ trans('menu.files_and_folders_list') }}</a></li>
                {{--<li class="menu-item"><a href="{{ url('/files/create') }}">Добавить файл</a></li>--}}
                {{--<li class="menu-item"><a href="{{ url('/files') }}">Список файлов</a></li>--}}
                {{--<li class="menu-item"><a href="{{ url('/files/multi') }}"><strong>Множественная загрузка файлов</strong></a></li>--}}
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

<!--<div class="menu visible-lg">-->
<!--    <ul class="menu-list">-->
<!--        <li class="menu-item dropdown">-->
<!--            <a href="#">Каталог</a>-->
<!--            <ul class="dropdown-menu">-->
<!--                <li>-->
<!--                    <a href="#">Smart Чайник</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#">Smart Мультиварка</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="menu-item">-->
<!--            <a href="#">READY FOR SKY</a>-->
<!--        </li>-->
<!--        <li class="menu-item">-->
<!--            <a href="#">Готовим с REDMOND</a>-->
<!--        </li>-->
<!--        <li class="menu-item">-->
<!--            <a href="#">О компании</a>-->
<!--        </li>-->
<!--        <li class="menu-item">-->
<!--            <a href="#">Купить</a>-->
<!--        </li>-->
<!--        <li class="menu-item menu-search">-->
<!--            <a href="#">-->
<!--                <span class="icon icon-search open-search"></span>-->
<!--            </a>-->
<!--            <div class="search-form">-->
<!--                <div class="close-search-form">-->
<!--                    <span class="icon icon-close close-search"></span>-->
<!--                </div>-->
<!--                <form action="">-->
<!--                    <input type="text" class="search-filed"/>-->
<!--                    <input type="submit" class="search-btn" value=""/>-->
<!--                </form>-->
<!--            </div>-->
<!--        </li>-->
<!--        <li class="menu-item dropdown">-->
<!--            <a href="#">EN</a>-->
<!--            <ul class="dropdown-menu">-->
<!--                <li>-->
<!--                    <a href="#">EN</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#">RU</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!---->
<!--    </ul>-->
<!--</div>-->