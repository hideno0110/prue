@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.inventories'))
@section('contentheader_title')
  {{ trans('adminlte_lang::message.inventories') }}  {{ trans('adminlte_lang::message.search_result').' : ' }}{!! $count_inv !!}
@endsection
@section('main-content')
<div class="row">
  <div class="col-sm-12 box">
    <div class="col-sm-11 inventory">
        {!! Form::open(['method'=>'GET','action'=>'AdminInventoriesController@index','class'=>'form-inline']) !!}
        <div class="form-group">
            {!! Form::text('asin', $asin ? $asin : null,array('class'=>'form-control','size'=>'15', 'placeholder'=>'ASIN')) !!}
        </div>
        <div class="form-group">
            {!! Form::text('sku',$sku ? $sku : null,array('class'=>'form-control','size'=>'30', 'placeholder'=>'SKU')) !!}
        </div>
        <div class="form-group">
            {!! Form::text('name', $name ? $name : null, array('placeholder' => trans('adminlte_lang::message.item_name') ,'class' => 'form-control','size'=>'40','id'=>'search_text')) !!}
        </div>
        <div class="form-group">
             {!! Form::text('shopname', $shopname ? $shopname : null, array('placeholder' => trans('adminlte_lang::message.shop_lists'),'class' => 'form-control','id'=>'search_text2')) !!}
        </div>
        <div class="form-group">
            {!! Form::select('condition_id[]',[''=> trans('adminlte_lang::message.choose_condition')] + $condition,$condition_ids ? $condition_ids : null,['size' => 2, 'multiple'=>'multiple','class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('sale_place_id[]',[''=> trans('adminlte_lang::message.choose_saleplace')] + $sale_place,$sale_place_ids ? $sale_place_ids : null,['size' => 2, 'multiple'=>'multiple','class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('description',$description ? $description : null,array('class'=>'form-control','size'=>'40', 'placeholder'=> trans('adminlte_lang::message.description'))) !!}
        </div>
        <div class="form-group">
            {!! Form::date('buy_date',null,array('class'=>'form-control', 'placeholder'=> trans('adminlte_lang::message.buy_date'))) !!}
        </div>
        <div class="form-group">
            {!! Form::text('memo', $memo ? $memo : null,array('class'=>'form-control', 'placeholder'=> trans('adminlte_lang::message.memo'))) !!}
        </div>
        <div class="form-group">
            {!! Form::text('free', $free ? $free : null,array('class'=>'form-control','size'=>'6', 'placeholder'=> trans('adminlte_lang::message.freee'))) !!}
        </div>

        <button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.search') }}</button>
        <button type="submit" class="btn btn-normal" name="clear" value="clear">{{ trans('adminlte_lang::message.clear') }}</button>
        <button type="submit" class="btn btn-warning" name="download" value="inv">{{ trans('adminlte_lang::message.dl_inv') }}</button>
        <button type="submit" class="btn btn-warning" name="download" value="fba">{{ trans('adminlte_lang::message.dl_fba') }}</button>

        {!! Form::close() !!}
    </div>


    <div class="col-sm-6 col-sm-offset-5">
        {{$inventories->appends(['asin'=>$asin,'sku'=>$sku,'name'=>$name,'condition_id'=>$condition_ids,'sale_place_id'=>$sale_place_ids,'memo'=>$memo,'free'=>$free])->render()}}


    </div>

    <table class="table table-striped table-bordered  table-hover" id="edit-table">
        <thead>
          <tr>
            <th>@sortablelink ('id',trans('adminlte_lang::message.id'))</th>

            <th>@sortablelink ('sku', trans('adminlte_lang::message.sku'))</th>:
            <th>@sortablelink ('asin',trans('adminlte_lang::message.asin'))</th>
            <th>{{ trans('adminlte_lang::message.item_name') }}</th>
            <th>{{ trans('adminlte_lang::message.item_master_id') }}</th>
            <th>{{ trans('adminlte_lang::message.item_pic') }} </th>
            <th>{{ trans('adminlte_lang::message.item_pic') }} </th>
            <th>{{ trans('adminlte_lang::message.shops') }}</th>
            <th>{{ trans('adminlte_lang::message.buy_date') }}</th>
            <th>{{ trans('adminlte_lang::message.buy_item_num') }}</th>
            <th>{{ trans('adminlte_lang::message.buy_price') }}</th>
            <th>{{ trans('adminlte_lang::message.sell_price') }}</th>
            <th>{{ trans('adminlte_lang::message.payment') }}</th>
            <!-- <th>{{ trans('adminlte_lang::message.sale_place') }}</th> -->
            <th>{{ trans('adminlte_lang::message.condition') }}</th>
            <!-- <th>{{ trans('adminlte_lang::message.description') }}</th> -->
            <th>{{ trans('adminlte_lang::message.memo') }}</th>
            <!-- <th>@sortablelink ('free')</th> -->
            <th>{{ trans('adminlte_lang::message.created_at') }}</th>
            <th>{{ trans('adminlte_lang::message.updated_at') }}</th>
           </tr>
        </thead>
        <tbody>

        @if($inventories)
        @foreach($inventories as $inventory)

          <tr class="inventory">
            <td class="id">{{ $inventory->id }}</td>

            <td> @if($inventory->sku2) {{$inventory->sku2 }}<br>(旧:{{$inventory->sku }}) @else {{$inventory->sku }} @endif</td>
            <td><a href="{{ route('inventories.edit',$inventory->id)}}" alt="">{{ $inventory->asin }}</a></td>
            <td><a href="{{ route('inventories.edit',$inventory->id)}}" alt="">{{ $inventory->item_master->name}}</a></td>
            <td><a href="{{ route('items.edit',$inventory->item_master_id)}}" alt="" target="_blank">{{ $inventory->item_master_id }}</a></td>
            <td align="center"><a href="{{ route('inventories.edit',$inventory->id)}}" alt=""><img src="{{ $inventory->item_master->file }}"></a></td>
            <td align="center">
              @foreach($inventory->inv_photo as $photo)
                @if($photo->number == 1)
                  <a href="{{ route('inventories.edit',$inventory->id)}}" alt=""><img height="50" src="{{ $photo->file ? $photo->file : 'http://placehold.it/50x50' }}" alt="" class="img-rounded"></a>
                @else
                @endif
              @endforeach
            </td>
            <td>{{ $inventory->shop_id ? $inventory->shop->shop_list->shop_name : '' }} {{ $inventory->shop_id ? $inventory->shop->shop_branch_name : '' }}</td>
            <td>{{ $inventory->buy_date }}</td>
            <td>{{ $inventory->number }}</td>
            <td>@if ($inventory->buy_price - $inventory->sell_price >= 0)
                    <span class="label label-danger"> {{$inventory->buy_price}} </span>
                @else {{$inventory->buy_price}}
                @endif
            </td>
            <td>{{ $inventory->sell_price }}</td>
            <td>{{ $inventory->payment_id ? $inventory->payment->name : '' }}</td>
            {{-- <td>{{ $inventory->sale_place_id ? $inventory->sale_place->name : '' }}</td> --}}
            <td>@if ($inventory->condition_id == 11)
                    <span class="label label-success">{{ $inventory->condition->name}}</span>
                @elseif ($inventory->condition_id == 1)
                    <span class="label label-primary">{{ $inventory->condition->name}}</span>
                @elseif ($inventory->condition_id == 2)
                    <span class="label label-info">{{ $inventory->condition->name}}</span>
                @elseif ($inventory->condition_id == 3)
                    <span class="label label-warning">{{ $inventory->condition->name}}</span>
                @elseif ($inventory->condition_id == 4)
                    <span class="label label-default">{{ $inventory->condition->name}}</span>
                @else
                    {{ $inventory->condition_id ? $inventory->condition->name : '' }}
                @endif
            </td>
            {{-- <td>{{ $inventory->description }}</td> --}}
            <td class="memo">{{ $inventory->memo }}</td>
            {{-- <td class="free">{{ $inventory->free }}</td> --}}
            <td>{{ $inventory->created_at->diffForHumans() }}</td>
            <td>{{ $inventory->updated_at->diffForHumans() }}</td>
          </tr>


        @endforeach
        @endif
        </tbody>
    </table>



    <div class="col-sm-6 col-sm-offset-5">
        {{$inventories->render()}}
    </div>
</div>
    <script>
        $(document).ready(function() {
//            console.log(' start');
            src = "{{ route('search_inventories') }}";
//            console.log(src);

            $("#search_text").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('search_inventories') }}",
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


    <script>
        $(document).ready(function() {
//            console.log(' start');
            src = "{{ route('searchajax') }}";
//            console.log(src);

            $("#search_text2").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('searchajax') }}",
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



@stop
