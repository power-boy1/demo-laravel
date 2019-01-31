<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/element.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Jua" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/ppt1kay.css">
    <!-- Scripts -->
    <script defer src="{{ mix('js/app.js') }}"></script>

</head>
<body>

<div id="app" class="app">
    <modal-confirm-delete>

    </modal-confirm-delete>

    @if (Session::has('flashMessage'))
        <notification
                title="{{ Session::get('flashMessage.title') }}"
                text="{{ Session::get('flashMessage.text') }}"
                type="{{ Session::get('flashMessage.type') }}">
        </notification>
    @endif

    <div class="pagecontainer">
        <el-header class="header" height="70px">
            <a class="header-logo" href="{{ route('get.manage.user.show') }}">
                <img class="header-logo-img" src="{{ Storage::url(config('params.path_to_logo')) }}" alt="GoHome">
                <span>Admin panel</span>
            </a>

            <div class="header-controls">
                <span>Hello Admin!</span>
                <form id="logout-form" action="{{ route('post.auth.logout') }}" method="POST">
                    @csrf
                    <button class="header-link" type="submit">Logout</button>
                </form>
            </div>
        </el-header>
        <el-container class="pagecontent">
            @include('management.widgets.sidebar')
            <div class="content">
                @yield('content')
                @include('management.widgets.footer')
            </div>
        </el-container>
    </div>
</div>

@stack('scripts')

</body>
</html>