<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- リセットCSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>BokiPass</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body class="bg-light">
    <header>
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
          <a class="text-dark navbar-brand" href="{{route('timeline')}}" style="text-decoration:none;"> {{ config('app.name', 'Laravel') }}</a>
          <div class="">
            @if(Auth::check())
              <a href="#" id="logout" class="btn btn-outline-primary btn-sm">ログアウト</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
              </form>
            @else
              <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">ログイン</a>
              <a class="btn btn-outline-primary btn-sm" href="{{ route('register') }}">新規登録</a>
            @endif
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