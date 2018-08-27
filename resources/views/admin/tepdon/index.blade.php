@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.tepdon'))
@section('contentheader_title')
    {{ trans('adminlte_lang::message.tepdon') }}
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



        {!! Form::model(['method'=>'POST','action'=>['AdminTepdonController@index']]) !!}
        <div class="form-group">
            {!! Form::textarea('urls',null,['class'=>'form-control', 'rows'=>5]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('chunk', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

        <div class="form-group">
            {!! Form::textarea( 'aa',$result[0] ,['class'=>'form-control', 'rows'=>30]) !!}
        </div>






    </div>
@stop
