@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.items'))
@section('contentheader_title')
  {{ trans('adminlte_lang::message.upload_list') }}
@endsection

@section('main-content')

<div class="col-sm-12 box">

	<div class="col-sm-3">

		{!! Form::open(['method'=>'POST', 'action'=>'AdminUploadController@store','files'=>true]) !!}
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('inventories','inventoriesを追加する:') !!}
				<input name="inventories" type="file" />
			</div>
			<div class="form-group">
				<input class="btn btn-primary col-sm-6" type="submit" name="inventories" value="upload inventories">
			</div>
		</div>
		{!! Form::close() !!}

		{!! Form::open(['method'=>'POST', 'action'=>'AdminUploadController@store','files'=>true]) !!}
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('shops','shopを追加する:') !!}
				<input name="shops" type="file" />
			</div>
			<div class="form-group">
				<input class="btn btn-primary col-sm-6" type="submit" name="shops" value="upload shops">
			</div>
		</div>
		{!! Form::close() !!}

		{!! Form::open(['method'=>'POST', 'action'=>'AdminUploadController@store','files'=>true]) !!}
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('shop_lists','shop_listsを追加する:') !!}
				<input name="shop_lists" type="file" />
			</div>
			<div class="form-group">
				<input class="btn btn-primary col-sm-6" type="submit" name="shop_lists" value="upload shop_lists">
			</div>
		</div>
		{!! Form::close() !!}

		{!! Form::open(['method'=>'POST', 'action'=>'AdminUploadController@store','files'=>true]) !!}
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('fba_inventories','fba_inventoriesを追加する:') !!}
				<input name="fba_inventories" type="file" />
			</div>
			<div class="form-group">
				<input class="btn btn-primary col-sm-6" type="submit" name="fba_inventories" value="uploadfba_inventories">
			</div>
		</div>
		{!! Form::close() !!}

		{!! Form::open(['method'=>'POST', 'action'=>'AdminUploadController@store','files'=>true]) !!}
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('mws_sells','mws_sellsを追加する:') !!}
				<input name="mws_sells" type="file" />
			</div>
			<div class="form-group">
				<input class="btn btn-primary col-sm-6" type="submit" name="mws_sells" value="uploadfba_mws_sells">
			</div>
		</div>
		{!! Form::close() !!}


		<div class="form-group">
				@include('includes.form_error')
			</div>

	</div>
	<script type="text/javascript" src="/js/add.js"></script>

	名前を入力してください。
	<br><br>
	<input type="text" id="name" name="name"> //名前入力欄
	<br><br>
	パスワードを入力してください。
	<br><br>
	<input type="password" id="password" name="password"> //パスワード入力欄
	<br><br>
	<input type="submit" id="submit" name="submit" value="送信"> //送信ボタン




</div>

@stop
