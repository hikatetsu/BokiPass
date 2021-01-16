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
          <a class="text-dark m-2" href="{{route('timeline')}}" style="text-decoration: none;">BokiPass</a>
        </div>
      </nav>
    </header>
    <main>
      @yield('content')
    </main>
    @yield('scripts')
  </body>
</html>