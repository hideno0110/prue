@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
    {{$inventory->sku }} : {{$inventory->name }}
@endsection
@section('main-content')

    <div class="col-sm-12 box">

        {{--テキスト形式で取得はできる--}}
        {{--{!! Form::text('search_text', null, array('placeholder' => 'Search Shops','class' => 'form-control','id'=>'search_text')) !!}--}}
        {{--shop-idと紐付けたいため、セレクト形式で表示したい--}}
        {{--{!! Form::select('search_text',[''=>'Choose Shops'] + $shops,null,['class'=>'form-control']) !!}--}}
        
    {!! Form::model($inventory, ['method'=>'PATCH','action'=>['AdminInventoriesController@update', $inventory->id],'files'=>true]) !!}
    <!-- left side -->
        <div class="col-sm-3">
            <div class="form-group">
                {!! Form::label('id','ID:') !!}
                {!! $inventory->id !!}
            </div>
            <div class="form-group">
                @if($inventory->sku2) {{$inventory->sku2 }}<br>(旧:{{$inventory->sku }}) @else {{$inventory->sku }} @endif
            </div>
            <div class="form-group col-sm-12 row">
                <div class="col-sm-6 row">
                    {!! Form::label('sku','sku:') !!}
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
                {!! Form::label('item_master_id','Item Master Id:') !!}
                <a href="{{ route('items.edit', $inventory->item_master_id) }}" target="_blank">{!! $inventory->item_master_id !!}</a>
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
                {!! Form::label('memo','memo:') !!}
                {!! Form::textarea('memo',null,['class'=>'form-control','rows'=>3]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active','is_active:') !!}
                {{Form::select('is_active', [ 1 => 'active',  0 => 'non-active'], null,['class'=>'form-control'])}}
            </div>
            <div class="form-group col-sm-12 row">
                <div class="col-sm-4 row">
                    {!! Form::label('free','freee-id:') !!}
                    {!! Form::text('free',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-sm-8 ">
                    {!! Form::label('free_memo','free_memo:') !!}
                    {!! Form::text('free_memo',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <!-- right side -->
    <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('name','Name:') !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('shop_id','Shop:') !!}
                {!! Form::select('shop_id',[''=>'Choose Shops'] + $shops,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('buy_date', 'Buy Date:', ['class' => 'control-label']) !!}
                {!! Form::text('buy_date',null, ['id' => 'datepicker'],['class' => 'control-label']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('number','Number:') !!}
                {{Form::select('number', [0, 1, 2,3,4,5,6,7,8,9,10], null,['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                {!! Form::label('buy_price','Buy Price:') !!}
                {!! Form::text('buy_price',null,array('class'=>'form-control','id'=>'buy_price','onfocus'=>'price()','onkeyup'=>'price()')) !!}
                {{--<input type="text" value="0" name="buy_price" size="10" id="buy_price" onfocus="price()" onkeyup="price()" />--}}
                {{--{!! Form::text('search_text', null, array('placeholder' => 'Search Shops','class' => 'form-control','id'=>'search_text')) !!}--}}
            </div>
            <div class="form-group">
                {!! Form::label('sell_price','Sell Price:') !!}
                {!! Form::text('sell_price',null,array('class'=>'form-control','id'=>'sell_price','onfocus'=>'price()','onkeyup'=>'price()')) !!} 差額：    <span id="ans"></span>円     見込み利益：    <span id="est_profit"></span>円（15% + 300円    ）
            </div>
            <div class="form-group">
                {!! Form::label('payment_id','Payment:') !!}
                {!! Form::select('payment_id',[''=>'Choose Payment type'] + $payment,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('sale_place_id','Sale place:') !!}
                {!! Form::select('sale_place_id',[''=>'Choose Payment'] + $sale_place,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('condition_id','Condition:') !!}
                {!! Form::select('condition_id',[''=>'Choose Condition'] + $condition,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description','Description:') !!}
                {!! Form::textarea('description',null,['class'=>'form-control', 'rows'=>3]) !!}
            </div>
            <div class="form-group">
                <input class="btn btn-primary  col-sm-4 " type="submit" name="list" value="Edit back to list">
            </div>
            <div class="form-group">
                <input class="btn btn-success  col-sm-4 " type="submit" name="edit" value="Edit">
            </div>
        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminInventoriesController@destroy',$inventory->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete inventory', ['class'=>'btn btn-danger col-sm-4']) !!}
            </div>
        {!! Form::close() !!}
        </div>
    </div>




    <div class="row">
        @include('includes.form_error')
    </div>

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

    {{--<input type="text" value="0" name="num0" size="10" id="num0" onfocus="price()" onkeyup="price()" />--}}
    {{--<input type="text" value="0" name="num0" size="10" id="num1" onfocus="price()" onkeyup="price()" />--}}




@stop
