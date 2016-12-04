@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
    amazon 在庫管理
@endsection

@section('main-content')


<div class="row">

    <table id="foo-table" class="table  table-hover   table-bordered">
        <thead>
        <tr class="active">
          <th>order id</th>
          <th>order date</th>
          <th>status</th>
          <th>sku</th>
          <th>name</th>
          <th>amount</th>
          <th>price</th>
        </tr>
        </thead>
        <tbody>
          {{-- @foreach($amz_lists as $list)   --}}
          {{--   <tr> --}}
          {{--     <td>{{ $list->getAmazonOrderId() }}</td> --}}
          {{--     <td>{{ $list->getPurchaseDate() }} </td> --}}
          {{--     <td>{{ $list->getOrderStatus() }} </td> --}}
          {{--     <td>{{ $list->getBuyerName() }} </td> --}}
          {{--   </tr> --}}
          {{--   @endforeach --}}

        
          @foreach($orders as $list)  
            <tr>

              <td>{{ $list['amazonOrderId'] }}</td>
              <td>{{ $list['purchaseDate'] }}</td>
              <td>{{ $list['status'] }}</td>
              <td>{{ $list['orderitems'][0]['productcode'] }}</td>
              <td>{{ $list['orderitems'][0]['name'] }}</td>
              <td>{{ $list['orderitems'][0]['amount'] }}</td>
              <td>{{ $list['orderitems'][0]['price'] }}</td>

            </tr>
          @endforeach

        
        
        
        </tbody>
    </table>



{{--
    <table id="foo-table" class="table  table-hover   table-bordered">
        <thead>
        <tr class="active">
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
--}}
    
    {{--<div class="col-sm-6 col-sm-offset-5">--}}
            {{--{{$mws_sells->render()}}--}}
        {{--</div>--}}

</div>

@stop
