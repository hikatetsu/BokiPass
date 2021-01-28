<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BokiPass</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- リセットCSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <a class="navbar-brand" href="{{route('timeline')}}" style="text-decoration:none;">BokiPass</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    級別検索
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <form action="{{route('squeeze')}}" method="get">
                        @csrf
                        <input type="hidden" name="pass_class" value="１">
                        <button type="submit" class="w-100">１級</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <form action="{{route('squeeze')}}" method="get">
                        @csrf
                        <input type="hidden" name="pass_class" value="２">
                        <button type="submit" class="w-100">２級</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <form action="{{route('squeeze')}}" method="get">
                        @csrf
                        <input type="hidden" name="pass_class" value="３">
                        <button type="submit" class="w-100">３級</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <form action="{{route('squeeze')}}" method="get">
                        @csrf
                        <input type="hidden" name="pass_class" value="初">
                        <button type="submit" class="w-100">初級</button>
                    </form>
                    </div>
                </li>
                </ul>
                <div>
                @if(Auth::check())
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">その他</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">  
                        <div class="text-center">
                            <a href="#" id="logout" class="text-dark" style="text-decoration:none;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                            </form>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="text-center">
                            <a class="text-dark" href="{{route('withdrawal')}}" style="text-decoration:none;">退会する</a>        
                        </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('myPage') }}" class="nav-link">マイページ</a>
                    </li>
                    </ul>
                @else
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                    </li>
                    </ul>
                @endif
                </div>
            </div>
            </div>
        </nav>
        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @if(Auth::check())
      <script>
      //ログアウトをクリックすると下に置いたフォームを送信する
        document.getElementById('logout').addEventListener('click', function(event) {
          event.preventDefault();
          document.getElementById('logout-form').submit();
        });
      </script>
    @endif
</body>
</html>
