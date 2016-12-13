@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.contact_master'))
@section('contentheader_title')
  {{ trans('adminlte_lang::message.contact_thanks') }}
@endsection
@section('main-content')
<div class="col-sm-6 box">
    お問い合わせありがとうございました。<br>
    <br>
    <a href="/admin">トップへ戻る</a>
</div>
@stop
