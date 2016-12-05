@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.rss_news'))
@section('contentheader_title')
  {{ trans('adminlte_lang::message.rss_news') }}
@endsection
@section('main-content')

<div class="row">
<div class="col-sm-12 box">

    <div class="col-sm-3">

            {!! Form::open(['method'=>'POST', 'action'=>'AdminRssController@store']) !!}
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('url', trans('adminlte_lang::message.rss_url') ) !!}
                    {!! Form::text('url',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit(trans('adminlte_lang::message.create') , ['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            <div class="form-group">
                @include('includes.form_error')
            </div>

    </div>

    <div class="col-sm-8 ">
        @if($items_lists)

        <table id="foo-table" class="table" >
            <thead>
        <th>{{ trans('adminlte_lang::message.published_at') }}</th>
                <th>{{ trans('adminlte_lang::message.title') }}</th>
        <th>{{ trans('adminlte_lang::message.rss_place') }}</th>
            </thead>
            <tbody>
       
      @foreach($items_lists as $list) 
          <tr>
            <td>{{ $list['date'] }}</td>
            <td><a href="{{ $list['link'] }}" target="_blank">{{ $list['title'] }}</a></td>
            <td>{{ $list['site'] }}</td>
                 </tr>
      @endforeach

         </tbody>
        </table>

        @endif
    </div>
        </div>
</div>

@stop
