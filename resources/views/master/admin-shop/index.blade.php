@extends('master.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Shop List</div>

                <div class="panel-body">


    <table class="table">
        <thead>
        <tr>
            <th>Shop Id</th>
            <th>Logo</th>
            <th>Merchant</th>
            <th>Shop</th>
            <th>Shop Branch ID</th>
            <th>Branch</th>
            <th>Address</th>
            <th>Created</th>
        </tr>
        </thead>
        <tbody>
        
          
          @if($shops)
            @foreach($shops as $shop)
              @foreach($shop->shops as $branch)
                <tr>
                    <td>{{ $shop->id }}</td>
                    <td><img src="{{ $shop->merchant->photo->file }}" height="50"></td>
                    <td>{{ $shop->merchant->name }}</td>
                    <td>{{ $shop->shop_name }}</td>
                    <td>{{ $branch->id }}</td>
                    <td>{{ $branch->shop_branch_name }}</td>
                    <td>{{ $branch->prefecture }}</td>
                    <td>{{ $branch->city }}{{ $branch->address }}{{ $branch->address2 }}</td>
                    <td>{{ $branch->created_at->diffForHumans() }}</td>
                </tr>
              @endforeach
            @endforeach
        @endif
        </tbody>
    </table>
                
                
                
                
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
