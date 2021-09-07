<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ secure_asset('js/top.js') }}" type="module"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/top.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <style>
        body {
            font-family: system-ui;
        }
    </style>
</head>
<body style="padding-top: 60px;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-transparent">
            <div class="container-fluid">
                <a class="navbar-brand mr-0" href="{{ url('/') }}"　data-toggle="tooltip" title="Top page">
                    <img src="/storage/sample/12_Primary_logo_on_transparent_414x63.png" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto align-items-center snip1217">
                        <li class="nav-item mr-2">
                            <form class="d-flex" action="{{ url('user/galleries/search') }}" method="post">
                                @csrf
                                @method('GET')
                                <input type="text" class="form-control me-2" type="search" placeholder="フリーワード検索" aria-label="Search" name="keyword">
                                <select id="area" type="text" class="form-control" aria-label="Search" name="areaName">
                                    @foreach(config('area') as $index => $name)
                                        <option value="" hidden>エリアで検索</option>
                                        <option value="{{ $index }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-light bg-secondary" type="submit"><i class="px-2 fas fa-search"></i></button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('user/tags') }}">タグ一覧</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto align-items-center snip1217">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('user/galleries/create') }}">投稿する</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('user/home/galleries') }}" data-toggle="tooltip" title="全ユーザーの投稿">ホームギャラリー</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('user/galleries') }}" data-toggle="tooltip" title="フォローユーザーの投稿">マイギャラリー</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('user/users') }}">ユーザー一覧</a>
                            </li>
                    </ul>
                    <ul class="navbar-nav ml-4 align-items-center">
                        @unless (Auth::guard('user')->check())
                            <li class="nav-item ml-4 snip1217">
                                <a class="nav-link" href="{{ route('user.login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('user.register'))
                                <li class="nav-item ml-5 snip1217">
                                    <a class="nav-link" href="{{ route('user.register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle py-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(isset(auth()->user()->profile))
                                <img src="{{ auth()->user()->profile->img_path }}" class="rounded-circle" width="50" height="50">
                                @endif
                                    ＠{{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ url('user/users/' .auth()->user()->id) }}" class="dropdown-item">プロフィール</a>
                                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <section class="section section-a">
        </section>
        
        <section class="section section-b">
        </section>

        <main class="pt-4">
            @yield('content')
        </main>
    </div>
</body>
</html>