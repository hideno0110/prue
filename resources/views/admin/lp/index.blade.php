<!DOCTYPE html>
<html lang="ja">
<head>
  <!-- meta -->
  <meta charset="utf-8">
  <title>Prue シンプルにマルチ販売を実現する世界へ</title>
  <meta name="description" content="Prueでは仕入れ、出品、在庫管理をamazon等複数の販売チャネルと連携します。">
  <meta name="keywords" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- css -->
  <link rel="stylesheet" type="text/css" href="/lp/css/sanitize.css">
  <link rel="stylesheet" type="text/css" href="/lp/css/main.css">
  <link rel="stylesheet" type="text/css" href="/lp/css/responsive.css">
  <link rel="stylesheet" type="text/css" href="/lp/css/slicknav.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  
  <!-- favicon -->
  <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
  <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144-precomposed">
  <link rel="icon" type="image/png" href="/android-chrome-144x144.png" sizes="192x192">

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
  <!-- js   -->
  <script type="text/javascript" src="/lp/jquery.1.9.0.js"></script>
  <script type="text/javascript" src="/lp/jquery.slicknav.js"></script>
  <!-- スムーズスクロール部分の記述 -->
  <script>
  $(function(){
     // #で始まるアンカーをクリックした場合に処理
     $('a[href^=#]').click(function() {
        // スクロールの速度
        var speed = 400; // ミリ秒
        // アンカーの値取得
        var href= $(this).attr("href");
        // 移動先を取得
        var target = $(href == "#" || href == "" ? 'html' : href);
        // 移動先を数値で取得
        var position = target.offset().top;
        // スムーススクロール
        // $('html, body').animate({'scrollTop':position},500);       
        $('body,html').animate({scrollTop:position}, speed, 'swing');
        return false;
     });
  });
  </script>
