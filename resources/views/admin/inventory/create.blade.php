@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.inventories'))
@section('contentheader_title')
    {{ trans('adminlte_lang::message.create_inventory') }}
@endsection

@section('main-content')
    <div class="col-sm-12 box">
        <div class="row">
            @include('includes.form_error')
        </div>
        <!-- end error msg -->

        {!! Form::open(['method'=>'POST','action'=>'AdminInventoriesController@store','files'=>true, 'id'=>"inventory-create"]) !!}


        <div class="col-sm-3">
            <div class="form-group col-sm-12 row">
                <div class="col-sm-6 row">
                    {!! Form::label('sku','SKU:') !!}
                    {!! Form::text('sku',null,['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('asin','ASIN:') !!}
                {!! Form::text('asin',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('jan-code','JANCODE:') !!}
                {!! Form::text('jan_code',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('item_code','商品コード:') !!}
                {!! Form::text('item_code',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('item_master_id',trans('adminlte_lang::message.item_master_id').' :') !!}
                {!! Form::text('item_master_id','',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photos','画像を追加する:') !!}
                <input name="photos[]" type="file" multiple/>
            </div>
            <div class="form-group">
                {!! Form::label('memo',trans('adminlte_lang::message.memo').' :') !!}
                {!! Form::textarea('memo',null,['class'=>'form-control','rows'=>3]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active',trans('adminlte_lang::message.active_flg').' :') !!}
                {{Form::select('is_active', [ 1 => trans('adminlte_lang::message.active'),  0 => trans('adminlte_lang::message.nonactive')], null,['class'=>'form-control'])}}
            </div>
            <div class="form-group col-sm-12 row">
                <div class="col-sm-4 row">
                    {!! Form::label('free',trans('adminlte_lang::message.freee').' :') !!}
                    {!! Form::text('free',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-sm-8 ">
                    {!! Form::label('free_memo',trans('adminlte_lang::message.freee_memo').' :') !!}
                    {!! Form::text('free_memo',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <!-- end left side -->
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('name',trans('adminlte_lang::message.item_name').'(中古説明用) :') !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('shop_id',trans('adminlte_lang::message.shops').' :') !!}
                {!! Form::select('shop_id',[''=>trans('adminlte_lang::message.choose')] + $shops,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('buy_date', trans('adminlte_lang::message.buy_date').' :', ['class' => 'control-label']) !!}
                {!! Form::text('buy_date',null, ['id' => 'datepicker'],['class' => 'control-label']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('number',trans('adminlte_lang::message.buy_item_num').' :') !!}
                {{Form::select('number', [0, 1, 2,3,4,5,6,7,8,9,10], null,['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                {!! Form::label('buy_price',trans('adminlte_lang::message.buy_price').' :') !!}
                {!! Form::text('buy_price',null,array('class'=>'form-control','id'=>'buy_price','onfocus'=>'price()','onkeyup'=>'price()')) !!}
                {{--<input type="text" value="0" name="buy_price" size="10" id="buy_price" onfocus="price()" onkeyup="price()" />--}}
                {{--{!! Form::text('search_text', null, array('placeholder' => 'Search Shops','class' => 'form-control','id'=>'search_text')) !!}--}}
            </div>
            <div class="form-group">
                {!! Form::label('sell_price',trans('adminlte_lang::message.sell_price').' :') !!}
                {!! Form::text('sell_price',null,array('class'=>'form-control','id'=>'sell_price','onfocus'=>'price()','onkeyup'=>'price()')) !!}
                差額： <span id="ans"></span>円 見込み利益： <span id="est_profit"></span>円（15% + 300円 ）
            </div>
            <div class="form-group">
                {!! Form::label('payment_id',trans('adminlte_lang::message.payment').' :') !!}
                {!! Form::select('payment_id',[''=>trans('adminlte_lang::message.choose')] + $payment,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('sale_place_id',trans('adminlte_lang::message.sale_place').' :') !!}
                {!! Form::select('sale_place_id',[''=>trans('adminlte_lang::message.choose')] + $sale_place,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('condition_id',trans('adminlte_lang::message.condition').' :') !!}
                {!! Form::select('condition_id',[''=>'Choose Condition'] + $condition,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description',trans('adminlte_lang::message.description').' :') !!}
                {!! Form::textarea('description',null,['class'=>'form-control', 'rows'=>3]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('batteries_required',trans('adminlte_lang::message.batteries_required').' :') !!}
                {!! Form::select('batteries_required',[0 => 'False', 1 => 'True' ]) !!}
            </div>
            <div class="form-group">
                <input class="btn btn-primary col-sm-6" type="submit" name="new"
                       value="{{ trans('adminlte_lang::message.create') }}">
            </div>
            <div class="form-group">
                <input class="btn btn-success  col-sm-6 " type="submit" name="continue"
                       value="{{ trans('adminlte_lang::message.create_continue') }}">
            </div>
            {!! Form::close() !!}
        </div>
        <!-- end form -->
    </div>
    <!-- 仕入商品の予想利益計算 -->
    <script type="text/javascript">
      function price() {
        var buy_price = document.getElementById('buy_price').value;
        var sell_price = document.getElementById('sell_price').value;
        var ans = parseInt(sell_price) - parseInt(buy_price);
        document.getElementById('ans').innerHTML = ans;

        var est_profit = parseInt(sell_price) * 0.85 - parseInt(buy_price) - 300;
        document.getElementById('est_profit').innerHTML = est_profit;

        if (ans < 0) {
          document.getElementById('ans').style.color = "red";
          document.getElementById('est_profit').style.color = "red";
        } else {
          document.getElementById('ans').style.color = "black";
          document.getElementById('est_profit').style.color = "black";
        }
      }
    </script>
@stop
