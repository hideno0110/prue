@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.inventories'))
@section('contentheader_title')
    {{$inventory->sku }} : {{$inventory->name }}
@endsection
@section('main-content')

  <div class="col-sm-12 box">
      <!-- @if(session('flash_message')) -->
      <!--     <div class="alert alert&#45;success" onlcick="this.classlist.add('hidden')">{{ session('flash_message') }}</div> -->
      <!-- @endif -->
      <!-- <!&#45;&#45; end flash msg &#45;&#45;> -->
      <div class="row">
          @include('includes.form_error')
      </div>
      <!-- end error msg -->
      {!! Form::model($inventory, ['method'=>'PATCH','action'=>['AdminInventoriesController@update', $inventory->id],'files'=>true]) !!}
        <div class="col-sm-3">
            <div class="form-group">
                {!! Form::label('id','ID:') !!}
                {!! $inventory->id !!}
            </div>
            <div class="form-group">
              {!! Form::label('sku','SKU:') !!}  
              @if($inventory->sku2) {{$inventory->sku2 }}<br>(旧:{{$inventory->sku }}) @else {{$inventory->sku }} @endif
            </div>
            <div class="form-group col-sm-12 row">
                <div class="col-sm-6 row">
                    {!! Form::label('sku','SKU:') !!}
                    {!! Form::text('sku',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-sm-6 ">
                    {!! Form::label('sku2','new SKU:') !!}
                    {!! Form::text('sku2',null,['class'=>'form-control']) !!}
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
                {!! Form::label('item_master_id',trans('adminlte_lang::message.item_master_id').' :') !!}
                <a href="{{ route('items.edit', $inventory->item_master_id) }}" target="_blank">{!! $inventory->item_master_id !!} <i class="fa fa-link" aria-hidden="true"></i></a>
            </div>
            <div class="form-group">
                {!! Form::label('photos','画像を追加する:') !!}
                <input name="photos[]" type="file" multiple/>
            </div>
            <div class="form-group">
                @foreach($invphotos as $photo)
                    @if($photo->number == 1)
                        <img height="100" src="{{ $photo->file ? '/images/inv/'.$photo->file : 'http://placehold.it/400x400' }}" alt="" class="img-responsive img-rounded">
                    @else
                        <img height="100" src="{{ $photo->file ? '/images/inv/'.$photo->file : 'http://placehold.it/50x50' }}" alt="" class="img-rounded">
                    @endif
                @endforeach
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
                {!! Form::label('name',trans('adminlte_lang::message.item_name').' :') !!}
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
                {!! Form::text('sell_price',null,array('class'=>'form-control','id'=>'sell_price','onfocus'=>'price()','onkeyup'=>'price()')) !!} 差額：    <span id="ans"></span>円     見込み利益：    <span id="est_profit"></span>円（15% + 300円    ）
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
                <input class="btn btn-primary  col-sm-4 " type="submit" name="list" value="{{ trans('adminlte_lang::message.update_list') }}">
            </div>
            <div class="form-group">
                <input class="btn btn-success  col-sm-4 " type="submit" name="edit" value="{{ trans('adminlte_lang::message.update') }}">
            </div>
        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminInventoriesController@destroy',$inventory->id]]) !!}
            <div class="form-group">
                {!! Form::submit(trans('adminlte_lang::message.delete'), ['class'=>'btn btn-danger col-sm-4']) !!}
            </div>
        {!! Form::close() !!}
        </div>
        <!-- end right side -->
    </div>
    <!-- end form -->
    <script>
        $(document).ready(function() {
            console.log(' start');
            src = "{{ route('searchajax') }}";
            console.log(src);

            $("#search_text").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: src,
                        dataType: "json",
                        data: {
                            term : request.term
                        },
                        success: function(data) {
                            response(data);

                        }
                    });
                },
                min_length: 3,
            });
        });
    </script>

    <script type="text/javascript">
        function price() {
            var buy_price = document.getElementById('buy_price').value;
            var sell_price = document.getElementById('sell_price').value;
            var ans = parseInt(sell_price) - parseInt(buy_price);
            document.getElementById('ans').innerHTML = ans;

            var est_profit = parseInt(sell_price) *0.85 - parseInt(buy_price) - 300;
            document.getElementById('est_profit').innerHTML = est_profit;

            if(ans < 0){
                document.getElementById('ans').style.color = "red";
                document.getElementById('est_profit').style.color = "red";
            }else{
                document.getElementById('ans').style.color = "black";
                document.getElementById('est_profit').style.color = "black";
            }
        }


    </script>

@stop
