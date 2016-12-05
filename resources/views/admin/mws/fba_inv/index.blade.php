@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.fba_stocks'))
@section('contentheader_title')
    FBA在庫管理
@endsection

@section('main-content')


<div class="row">


    <div class="col-sm-12">

    <table id="foo-table" class="table  table-hover   table-bordered">
        <thead>
        <tr class="active">

            <th>SKU</th>
            <th>FNSKU</th>
            <th>画像</th>
            <th>商品名</th>
            <th>仕入れ日</th>
            <th>販売日数</th>
            <th>期間</th>
            <th>仕入れ価格</th>
            <th>数量</th>
            <th>状態</th>

        </tr>
        </thead>
        <tbody>
        @foreach($fba_invs as $fba_inv)
            @if($fba_inv->diffdate < 60 && $fba_inv->diffdate > 30)<tr class="success"> @elseif($fba_inv->diffdate < 90 && $fba_inv->diffdate >= 60)<tr class="warning">@elseif($fba_inv->diffdate >= 90)<tr class="danger"> @endif

                <td> {{ $fba_inv->sku }} </td>
                <td> {{ $fba_inv->fnsku }} </td>
                <td> <img src="http://images-jp.amazon.com/images/P/{{ $fba_inv->asin }}.09.THUMBZZZ.jpg"> </td>
                <td> {{ $fba_inv->name }} </td>
                <td> {{ $fba_inv->buy_date }} </td>
                <td> {{ $fba_inv->diffdate }} </td>
                <td> {{ $fba_inv->diffterm }} </td>
                <td> {{ $fba_inv->buy_price }} </td>
                <td> {{ $fba_inv->number }} </td>
                <td> {{ $fba_inv->status }} </td>


            </tr>
        @endforeach
        </tbody>
    </table>
        {{--<div class="col-sm-6 col-sm-offset-5">--}}
            {{--{{$mws_sells->render()}}--}}
        {{--</div>--}}

</div>

@stop
