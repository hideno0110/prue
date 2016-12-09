@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.fba_stocks'))
@section('contentheader_title')
    {{ trans('adminlte_lang::message.stocks') }}
@endsection

@section('main-content')

<div class="row">
  <div class="col-sm-12">
    <table class="table  table-hover   table-bordered">
        <thead>
          <tr class="active">
            <th>ID</th>
            <th>SKU</th>
            <th>在庫数</th>
          </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <tr>
                <td> {{ $stock->id }} </td>
                <td> {{ $stock->sku }} </td>
                <td> {{ $stock->stock }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {{--<div class="col-sm-6 col-sm-offset-5">--}}
            {{--{{$mws_sells->render()}}--}}
        {{--</div>--}}
  </div>
</div>  
@stop
