@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.items'))
@section('contentheader_title')
  {{ trans('adminlte_lang::message.create_item') }}
@endsection

@section('main-content')
    <div class="col-sm-6 box">
        @if(session('flash_message'))
            <div class="alert alert-success" onlcick="this.classlist.add('hidden')">{{ session('flash_message') }}</div>
        @endif
        <div class="row">
            @include('includes.form_error')
        </div>
        {!! Form::open(['method'=>'POST','action'=>'AdminItemMasterController@store','files'=>true, 'id'=>"item-create"]) !!}
            <div class="form-group">
                {!! Form::label('asin','ASIN:') !!} <span class='label label-danger'>{{ trans('adminlte_lang::message.require_asin_jan_itme') }}</span>
                {!! Form::text('asin',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('jan_code',trans('adminlte_lang::message.jan_code').' :' ) !!} 
                {!! Form::text('jan_code',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('item_code',trans('adminlte_lang::message.item_code').' :' ) !!} 
                {!! Form::text('item_code',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name',trans('adminlte_lang::message.item_name').' :' ) !!} 
                {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('item_detail',trans('adminlte_lang::message.description').' :' ) !!}
                {!! Form::textarea('item_detail',null,['class'=>'form-control', 'rows'=>3]) !!}
            </div>
            <div class="form-group">
                <input class="btn btn-primary col-sm-6" type="submit" name="new" value="{{ trans('adminlte_lang::message.create') }}">
            </div>
            <div class="form-group">
                <input class="btn btn-success  col-sm-6 " type="submit" name="continue" value="{{ trans('adminlte_lang::message.create_continue') }}">
            </div>
        {!! Form::close() !!}
    </div>
@stop
