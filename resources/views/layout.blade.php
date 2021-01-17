<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- リセットCSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BokiPass</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <header>
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
          <a class="navbar-brand" href="{{route('timeline')}}" style="text-decoration:none;"> {{ config('app.name') }}</a>
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
                    <button type="submit" class="w-100" onClick="return double()">１級</button>
                  </form>
                  <div class="dropdown-divider"></div>
                  <form action="{{route('squeeze')}}" method="get">
                    @csrf
                    <input type="hidden" name="pass_class" value="２">
                    <button type="submit" class="w-100" onClick="return double()">２級</button>
                  </form>
                  <div class="dropdown-divider"></div>
                  <form action="{{route('squeeze')}}" method="get">
                    @csrf
                    <input type="hidden" name="pass_class" value="３">
                    <button type="submit" class="w-100" onClick="return double()">３級</button>
                  </form>
                  <div class="dropdown-divider"></div>
                  <form action="{{route('squeeze')}}" method="get">
                    @csrf
                    <input type="hidden" name="pass_class" value="初">
                    <button type="submit" class="w-100" onClick="return double()">初級</button>
                  </form>
                </div>
              </li>
            </ul>
            <div>
              @if(Auth::check())
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a href="#" id="logout" class="nav-link">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                      @csrf
                    </form>
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
    <main>
      @yield('content')
    </main>
    @if(Auth::check())
      <script>
      //ログアウトをクリックすると下に置いたフォームを送信する
        document.getElementById('logout').addEventListener('click', function(event) {
          event.preventDefault();
          document.getElementById('logout-form').submit();
        });
      </script>
    @endif
    @yield('scripts')
  </body>
</html>