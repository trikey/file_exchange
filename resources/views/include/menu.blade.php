<h1 class="container">{{ trans('menu.menu') }}</h1>
<ul class="nav">
    {{--<li><a href="{{ url('/') }}">Главная</a></li>--}}
    @if(!Auth::guest() && (Auth::user()->isAdmin || Auth::user()->isModerator))
            {{--<li><a href="{{ url('/users/create') }}">Добавить пользователя</a></li>--}}
            <li><a href="{{ url('/users') }}">{{ trans('menu.users_list') }}</a></li>
            {{--<li><a href="{{ url('/folders/create') }}">Добавить папку</a></li>--}}
            <li><a href="{{ url('/folders') }}">{{ trans('menu.files_and_folders_list') }}</a></li>
            {{--<li><a href="{{ url('/files/create') }}">Добавить файл</a></li>--}}
            {{--<li><a href="{{ url('/files') }}">Список файлов</a></li>--}}
            {{--<li><a href="{{ url('/files/multi') }}"><strong>Множественная загрузка файлов</strong></a></li>--}}
    @elseif(!Auth::guest() && Auth::user()->canAccess)
        <li><a href="{{ url('/folders') }}">{{ trans('menu.files_and_folders_list') }}</a></li>
    @endif

    @if(Auth::guest())
        <li><a href="{{ url('/login') }}">{{ trans('menu.login') }}</a></li>
        <li><a href="{{ url('/register') }}">{{ trans('menu.register') }}</a></li>
        <li><a href="{{ url('/password/reset') }}">{{ trans('menu.forgot_password') }}</a></li>
    @else
        <li><a href="{{ url('/logout') }}">{{ trans('menu.logout') }}</a></li>
    @endif
</ul>