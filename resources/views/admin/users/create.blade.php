@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.users'))
@section('contentheader_title')
  {{ trans('adminlte_lang::message.create_user') }}
@endsection

@section('main-content')
  <div class="col-sm-6 box">
    @if(session('flash_message'))
        <div class="alert alert-success" onlcick="this.classlist.add('hidden')">{{ session('flash_message') }}</div>
    @endif
    <!-- end flash msg -->
    <div class="row">
        @include('includes.form_error')
    </div>
    <!-- end error msg -->

    {!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store','files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('name', trans('adminlte_lang::message.fullname').' :') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', trans('adminlte_lang::message.email').' :' ) !!}
        {!! Form::email('email',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', trans('adminlte_lang::message.role').' :' ) !!}
        {!! Form::select('role_id',[''=>'Choose Options'] + $roles ,null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active', trans('adminlte_lang::message.active_flg').' :' ) !!}
        {!! Form::select('is_active',array(1 => trans('adminlte_lang::message.active'), 0 =>trans('adminlte_lang::message.nonactive') ),null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('photo_id', trans('adminlte_lang::message.profile_pic').' :' ) !!}
        {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', trans('adminlte_lang::message.password').' :' ) !!}
        {!! Form::password('password',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit(trans('adminlte_lang::message.create'), ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>

@stop
