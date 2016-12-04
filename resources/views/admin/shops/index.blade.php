@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
  {{ trans('adminlte_lang::message.shops') }}
@endsection

@section('main-content')


<div class="row">
	<div class="col-sm-12 box">

<div class="col-sm-3">
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

		{!! Form::open(['method'=>'POST', 'action'=>'AdminShopListController@store']) !!}
		<div class="form-group">
			{!! Form::label('shop_name',trans('adminlte_lang::message.shop_lists').' :' ) !!}
			{!! Form::text('shop_name',null,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
				{!! Form::submit(trans('adminlte_lang::message.create'), ['class'=>'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}

	<div class="row">
		@include('includes.form_error')
	</div>

</div>

<div class="col-sm-9">
	{{--{!! Form::open(['method'=>'GET','action'=>'AdminShopsController@index','class'=>'form-inline']) !!}--}}
	{{--<div class="form-group">--}}
		{{--{!! Form::text('shop_name', $shop_name ? $shop_name : null,array('class'=>'form-control', 'placeholder'=>'店名')) !!}--}}
	{{--</div>--}}
	{{--<div class="form-group">--}}
		{{--{!! Form::text('shop_branch_name',$shop_branch_name ? $shop_branch_name : null,array('class'=>'form-control', 'placeholder'=>'支店名')) !!}--}}
	{{--</div>--}}
	{{--<div class="form-group">--}}
		{{--{!! Form::text('prefecture',$prefecture ? $prefecture : null,array('class'=>'form-control', 'placeholder'=>'都道府県')) !!}--}}
	{{--</div>--}}
	{{--<div class="form-group">--}}
		{{--{!! Form::text('prefecture',$prefecture ? $prefecture : null,array('class'=>'form-control', 'placeholder'=>'最終購入日')) !!}--}}
	{{--</div>--}}


	{{--<button type="submit" class="btn btn-primary">Search</button>--}}


	{{--{!! Form::close() !!}--}}

	{{--<div class="col-sm-6 col-sm-offset-5">--}}
		{{--{{$shops->render()}}--}}
	{{--</div>--}}
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
</div>
</div>


@stop
