<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Prue 管理者用ページ</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/master') }}">
                    Prue: 管理者画面
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                  @if (!Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            会社・事業者管理 <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ url('/master/admin-merchant') }}">会社・事業者</a></li>
                          <li><a href="{{ url('/master/admin-user') }}">登録者</a></li>
                          <!-- <li><a href="{{ url('/master/admin&#45;item') }}">商品マスタ</a></li> -->
                          <li><a href="{{ url('/master/admin-inventory') }}">仕入</a></li>
                          <li><a href="{{ url('/master/admin-shop') }}">店舗</a></li>
                          <li><a href="{{ url('/master/admin-rss') }}">Rss</a></li>
                          <li><a href="{{ url('/master/admin-contact') }}">お問い合わせ</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            ショッピング会員管理 <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ url('/master/shop-user') }}">会員</a></li>
                        </ul>
                    </li>
                  @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/master/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>
                                    <form id="logout-form" action="{{ url('/master/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
