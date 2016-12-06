<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Prue - どこよりもお店から安く買えるサイト</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/10up-sanitize.css/4.1.0/sanitize.css">"
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/shop.css">
</head>
<body>
  <div class="container">
  <header>
    <div class="header-wrapper">
     <div class="header-title">
       <a href="/"><h1>Prue</h1></a>
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
        <li><a href="">カテゴリ１<span class="menu_icon">▼</span></a></li>
        <li><a href="">カテゴリ２<span class="menu_icon">▼</span></a></li>
        <li><a href="">カテゴリ３<span class="menu_icon">▼</span></a></li>
        <li><a href="">カテゴリ４<span class="menu_icon">▼</span></a></li>
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
    <p>&copy; Prue All Rights Reserved. </p>
  </footer>
  {{-- footer end  --}}
  </div>
</body>
</html>