</head>
<body>
 <header> 
    <div class="container">
      <div class="header-top">
        <div class="header-left">
          <a href="/admin/lp"><h1><img src="/lp/structure/logo.png" alt="Prue シンプルにマルチ販売を実現する" class="logo"></h1></a>
        </div>
        <div class="header-right">
          <ul id="menu">
            <li><a href="#service">サービス</a></li>
            <li><a href="#technology">機能と利用技術</a></li>
            <li><a href="#inquery">お問い合わせ</a></li>
          </ul>
        </div>
      </div>
    </header>
    <div class="main">
      <div class="carousel-wrapper">
        <div class="inner">
          <p>シンプルにマルチ販売を実現する世界へ</p>
          <div class="btns">
            <a href="/admin/login" class="btn btn-top-white btn-lg" target="_blank">Prue販売管理へ</a>
            <a href="/" class="btn btn-top-white btn-lg" target="_blank">Prueショッピングへ</a>
            <a href="/master/login" class="btn btn-top-white btn-lg" target="_blank">管理者画面へ</a>
          </div>       
        </div>
      </div>

    <div class="row">
      @if(session('flash_message'))
          <div class="alert alert-success" onlcick="this.classlist.add('hidden')">{{ session('flash_message') }}</div>
      @endif
      @if(count($errors) > 0)
        @foreach($errors->all() as $error)
          <div class="alert alert-error" onlcick="this.classlist.add('hidden')">{{ $error }}</div>
        @endforeach
      @endif   
    </div>
      <div class="service-wrapper" id="service">
        <h2>サービス</h2>
        <div class="contents">
          <div class="content">
            <div class="curled-box tech signup signup-show"><div class="curled-inner s1"></div></div>
            <h3><span class="">マルチ販売管理</span></h3>
            <p>Prueではamazonデータの取得を行うことで出品指示、在庫情報の取得が可能です。</p>
          </div>

          <div class="content">
            <div class="curled-box tech signup signup-show"><div class="curled-inner s2"></div></div>
            <h3><span class="">Prueでの販売</span></h3>
            <p>Prueへの出品が可能です。</p>
          </div>

          <div class="content">
            <div class="curled-box tech signup signup-show"><div class="curled-inner s3"></div></div>
            <h3><span class="">マルチユーザー管理</span></h3>
            <p>ショッピング利用者、販売事業者、管理者のマルチユーザー管理を実装。販売事業者はサブユーザーの作成も可能です。</p>
          </div>
        </div>

        <!-- /.contents -->
      </div>


      <!-- /.carousel-wrapper -->
      <div class="service-wrapper" id="technology">
        <h2>機能と利用技術</h2>
        <div class="contents">
          <div class="content">
            <div class="curled-box tech signup signup-show"><div class="curled-inner ama"></div></div>
            <h3><span class="">商品情報取得</span></h3>
            <p>商品登録の際にamazonAPIを利用して商品データを取得します</p>
            <h3><span class="">利用技術</span></h3>
            <p><a href="https://developer.amazonservices.jp/">amazon MWS API</a><br>トランザクション処理</p>
          </div>
          <div class="content">
            <div class="curled-box tech"><div class="curled-inner gmaps"></div></div>
            <h3><span class="">店舗マップ公開</span></h3>
            <p>リサイクルショップの店舗マップを公開しています。</p>
            <h3><span class="">利用技術</span></h3>
            <p><a href="https://developers.google.com/maps/?hl=ja"target="_blank">google maps API<br>スクレイピング(<a href="https://github.com/dweidner/laravel-goutte">Goutte</a>)<br>cron（バッチ処理）</p>
          </div>
          <div class="content">
            <div class="curled-box tech"><div class="curled-inner rss"></div></div>
            <h3><span class="">RSSニュースの取得</span></h3>
            <p>お好きなニュースサイトの最新ニュースを自動取得し表示します。</p>
            <h3><span class="">利用技術</span></h3>
            <p>simplexml<br>cron(バッチ処理）</p>
          </div>
        </div>
        <div class="contents">
          <div class="content">
            <div class="curled-box tech signup signup-show"><div class="curled-inner auto"></div></div>
            <h3><span class="">オートコンプリート検索</span></h3>
            <p>商品検索の際に、登録済みの商品についてオートコンプリートを利用して簡単に検索することができます。</p>
            <h3><span class="">利用技術</span></h3>
            <p>Ajax</p>
          </div>
          <div class="content">
            <div class="curled-box tech"><div class="curled-inner pref"></div></div>
            <h3><span class="">住所自動取得</span></h3>
            <p>郵便番号を入力すると住所を自動で入力します。</p>
            <h3><span class="">利用技術</span></h3>
            <p>Ajax(<a href="https://github.com/ajaxzip3/ajaxzip3.github.io" target="_blank">ajaxzip3</a>)</p>
          </div>
          <div class="content">
            <div class="curled-box tech"><div class="curled-inner mail"></div></div>
            <h3><span class="">お問い合わせ通知</span></h3>
            <p>お問い合わせがあった際に、管理側にメールとslackで通知を行います。</p>
            <h3><span class="">利用技術</span></h3>
            <p><a href="https://www.mailgun.com/" terget="_blank">mailgun API<br><a href="https://api.slack.com/incoming-webhooks" terget="_blank">slack webhook</a></p>
          </div>
        </div>

        <!-- /.contents -->
      </div>

      <!-- modal -->
      <div class="modal-wrapper" id="signup-modal">
        <div class="modal">
          <div>
            <i class="fa fa-2x fa-times" id="close-modal"></i>
          </div>
          <div id="content">
            <h3>マルチ出品機能</h3>
            <p>Prueとamazonに同時出品を行うことが可能です。Prueでは様々な事業者様の出品をまとめてPrueショッピングにて公開しております。</p>
    
          </div>
        </div>
      </div>
      <!-- modal -->


      <!-- /.carousel-wrapper -->
      <div class="inquery-wrapper" id="inquery">
        <h2>お問い合わせ</h2>
        {!! Form::open(['method'=>'POST','action'=>'LpController@store', 'id'=>"lp-contact"]) !!}
          {{ csrf_field() }}
          <input type="text" name="name" placeholder="お名前" size="40" class="input">
          <input type="text" name="email" placeholder="メールアドレス" size="40" class="input">
          <textarea name="content" placeholder="お問い合わせ内容"   class="input"></textarea>
          <input type="submit" class="submit" value="送信する">
        {!! Form::close() !!}
      </div>
      <!-- /.inquiry -->
      <div class="clear-fix"></div>
      <footer>
        <div class="footer-nav">
          <p><a href="#service">サービス</a>&nbsp;|&nbsp;<a href="#technology">機能と利用技術</a>&nbsp;|&nbsp;<a href="#inquery">お問い合わせ</a></p>
          <p>&copy;2016&nbsp;prue.</p>
        <!-- /.footer-nav -->
        </div>
      </footer>
      <!-- /.footer-nav -->

    </div>
    <!-- /.main -->
  </div>
  <!-- /.container -->

<script>
$(function(){
  $('#menu').slicknav({
    label: '', //デフォルトは'MENU'
     duration: 750, //アニメーションのスピード
    prependTo: "#menu", //指定した要素内にメニュー表示 デフォルトはbody 
  });
});
</script>


<script>
  //モーダル表示用
  $('.signup-show').click(function(){
      $('#signup-modal').fadeIn();
  });
    
  $('#close-modal').click(function(){
      $('#signup-modal').fadeOut();    
  });
</script>
</body>
</html>
