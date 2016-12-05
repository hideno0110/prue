@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
  {{ trans('adminlte_lang::message.contact_master') }}
@endsection
@section('main-content')


    <div class="col-sm-6 box">

        @if(session('flash_message'))
            <div class="alert alert-success" onlcick="this.classList.add('hidden')">{{ session('flash_message') }}</div>
        @endif


    {!! Form::open(['method'=>'POST','action'=>'AdminContactController@store', 'id'=>"contact"]) !!}
      {{ csrf_field() }}
      <div class="form-group">
                {!! Form::label('merchant_name', trans('adminlte_lang::message.merchant_name').' :' ) !!}
        {{ Auth::guard('admin')->user()->merchant->name}}        
                {!! Form::hidden('merchant_id',Auth::guard('admin')->user()->merchant->id) !!}
      </div>
            <div class="form-group">
                {!! Form::label('name',trans('adminlte_lang::message.fullname').' :') !!}
        {{ Auth::guard('admin')->user()->name}}        
                {!! Form::hidden('admin_id',Auth::guard('admin')->user()->id) !!}
      </div>
            <div class="form-group">
                {!! Form::label('subject',trans('adminlte_lang::message.contact_genre').' :') !!}

        {!! Form::select('subject', [
           '0' => trans('adminlte_lang::message.contact_genre0'),
           '1' => trans('adminlte_lang::message.contact_genre1'),
           '2' => trans('adminlte_lang::message.contact_genre2'),
           '3' => trans('adminlte_lang::message.contact_genre3')
          ]
        ) !!}

            </div>
            <div class="form-group">
                {!! Form::label('content',trans('adminlte_lang::message.contact_genre3')) !!}
                {!! Form::textarea('content',null,['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-group">
                <input class="btn btn-primary col-sm-6" type="submit" name="new" value="送信する">
            </div>
        {!! Form::close() !!}

    </div>

    <div class="row">
        @include('includes.form_error')
    </div>


@stop
