<!doctype html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link rel="shortcut icon" href="/ico.png">-->

    <title>@yield('meta_title')</title>
    <meta name="keywords" content="@yield('meta_keywords')" />
    <meta name="description" content="@yield('meta_description')" />


    <!--[if lt IE 9]>
    <script src="{{ asset('/assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('/assets/js/respond.min.js') }}"></script>
    <![endif]-->


    <link href="{{ asset('/assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/bootstrap-treeview/css/bootstrap-treeview.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/filemanager.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/webix.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.css?345345') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('/assets/js/jquery/jquery-1.10.1.min.js') }}"></script>

    <!-- csrf protection -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="lang_{{ App::getLocale() }}">
    <div class="">
        <div class="col-lg-2 col-sm-2 col-xs-2">
            @include('include/menu')
        </div>
        <div class="col-lg-10 col-sm-10 col-xs-10">
            @yield('content')
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/bootstrap-treeview/js/bootstrap-treeview.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/js/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/js/bootstrap-contextmenu.js?'.time()) }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/js/client.js?'.time()) }}"></script>
    @if(!Auth::guest())
        @if(Auth::user()->isAdmin || Auth::user()->isModerator)
            <script type="text/javascript" src="{{ asset('/assets/js/jquery.form.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/assets/js/script.js?'.time()) }}"></script>
        @endif
    @endif
</body>
</html>
