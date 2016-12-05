@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
    {{$shop_list->shop_name}}
@endsection

@section('main-content')
<div class="row">
    <div class="col-sm-12 box">



<div class="col-sm-6">

    <div class="form-group">
        @include('includes.form_error')
    </div>


    {!! Form::model($shop_list, ['method'=>'PATCH', 'action'=>['AdminShopListController@update',$shop_list->id]]) !!}

            <div class="form-group">
                {!! Form::label('shop_name','shop_name:') !!}
                {!! Form::text('shop_name',null,['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('is_active','is_active:') !!}
                {{Form::select('is_active', [ 1 => 'active',  0 => 'non-active'], null,['class'=>'form-control'])}}
            </div>

            <div class="form-group">
                {!! Form::submit('Update shop', ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>
        {!! Form::close() !!}

        {{--{!! Form::open( ['method'=>'DELETE', 'action'=>['AdminShopListController@destroy',$shop_list->id]]) !!}--}}


            {{--<div class="form-group">--}}
                {{--{!! Form::submit('Delete shop', ['class'=>'btn btn-danger col-sm-6']) !!}--}}
            {{--</div>--}}
        {{--{!! Form::close() !!}--}}
</div>


</div>
</div>
@stop
