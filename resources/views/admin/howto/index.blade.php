@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.howto'))
@section('contentheader_title')
    {{ trans('adminlte_lang::message.howto') }}
@endsection
@section('main-content')

  <div class="col-sm-6 box">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">商品を登録する</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body" style="display: block;">
          Start creating your amazing application!
        </div>
      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">仕入登録をする</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body" style="display: none;">
          Start creating your amazing application!
        </div>
      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">amazon APIに接続する</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body" style="display: none;">
          Start creating your amazing application!
        </div>
      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">RSS ニュースを取得する</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body" style="display: none;">
          RSSを用いて最新のニュースを表示することが可能です。<br>
          <a href="{{ url('admin/rss-read') }}">RSSニュース</a>のRSS URLにお好きなサイトのRSSを登録すると１時間に１度最新のニュースを取得し表示します。<br><br>
          <p>参考RSS</p>
          <ul>
            <li><a href="http://headlines.yahoo.co.jp/rss/list" target="_blank">yahoo ニュース</a></li>
            <li><a href="http://www.zou3.net/php/?page=rss&sub=nikkei" target="_blank">日本経済新聞</a></li>
            <li>http://rssblog.ameba.jp/【アメーバID】/rss.html </li>
          </ul>
          <img src="/images/howto_rss.png" width="650">
        </div>
      </div>
  </div>    
@stop
