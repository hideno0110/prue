@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.items'))
@section('contentheader_title')
    {{$item->id }} : {{$item->name }}
@endsection
@section('main-content')

<div class="col-sm-12 box">
<!-- @if(session('flash_message')) -->
<!--     <div class="alert alert&#45;success" onlcick="this.classlist.add('hidden')">{{ session('flash_message') }}</div> -->
<!-- @endif -->
<!-- end flash msg -->
<div class="row">
    @include('includes.form_error')
</div>
<!-- end error msg -->

{!! Form::model($item, ['method'=>'PATCH','action'=>['AdminItemMasterController@update', $item->id],'files'=>true]) !!}
<!-- left side -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('id','ID:') !!}
            {!! $item->id !!}
        </div>
        <div class="form-group">
            <img src="{!!$item->file !!}">
        </div>
        <div class="form-group">
            @if($item->asin != '')
            {!! Form::label('rank',trans('adminlte_lang::message.ranking').' :' ) !!}
            {!! $item->category !!} {!! number_format(intval($item->rank)) !!}位 
              <a href="https://www.amazon.co.jp/dp/{{ $item->asin }}" terget="_blank"><img src="/images/ama.png" height="20">amazonで確認</a> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('asin','ASIN:') !!}
            {!! Form::text('asin',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('jan-code',trans('adminlte_lang::message.jan_code').' :' ) !!}
            {!! Form::text('jan_code',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('item_code',trans('adminlte_lang::message.item_code').' :' ) !!}
            {!! Form::text('item_code',null,['class'=>'form-control']) !!}
        </div>
    </div>
    <!-- right side -->
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name',trans('adminlte_lang::message.item_name').' :' ) !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group ">
            {!! Form::label('item_detail',trans('adminlte_lang::message.item_detail').' :' ) !!}
            {!! Form::textarea('item_detail',null,['class'=>'form-control','rows'=>5]) !!}
        </div>
        <div class="form-group">
            <input class="btn btn-primary  col-sm-4 " type="submit" name="list" value="{{ trans('adminlte_lang::message.update_list') }}">
        </div>
        <div class="form-group">
            <input class="btn btn-success  col-sm-4 " type="submit" name="edit" value="{{ trans('adminlte_lang::message.update') }}">
        </div>
    {!! Form::close() !!}
  {{--
    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminItemMasterController@destroy',$item->id]]) !!}
        <div class="form-group">
            {!! Form::submit(trans('adminlte_lang::message.delete'), ['class'=>'btn btn-danger col-sm-4']) !!}
        </div>
    {!! Form::close() !!}
  --}}
    </div>
</div>

<div class="col-sm-10">
 <table class="table table-striped table-bordered  table-hover" id="edit-table">
   <thead>
     <tr>
       <th>ID</th>
       <th>{{ trans('adminlte_lang::message.sku') }}</th>
       <th>{{ trans('adminlte_lang::message.asin') }}</th>
       <th>{{ trans('adminlte_lang::message.shops') }}</th>
       <th>{{ trans('adminlte_lang::message.buy_date') }}</th>
       <th>{{ trans('adminlte_lang::message.condition') }}</th>
       <th>{{ trans('adminlte_lang::message.buy_item_num') }}</th>
     </th>
   </thead>
   <tbody>
    @if($item->inventories)
      @foreach($item->inventories as $inventory)
      <tr class="inventory">
       <td><a href="{{ route('inventories.edit',$inventory->id) }}">{{ $inventory->id }}</a></td>
       <td><a href="{{ route('inventories.edit',$inventory->id) }}">@if($inventory->sku2) {{$inventory->sku2 }}<br>(旧:{{$inventory->sku }}) @else {{$inventory->sku }} @endif</a></td>
       <td><a href="{{ route('inventories.edit',$inventory->id) }}">{{ $inventory->asin }}</a></td>
       <td><a href="{{ route('shops.edit',$inventory->shop_id) }}">{{ $inventory->shop_id ? $inventory->shop->shop_list->shop_name : '' }} {{ $inventory->shop_id ? $inventory->shop->shop_branch_name : '' }}</a></td>
       <td>{{ $inventory->buy_date }}</td>
       <td>@if ($inventory->condition->type == 11)
               <span class="label label-success">{{ $inventory->condition->name}}</span>
           @elseif ($inventory->condition->tyep == 1)
               <span class="label label-primary">{{ $inventory->condition->name}}</span>
           @elseif ($inventory->condition->type == 2)
               <span class="label label-info">{{ $inventory->condition->name}}</span>
           @elseif ($inventory->condition->type == 3)
               <span class="label label-warning">{{ $inventory->condition->name}}</span>
           @elseif ($inventory->condition->type == 4)
               <span class="label label-default">{{ $inventory->condition->name}}</span>
           @else
               {{ $inventory->condition_id ? $inventory->condition->name : '' }}
           @endif
       </td>
       <td>{{ $inventory->number }}</td>
      </tr>
      @endforeach
    @endif
   </tbody>
 </table>
</div>    
@stop
