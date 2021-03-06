@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.stocks'))
@section('contentheader_title')
    amazon 販売管理
@endsection

@section('main-content')
<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_0" data-toggle="tab">Amazonサマリー</a></li>
        <li><a href="#tab_1" data-toggle="tab">販売</a></li>
        <li><a href="#tab_2" data-toggle="tab">返品</a></li>
        <li><a href="#tab_3" data-toggle="tab">手数料</a></li>
    </ul>
    <!-- /.nav -->

    <div class="tab-content">
        <div class="tab-pane active" id="tab_0">
            <table  id="foo-table"  class="table  table-hover   table-bordered">
                <thead>
                <tr>
                    <th>販売月</th>
                    <th>販売額</th>
                    <th>仕入れ額</th>
                    <th>販売手数料</th>
                    <th>店舗手数料</th>
                    <th>返品額</th>
                    <th>返品手数料</th>
                    <th>販売利益（仕入除く)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($mws_sums as $mws_sum)
                    <tr>
                        <td> {{ $mws_sum->{'month'} }} </td>
                        <td> {{ number_format((int)$mws_sum->{'sales'}) }} </td>
                        <td> {{ number_format((int)$mws_sum->{'buy_price'}) }} </td>
                        <td> {{ number_format((int)$mws_sum->{'sales_fee'}) }} </td>
                        <td> {{ number_format((int)$mws_sum->{'merchant_fee'}) }} </td>
                        <td> {{ number_format((int)$mws_sum->{'refund'}) }} </td>
                        <td> {{ number_format((int)$mws_sum->{'refund_fee'}) }} </td>
                        <td> {{ number_format((int)$mws_sum->{'sales_profit'}) }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <!-- /.tab-pane -->

        <div class="tab-pane" id="tab_1">
            <table  id="foo-table"  class="table  table-hover   table-bordered">
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
                        <td> {{ ltrim($mws_sell->{'posted-date'}, '+00:00') }} </td>
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
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_2">
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
                    <td> {{ ltrim($mws_refund->{'posted-date'}, '+00:00')}} </td>
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
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_3">
        <table  class="table  table-hover  table-bordered">
            <thead>
            <tr>
                <th>月</th>
                <th>FBA利用料</th>
                <th>FBA保管手数料</th>
                <th>FBAパートナーキャリアの配送料</th>
                <th>FBA在庫の廃棄手数料</th>
                <th>FBA在庫の返金</th>
                <th>FBA保管手数料</th>
                <th>合計</th>
            </tr>
            </thead>
            <tbody>
                @foreach($mws_fees as $mws_fee)
                  <tr>
                    <td> {{ $mws_fee->{'month'} }}</td>
                    <td> {{ number_format((int)$mws_fee->{'subscription'}) }}</td>
                    <td> {{ number_format((int)$mws_fee->{'fbainbound'}) }}</td>
                    <td> {{ number_format((int)$mws_fee->{'removal'}) }}</td>
                    <td> {{ number_format((int)$mws_fee->{'disposal'}) }}</td>
                    <td> {{ number_format((int)$mws_fee->{'reversal'}) }}</td>
                    <td> {{ number_format((int)$mws_fee->{'storage'}) }}</td>
                    <td> {{ number_format((int)$mws_fee->{'totalfee'}) }}</td>
                  </tr>
                @endforeach
            </tbody>
        </table>  
    </div>
    <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->

@stop
