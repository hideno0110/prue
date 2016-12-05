@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
  {{ trans('adminlte_lang::message.merchant_setting') }}
@endsection

@section('main-content')
  <div class="col-sm-12 box">
    @if(session('flash_message'))
        <div class="alert alert-success" onlcick="this.classlist.add('hidden')">{{ session('flash_message') }}</div>
    @endif
    <!-- end flash msg -->
    <div class="row">
        @include('includes.form_error')
    </div>

    <div class="col-sm-3">
        <img src="{{ $merchant->photo ? url('').$merchant->photo->file : 'http://placehold.it/200x200' }}" alt="" class="img-responsive img-rounded">
    </div>
    <!-- end left  -->
    <div class="col-sm-9">
        {!! Form::model($merchant, ['method'=>'PATCH','action'=>['AdminMerchantController@update', $merchant->id],'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name',trans('adminlte_lang::message.merchant_name').' :' ) !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tel',trans('adminlte_lang::message.tel').' :' ) !!}
            {!! Form::text('tel',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('mail',trans('adminlte_lang::message.email').' :' ) !!}
            {!! Form::text('mail',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('postal_code',trans('adminlte_lang::message.postal_code').' :' ) !!}
            {!! Form::text('postal_code',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('prefecture',trans('adminlte_lang::message.prefecture').' :' ) !!}
            {!! Form::text('prefecture',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('city',trans('adminlte_lang::message.city').' :' ) !!}
            {!! Form::text('city',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address',trans('adminlte_lang::message.address').' :' ) !!}
            {!! Form::text('address',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address2',trans('adminlte_lang::message.address2').' :' ) !!}
            {!! Form::text('address2',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit(trans('adminlte_lang::message.update'), ['class'=>'btn btn-primary col-sm-6']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <!-- end right  -->
</div>

@stop
