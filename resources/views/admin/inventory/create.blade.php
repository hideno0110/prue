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
                {!! Form::label('shop_list',trans('adminlte_lang::message.shops').' :') !!}
                <select class="parent form-control" name="日付" required id="shop_list">
                    <option value="" class="msg" disabled selected>-----店を選択-----</option>
                    @foreach($shop_list as $shop)
                        <option value="{{ $shop->id  }}">{{ $shop->shop_name }}</option>
                    @endforeach
                </select>

                <select class="children form-control" id="shop_id" name="shop_id">
                    <option value="" class="msg" disabled selected>-----支店を選択-----</option>
                    @foreach($shop_branch_list as $branch_list)
                        <option value="{{ $branch_list->id  }}"
                                data-val="{{ $branch_list->shop_list_id }}">{{ $branch_list->shop_branch_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {!! form::label('buy_date', trans('adminlte_lang::message.buy_date').' :', ['class' => 'control-label']) !!}
                {!! form::text('buy_date',null, ['id' => 'datepicker'],['class' => 'control-label']) !!}
            </div>
            <div class="form-group">
                {!! form::label('number',trans('adminlte_lang::message.buy_item_num').' :') !!}
                {{form::select('number', [0, 1, 2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24], null,['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                {!! form::label('buy_price',trans('adminlte_lang::message.buy_price').' :') !!}
                {!! form::text('buy_price',null,array('class'=>'form-control','id'=>'buy_price','onfocus'=>'price()','onkeyup'=>'price()','onblur'=>'num_only()')) !!}
                {{--<input type="text" value="0" name="buy_price" size="10" id="buy_price" onfocus="price()" onkeyup="price()" />--}}
                {{--{!! form::text('search_text', null, array('placeholder' => 'search shops','class' => 'form-control','id'=>'search_text')) !!}--}}
            </div>
            <div class="form-group">
                {!! form::label('sell_price',trans('adminlte_lang::message.sell_price').' :') !!}
                {!! form::text('sell_price',null,array('class'=>'form-control','id'=>'sell_price','onfocus'=>'price()','onkeyup'=>'price()','onblur'=>'num_only()')) !!}
                差額： <span id="ans"></span>円 見込み利益： <span id="est_profit"></span>円（15% + 300円 ）
            </div>
            <div class="form-group">
                {!! form::label('payment_id',trans('adminlte_lang::message.payment').' :') !!}
                {!! form::select('payment_id',[''=>trans('adminlte_lang::message.choose')] + $payment,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! form::label('sale_place_id',trans('adminlte_lang::message.sale_place').' :') !!}
                {!! form::select('sale_place_id',[''=>trans('adminlte_lang::message.choose')] + $sale_place,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! form::label('condition_id',trans('adminlte_lang::message.condition').' :') !!}
                {!! form::select('condition_id',[''=>'choose condition'] + $condition,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! form::label('description',trans('adminlte_lang::message.description').' :') !!}
                {!! form::textarea('description',null,['class'=>'form-control', 'rows'=>3]) !!}
            </div>
            <div class="form-group">
                {!! form::label('batteries_required',trans('adminlte_lang::message.batteries_required').' :') !!}
                {!! form::select('batteries_required',[0 => 'false', 1 => 'true' ]) !!}
            </div>
            <div class="form-group">
                <input class="btn btn-primary col-sm-6" type="submit" name="new"
                       value="{{ trans('adminlte_lang::message.create') }}">
            </div>
            <div class="form-group">
                <input class="btn btn-success  col-sm-6 " type="submit" name="continue"
                       value="{{ trans('adminlte_lang::message.create_continue') }}">
            </div>
            {!! form::close() !!}
        </div>
        <!-- end form -->
    </div>

    <!-- 支店リスト -->
    <script type="text/javascript">
      $(function () {
        var $children = $('.children');
        var original = $children.html();

        $('.parent').change(function () {
          var val1 = $(this).val();

          $children.html(original).find('option').each(function () {
            var val2 = $(this).data('val');
            if (val1 != val2) {
              $(this).not('optgroup,.msg').remove();
            }
          });

          if ($(this).val() === '') {
            $children.attr('disabled', 'disabled');
          } else {
            $children.removeAttr('disabled');
          }

        });
      });

      <!-- 仕入商品の予想利益計算 -->
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

      function num_only() {
        var buy_price = document.getElementById('buy_price').value;
        // 数値以外の入力消去
        document.getElementById('buy_price').value = buy_price.replace(/[^\d-.]/g, '');

        var sell_price = document.getElementById('sell_price').value;
        document.getElementById('sell_price').value = sell_price.replace(/[^\d-.]/g, '');
      }

      <!-- 商品説明 -->

      ( function () {
        var description = {
          'condition': [
            '',
            '【特別特価】新品未使用品となります。'
          ]
        };

        document.getElementById('condition_id').addEventListener('change', select_action, false);
        function select_action() {
          var selected_value = document.getElementById('condition_id').selectedIndex;
          if (document.getElementById('condition_id').selectedIndex == 1) {
            document.getElementById('description').value = description['condition'][selected_value];
          }
        }
      }());
    </script>

@stop
