<h1 class="container">Меню</h1>
<ul class="nav">
    {{--<li><a href="{{ url('/') }}">Главная</a></li>--}}
    @if(!Auth::guest() && (Auth::user()->isAdmin || Auth::user()->isModerator))
            {{--<li><a href="{{ url('/users/create') }}">Добавить пользователя</a></li>--}}
            <li><a href="{{ url('/users') }}">Список пользователей</a></li>
            {{--<li><a href="{{ url('/folders/create') }}">Добавить папку</a></li>--}}
            <li><a href="{{ url('/folders') }}">Список файлов и папок</a></li>
            {{--<li><a href="{{ url('/files/create') }}">Добавить файл</a></li>--}}
            {{--<li><a href="{{ url('/files') }}">Список файлов</a></li>--}}
            {{--<li><a href="{{ url('/files/multi') }}"><strong>Множественная загрузка файлов</strong></a></li>--}}
    @elseif(!Auth::guest() && Auth::user()->canAccess)
        <li><a href="{{ url('/folders') }}">Список файлов и папок</a></li>
    @endif

    @if(Auth::guest())
        <li><a href="{{ url('/login') }}">Войти</a></li>
        <li><a href="{{ url('/register') }}">Зарегистрироваться</a></li>
        <li><a href="{{ url('/password/reset') }}">Забыли пароль?</a></li>
    @else
        <li><a href="{{ url('/logout') }}">Выйти</a></li>
    @endif
</ul>