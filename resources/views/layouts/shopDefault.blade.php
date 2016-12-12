<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Prue - どこよりもお店から安く買えるサイト</title>
  <meta name="description" content="Prueなら出品料が格安なためどこよりも安く買えます。" />
  <meta name="keywords" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- css -->
  <link rel="stylesheet" href="/lp/css/sanitize.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/shop/css/shop.css">
  <link rel="stylesheet" href="/shop/css/shop_sp.css">
</head>
<body>
  <div class="container">
  <header>
    <div class="header-wrapper">
     <div class="header-title">
       <a href="/"><h1><img src="/shop/images/logo.png" class="logo" alt="Prue - どこよりもお店から安く買えるサイト"></h1></a>
     </div>
     <div class="search_box">
      <form action="{{ action('ShopIndexController@index') }}" method="get">
        {{ csrf_field()  }}
        <input type="text" name="name" placeholder="商品名やキーワードから探す" class="search_item"> 
        
        <input type="submit" value="商品を検索する"  style="display:none"  class="btn">
      </form>
     </div>
     <div class="header-right">
       <ul>
         @if (Auth::guest())
             <li><a href="{{ url('/login') }}">ログイン</a></li>
             <li><a href="{{ url('/register') }}">新規会員登録</a></li>
             <li>@yield('header-right')</li>
         @else
             <li>{{ Auth::user()->name }} <span class="caret"></span></li>
             <li>
                 <a href="{{ url('/logout') }}"
                     onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                     ログアウト
                 </a>
                 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                     {{ csrf_field() }}
                 </form>
             </li>
            <li>@yield('header-right')</li>
         @endif
       </ul>
     </div>
   </div>
   <div class="header-menu">
      <ul>
        <li><a href="/?category=video_games_display_on_website">ゲーム</a></li>
        <li><a href="/?category=kitchen_display_on_website">キッチン</a></li>
        <li><a href="/?category=hobby_display_on_website">おもちゃ</a></li>
      </ul>
   </div>
 
 </header>
  {{-- header end --}}
  @if(session('flash_message'))
    <p class="flash_message">{{ session('flash_message') }}</p>
  @endif

  <div class="main-wrapper">
    @yield('content')
  </div>
  {{-- main-wrapper end  --}}

  <footer>
    <p>利用規約 |  個人情報について </p>
    <p>&copy; Prue All Rights Reserved. </p>
  </footer>
  {{-- footer end  --}}
  </div>
</body>
</html>
