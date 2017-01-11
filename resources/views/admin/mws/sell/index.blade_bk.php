@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.stocks'))
@section('contentheader_title')
    amazon 在庫管理
@endsection

@section('main-content')

<div class="col-sm-12 nav-tabs-custom">
  <!-- タブ -->
  <ul class="nav nav-tabs">
    <li class="nav-item active">
      <a href="#tab0" class="nav-link bg-primary" data-toggle="tab" >Amazon統計</a>
    </li>
    <li class="nav-item">
      <a href="#tab1" class="nav-link bg-primary" data-toggle="tab" >販売</a>
    </li>
    <li class="nav-item">
      <a href="#tab2" class="nav-link bg-primary" data-toggle="tab" >返品</a>
    </li>
    <li class="nav-item">
      <a href="#tab3" class="nav-link bg-primary" data-toggle="tab" >手数料</a>
    </li>
  </ul>


  <div class="tab-content">
    <div id="tab0" class="tab-pane active">
test
    </div>
  </div>

  <div class="tab-content">
    <div id="tab1" class="tab-pane">
    <table  class="table  table-hover   table-bordered">
        <thead>
        <tr>
            <th>販売日</th>
            <th>仕入日</th>
            <th>日数</th>
            <th>orederNo</th>
            <th>SKU</th>
            <th>商品名</th>
            <th>URL</th>
            <th>販売価格</th>
            <th>仕入価格</th>
            <th>利益</th>
            <th>利益率</th>
            <th>手数料</th>
            <th>梱包手数料</th>
            <th>重量手数料</th>
            <th>ギフト包装料</th>
            <th>返金手数料</th>
            <th>配送料チャージバック</th>
            <th>カテゴリー成約料</th>
            <th>代引手数料返戻金</th>
        </tr>
        </thead>
        <tbody>
        @foreach($mws_sells as $mws_sell)
            @if($mws_sell->profit >= 3000 )<tr class="success">@elseif ($mws_sell->profit < 0 )<tr class="danger">@else <tr class="active">  @endif
                <td> {{ $mws_sell->{'posted-date'} }} </td>
                <td> {{ $mws_sell->buy_date }} </td>
            @if($mws_sell->date >= 90 )<td class="danger">@elseif ($mws_sell->date < 30 )<td class="info">@else <td class="active"> @endif {{ $mws_sell->date }} </td>
                <td>{{ $mws_sell->{'order-id'} }}</td>
                <td> <a href="{{ url('')}}/admin/inventories/{{$mws_sell->inv_id}}/edit" target="_blank">{{ $mws_sell->sku }} </a></td>
                <td> <a href="{{ url('')}}/admin/inventories/{{$mws_sell->inv_id}}/edit" target="_blank">{{ $mws_sell->name }}</a></td>
                <td><a href="https://www.amazon.co.jp/gp/product/{{$mws_sell->asin}}" target="_blank"><img src="{{url('')}}/img/amazon.jpg" height="20"></a>
                    <a href="http://mnrate.com/item/aid/{{$mws_sell->asin}}" target="_blank"><img src="{{url('')}}/img/monorate.png" height="20"></a> </td>
                <td> {{ $mws_sell->{'price-amount'} }} </td>
                <td> {{ $mws_sell->{'buy_price'} }} </td>
                <td> {{ $mws_sell->{'profit'} }} </td>
                <td> {{ $mws_sell->{'profit_per'} }} </td>
                <td> {{ $mws_sell->{'Commission'} }} </td>
                <td> {{ $mws_sell->{'FBAPerUnitFulfillmentFee'} }} </td>
                <td> {{ $mws_sell->{'FBAWeightBasedFee'} }} </td>
                <td> {{ $mws_sell->{'GiftwrapChargeback'} }} </td>
                <td> {{ $mws_sell->{'RefundCommission'} }} </td>
                <td> {{ $mws_sell->{'ShippingChargeback'} }} </td>
                <td> {{ $mws_sell->{'VariableClosingFee'} }} </td>
                <td> {{ $mws_sell->{'CODFee'} }} </td>
            </td>
        @endforeach
        </tbody>
    </table>
    </div>
  </div>
  <div class="tab-content">
    <div id="tab2" class="tab-pane">

    <table class="table  table-hover   table-bordered">
        <thead>
        <tr>
            <th>返品日</th>
            <th>仕入日</th>
            <th>日数</th>
            <th>orederNo</th>
            <th>SKU</th>
            <th>商品名</th>
            <th>URL</th>
            <th>販売価格</th>
            <th>仕入価格</th>
            <th>利益</th>
            <th>利益率</th>
            <th>手数料</th>
            <th>梱包手数料</th>
            <th>重量手数料</th>
            <th>ギフト包装料</th>
            <th>返金手数料</th>
            <th>配送料チャージバック</th>
            <th>カテゴリー成約料</th>
            <th>代引手数料返戻金</th>
        </tr>
        </thead>
        <tbody>
        @foreach($mws_refunds as $mws_refund)
            @if($mws_refund->profit >= 3000 )<tr class="success">@elseif ($mws_refund->profit < 0 )<tr class="danger">@else <tr class="active">  @endif
                <td> {{ $mws_refund->{'posted-date'} }} </td>
                <td> {{ $mws_refund->buy_date }} </td>
            @if($mws_refund->date >= 90 )<td class="danger">@elseif ($mws_refund->date < 30 )<td class="info">@else <td class="active"> @endif {{ $mws_refund->date }} </td>
                <td>{{ $mws_refund->{'order-id'} }}</td>
                <td> <a href="{{ url('')}}/admin/inventories/{{$mws_refund->inv_id}}/edit" target="_blank">{{ $mws_refund->sku }} </a></td>
                <td> <a href="{{ url('')}}/admin/inventories/{{$mws_refund->inv_id}}/edit" target="_blank">{{ $mws_refund->name }}</a></td>
                <td><a href="https://www.amazon.co.jp/gp/product/{{$mws_refund->asin}}" target="_blank"><img src="{{url('')}}/img/amazon.jpg" height="20"></a>
                    <a href="http://mnrate.com/item/aid/{{$mws_refund->asin}}" target="_blank"><img src="{{url('')}}/img/monorate.png" height="20"></a> </td>
                <td> {{ $mws_refund->{'price-amount'} }} </td>
                <td> {{ $mws_refund->{'buy_price'} }} </td>
                <td> {{ $mws_refund->{'profit'} }} </td>
                <td> {{ $mws_refund->{'profit_per'} }} </td>
                <td> {{ $mws_refund->{'Commission'} }} </td>
                <td> {{ $mws_refund->{'FBAPerUnitFulfillmentFee'} }} </td>
                <td> {{ $mws_refund->{'FBAWeightBasedFee'} }} </td>
                <td> {{ $mws_refund->{'GiftwrapChargeback'} }} </td>
                <td> {{ $mws_refund->{'RefundCommission'} }} </td>
                <td> {{ $mws_refund->{'ShippingChargeback'} }} </td>
                <td> {{ $mws_refund->{'VariableClosingFee'} }} </td>
                <td> {{ $mws_refund->{'CODFee'} }} </td>
            </td>
        @endforeach
        </tbody>
    </table>
    </div>
  </div>

  <div class="tab-content">
    <div id="tab3" class="tab-pane">
    <table  class="table  table-hover  table-bordered">
        <thead>
        <tr>
            <th>タイプ</th>
            <th></th>
            <th>仕入日</th>
        </tr>
        </thead>
        <tbody>
        @foreach($mws_fees as $mws_fee)
          <tr>
            <td> {{ $mws_fee->{'transaction-type'} }}</td>
            <td> {{ $mws_fee->{'posted-date'} }}</td>
            <td> {{ $mws_fee->{'other-amount'} }}</td>
          </tr>
        @endforeach
    </div>
  </div>

   {{--  
    <div class="col-sm-6 col-sm-offset-5">
        {{$mws_sells->render()}}
    </div>
    --}}
</div>

@stop
