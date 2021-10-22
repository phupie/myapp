<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" content="ff14,エオルゼア,スクショ">
    <meta name="description" content="FF14の風景投稿サイト">

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
    <link href="{{ secure_asset('css/top.css') }}" rel="stylesheet" media="screen and (min-width:1024px)">
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-xl navbar-dark fixed-top">
                <div class="container-fluid">
                    
                    <a class="navbar-brand" href="{{ url('/') }}"　data-toggle="tooltip" title="Top page">
                        <img src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/12_Primary_logo_on_transparent_414x63.png" height="30">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
        
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        
                        <!-- Right Side Of Navbar -->
                            
                        <ul class="navbar-nav ml-auto align-items-center snip1217">
                                <li class="nav-item dropdown">
                                    <a id="search" class="nav-link dropdown-toggle px-0" type="button" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false" v-pre>検索</a>
                                    
                                    <div class="dropdown-menu bg-light p-4 m-auto"  aria-labelledby="search" style="width: 200px;">
                                        <form class="" action="{{ url('user/galleries/search') }}" method="post">
                                            @csrf
                                            @method('GET')
                                            <p>検索する</p>
                                            <input type="text" class="form-control me-2 mb-3" type="search" placeholder="フリーワード検索" aria-label="Search" name="keyword">
                                            <select id="area" type="text" class="form-control button mb-3" aria-label="Search" name="areaName">
                                                @foreach(config('area') as $index => $name)
                                                    <option value="" hidden>エリア検索</option>
                                                    <option value="{{ $index }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-outline-light bg-secondary ml-auto" type="submit"><i class="px-2 fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-0" href="{{ url('user/tags') }}">タグ一覧</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-0" href="{{ url('user/galleries/create') }}">投稿する</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-0" href="{{ url('user/home/galleries') }}" data-toggle="tooltip" title="みんなのギャラリー">ギャラリー</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-0" href="{{ url('user/galleries') }}" data-toggle="tooltip" title="フォローユーザーの投稿">マイギャラリー</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-0" href="{{ url('user/users') }}">ユーザー一覧</a>
                                </li>
                            @unless (Auth::guard('user')->check())
                                <li class="nav-item mx-2 snip1217">
                                    <a class="nav-link" href="{{ route('user.login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('user.register'))
                                    <li class="nav-item mx-2 snip1217">
                                        <a class="nav-link" href="{{ route('user.register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle py-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(isset(auth()->user()->profile->img_path))
                                        <img src="{{ auth()->user()->profile->img_path }}" class="rounded-circle" width="50" height="50">
                                    @endif
                                        ＠{{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown">
                                        <a href="{{ url('user/users/' .auth()->user()->id) }}" class="dropdown-item text-body">プロフィール</a>
                                        <a class="dropdown-item text-body" href="{{ route('user.logout') }}"
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
