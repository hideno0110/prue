@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
	Shop lists
@endsection
@section('main-content')

<div class="row">
<div class="col-sm-12 box">

	<div class="col-sm-3">

			{!! Form::open(['method'=>'POST', 'action'=>'AdminShopListController@store']) !!}
			<div class="box-body">
				<div class="form-group">
					{!! Form::label('shop_name','shop_name:') !!}
					{!! Form::text('shop_name',null,['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('is_active',1) !!}
          {!! Form::submit('Create shop', ['class'=>'btn btn-primary']) !!}
				</div>
			</div>
			{!! Form::close() !!}

			<div class="form-group">
				@include('includes.form_error')
			</div>

	</div>

	<div class="col-sm-6 ">
		@if($shop_lists)

		<table id="foo-table" class="table" >
			<thead>
				<th>id</th>
				<th>shop_name</th>

			</thead>
			<tbody>
			 @foreach($shop_lists as $shop_list)
				 <tr>
					<td>{{ $shop_list->id }}</td>
					<td><a href="{{ route('shop_lists.edit',$shop_list->id) }}" alt="">{{ $shop_list->shop_name }}</a></td>
				 </tr>

			 @endforeach
		 </tbody>
		</table>

		@endif
	</div>
		{{--<div class="col-sm-6 col-sm-offset-5">--}}
			{{--{{$shop_lists->render()}}--}}
{{--</div>--}}
		</div>
</div>

@stop
