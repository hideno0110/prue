@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
	{{ trans('adminlte_lang::message.qa') }}
@endsection
@section('main-content')

  <div class="col-sm-6 box">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">サービスは無料で利用できますか？</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body" style="display: none;">
         現在はβ版のため無料でご利用いただけます。
        </div>
      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">amazon APIを利用したいのですが無料で利用できますか？</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body" style="display: none;">
          AmazonAPIの利用にはamazaonMWSの大口会員である必要があります。詳しくはこちらを御覧ください。<br>
          なお、現在当機能は開発テスト中のため、実際にご自身のデータを登録いただくことはできません。何卒ご了承ください。 
        </div>
      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">機能の追加希望があるのですがどうしたら良いですか？</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body" style="display: none;">
          <a href="{{ url('/admin/contact') }} ">お問い合わせ</a>よりご連絡ください。
        </div>
      </div>
  </div>    
@stop
