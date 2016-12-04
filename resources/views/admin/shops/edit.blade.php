@extends('vendor.adminlte.layouts.app')

@section('contentheader_title')
	{{$shop->shop_list->shop_name}} {{$shop->shop_branch_name}}
@endsection

@section('main-content')

<div class="row">

<div class="col-sm-12 box">

  <script type="text/javascript">
  	// コントローラから渡された住所を取得
  	var addressStr = "{!! $shop->prefecture !!}{!! $shop->city !!}{!! $shop->address !!}";
  
  	$(document).ready(function(){
  		// Gmapsを利用してマップを生成
  		var map = new GMaps({
  			div: '#map',
  			lat: -12.043333,
  			lng: -77.028333
  		});
  
  		// 住所からマップを表示
  		GMaps.geocode({
  			address: addressStr.trim(),
  			callback: function(results, status) {
          console.log(status);
  				if (status == 'OK') {
  					var latlng = results[0].geometry.location;
  					map.setCenter(latlng.lat(), latlng.lng());
  					map.addMarker({
  						lat: latlng.lat(),
  						lng: latlng.lng()
  					});
  				}
  			}
  		});
  	});
  </script>

	<div class="col-sm-6">

			{!! Form::model($shop, ['method'=>'PATCH', 'action'=>['AdminShopsController@update',$shop->id]]) !!}

				<div class="form-group">
					{!! Form::label('shop_list_id','shop_name:') !!}
					{!! Form::select('shop_list_id',[''=>'Choose Shop'] + $shop_list,null,['class'=>'form-control']) !!}
				</div>


				<div class="form-group">
					{!! Form::label('shop_branch_name','shop_branch_name:') !!}
					{!! Form::text('shop_branch_name',null,['class'=>'form-control']) !!}
				</div>


				<div class="form-group">
					{!! Form::label('postal_code','postal_code:') !!} <a href="https://www.google.co.jp/#q={{$shop->shop_list->shop_name}} {{$shop->shop_branch_name}}" target="_blank">google search</a>
					{!! Form::text('postal_code',null,['class'=>'form-control','onKeyUp' =>'AjaxZip3.zip2addr(this,"","prefecture","city");'] ) !!}

				</div>
				<div class="form-group">
					{!! Form::label('prefecture','prefecture:') !!}
					{!! Form::text('prefecture',null,['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('city','city:') !!}
					{!! Form::text('city',null,['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('address','address:') !!}
					{!! Form::text('address',null,['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('address2','building:') !!}
					{!! Form::text('address2',null,['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('is_active','is_active:') !!}
					{{Form::select('is_active', [ 1 => 'active',  0 => 'non-active'], null,['class'=>'form-control'])}}
				</div>

				{{--<div class="form-group">--}}
					{{--{!! Form::submit('Update shop', ['class'=>'btn btn-primary col-sm-6']) !!}--}}
				{{--</div>--}}

				<div class="form-group">
					<input class="btn btn-primary  col-sm-4 " type="submit" name="list" value="Update back to list">
				</div>
				<div class="form-group">
					<input class="btn btn-success  col-sm-4 " type="submit" name="edit" value="Update">
				</div>

			{!! Form::close() !!}

			{!! Form::open( ['method'=>'DELETE', 'action'=>['AdminShopsController@destroy',$shop->id]]) !!}


				{{--<div class="form-group">--}}
					{{--{!! Form::submit('Delete shop', ['class'=>'btn btn-danger col-sm-6']) !!}--}}
				{{--</div>--}}
			{!! Form::close() !!}



	</div>
	<div class="col-sm-6">
		<h3>購入リスト</h3>
	<table class="table">
		<thead>
		<th>sku</th>
		<th>商品名</th>
		<th>購入日</th>
		</thead>
		@foreach($inventories as $inventory)
			<tr>
				<td><a href="{{ route('inventories.edit',$inventory->id) }}">{{$inventory->sku}}</a></td>
				<td>{{$inventory->name}}</td>
				<td>{{$inventory->buy_date}}</td>
			</tr>
		@endforeach
	</table>

    <h3>地図</h3>
    <p>住所：{!! $shop->prefecture !!}{!! $shop->city !!}{!! $shop->address !!}</p>
    <div id="map"></div>
</div>
</div>
</div>
@stop
