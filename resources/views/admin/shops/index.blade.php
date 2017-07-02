@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.shops'))
@section('contentheader_title')
  {{ trans('adminlte_lang::message.shops') }}
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

      <div class="col-sm-3">
        <h4>店舗（支店）新規作成</h4>
        {!! Form::open(['method'=>'POST', 'action'=>'AdminShopsController@store']) !!}
            <div class="form-group">
                {!! Form::label('shop_list_id',trans('adminlte_lang::message.shop_lists').' :' ) !!}
                {!! Form::select('shop_list_id',[''=> trans('adminlte_lang::message.choose')] + $shop_list,null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('shop_branch_name',trans('adminlte_lang::message.shops').' :' ) !!}
                {!! Form::text('shop_branch_name',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('postal_code',trans('adminlte_lang::message.postal_code').' :' ) !!}
                {!! Form::text('postal_code',null,['class'=>'form-control','onKeyUp' =>'AjaxZip3.zip2addr(this,"","prefecture","city");'] ) !!}
                {{--<input type="text" name="postal_code" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','prefecture','city');" class="form-control">--}}
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
                {!! Form::label('is_active', trans('adminlte_lang::message.active_flg').' :' ) !!}
                {{Form::select('is_active', [ '1' => trans('adminlte_lang::message.active'),  '0' => trans('adminlte_lang::message.nonactive')], 1,['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                {!! Form::submit(trans('adminlte_lang::message.create'), ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

        <h4>店舗新規作成</h4>
          <a href="{{ url('/admin/shop_lists') }}">店舗一覧へ</a>
        {!! Form::open(['method'=>'POST', 'action'=>'AdminShopListController@store']) !!}
        <div class="form-group">
            {!! Form::label('shop_name',trans('adminlte_lang::message.shop_lists').' :' ) !!}
            {!! Form::text('shop_name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
                {!! Form::submit(trans('adminlte_lang::message.create'), ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <!-- end left  -->
    
    <div class="col-sm-9">
    
      @if($shops)
        <table class="table  table-hover" id="foo-table">
          <thead>
            <th>id</th>
            <th>{{ trans('adminlte_lang::message.shop_lists') }}</th>
            <th>{{ trans('adminlte_lang::message.shops') }}</th>
            <th>{{ trans('adminlte_lang::message.prefecture') }}</th>
            <th>{{ trans('adminlte_lang::message.city') }}</th>
            {{--<th>購入数</th>--}}
            {{--<th>最終購入日</th>--}}
            <th>{{ trans('adminlte_lang::message.active_flg') }}</th>
            <th>{{ trans('adminlte_lang::message.created_at') }}</th>
          </thead>
          <tbody>
            @foreach($shops as $shop)
                <tr class="shop">
                    <td class="id">{{ $shop->id }}</td>
                    <td><a href="{{ route('shops.edit',$shop->id) }}" alt="">{{ $shop->shop_name }}</a></td>
                    <td><a href="{{ route('shops.edit',$shop->id) }}" alt="">{{ $shop->shop_branch_name }}</a></td>
                    <td class="shop_prefecture">{{ $shop->prefecture }}</td>
                    <td>{{ $shop->city }}{{ $shop->address }}{{ $shop->address2 }}</td>
                    {{--<td>{{$counts[$shop->id]}}</td>--}}
                    {{--<td>{{$buy_date[$shop->id]}}</td>--}}
                    <td>{{ $shop->is_active==1 ? 'active' : '' }}</td>
                    <td>{{ $shop->created_at ? $shop->created_at->diffForHumans() : 'no date' }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
    @endif
        {{--<div class="col-sm-6 col-sm-offset-5">--}}
            {{--{{$shops->render()}}--}}
        {{--</div>--}}
  </div>
  <!-- end right -->
</div>

@stop
