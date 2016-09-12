<!doctype html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link rel="shortcut icon" href="/ico.png">-->

    <title>@yield('meta_title')</title>
    <meta name="keywords" content="@yield('meta_keywords')" />
    <meta name="description" content="@yield('meta_description')" />



    <link href="{{ asset('/assets/bootstrap-less/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/bootstrap-treeview/css/bootstrap-treeview.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/filemanager.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.css?345345') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/custom-style.css') }}" rel="stylesheet">


    <!-- csrf protection -->
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body class="lang_{{ App::getLocale() }} @if(Auth::guest()) login-bg @endif" data-lang="{{ App::getLocale() }}">
    <div class="header">
        <div class="container-fluid">
            <div class="menu-icon visible-xs-inline-block visible-sm-inline-block visible-md-inline-block">
                <div class="menu-icon-inner"></div>
            </div>
            <a href="/" class="logo">
                <img src="{{ asset('/assets/img/logo.png') }}" alt=""/>
            </a>
            <div class="name">
                Marketing resource
            </div>
            @include('include/menu2')
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container-fluid">
            <a class="logo" href="/">
                <img src="{{ asset('/assets/img/logo-footer.png') }}" alt=""/>
            </a>
            <div class="copyright">
                © 2016 REDMOND industrial group. All rights reserved.
            </div>
        </div>
    </div>
    @if(!Auth::guest())
        @if(Auth::user()->isAdmin || Auth::user()->isModerator)
            <script type="text/javascript" src="{{ asset('/build/admin.js') }}?{{ time() }}"></script>
        @else
            <script type="text/javascript" src="{{ asset('/build/client.js') }}"></script>
        @endif
    @endif
</body>
</html>
