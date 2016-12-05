@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
  {{ $user->name }}
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
    <!-- end error msg -->
    <div class="col-sm-3">
        <img src="{{ $user->photo ? url('').$user->photo->file : 'http://placehold.it/400x400' }}" alt="" class="img-responsive img-rounded">
    </div>
    <!-- end left side -->
    <div class="col-sm-9">
        {!! Form::model($user, ['method'=>'PATCH','action'=>['AdminUsersController@update', $user->id],'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('name',trans('adminlte_lang::message.fullname').' :') !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email',trans('adminlte_lang::message.email').' :') !!}
                {!! Form::email('email',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('role_id',trans('adminlte_lang::message.role').' :') !!}
                {!! Form::select('role_id',[''=>'Choose Options'] + $roles ,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active',trans('adminlte_lang::message.active_flg').' :') !!}
                {!! Form::select('is_active',array(1 => trans('adminlte_lang::message.active'), 0 => trans('adminlte_lang::message.nonactive')),null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photo_id',trans('adminlte_lang::message.profile_pic').' :') !!}
                {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password',trans('adminlte_lang::message.password').' :') !!}
                {!! Form::password('password',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit(trans('adminlte_lang::message.update'), ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>
        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$user->id]]) !!}
            <div class="form-group">
                {!! Form::submit(trans('adminlte_lang::message.delete'), ['class'=>'btn btn-danger col-sm-6']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <!-- end right sid -->
</div>

@stop
