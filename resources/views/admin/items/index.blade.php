@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.items'))
@section('contentheader_title')
   {{ trans('adminlte_lang::message.items') }}
@endsection
@section('main-content')
<div class="row">
  <div class="col-sm-12 box">


    @if($items)
        <!-- <table class="table  table&#45;hover" id="foo&#45;table"> -->
        <table class="table  table-hover" >
            <thead>
            <th>ID</th>
      <th>ASIN</th>
      <th>{{ trans('adminlte_lang::message.jan_code') }}</th>
      <th>{{ trans('adminlte_lang::message.item_code') }}</th>
      <th>{{ trans('adminlte_lang::message.item_pic') }}</th>
      <th>{{ trans('adminlte_lang::message.item_name') }}</th>
      <th>{{ trans('adminlte_lang::message.created_at') }}</th>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr class="item">
                    <td><a href="{{ route('items.edit',$item->id) }}">{{ $item->id }}</a></td>
          <td><a href="{{ route('items.edit',$item->id) }}">{{ $item->asin }}</a></td>
          <td><a href="{{ route('items.edit',$item->id) }}">{{ $item->jan_code }}</a></td>
          <td><a href="{{ route('items.edit',$item->id) }}">{{ $item->item_code }}</a></td>
          <td><a href="{{ route('items.edit',$item->id) }}"><img src="{{ $item->file }}"></a></td>
          <td><a href="{{ route('items.edit',$item->id) }}">{{ $item->name }}</a></td>       
          <td>{{ $item->created_at ? $item->created_at->diffForHumans() : 'no date' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif




  </div>
</div>
@stop
