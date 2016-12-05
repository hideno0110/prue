@extends('master.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">店舗</div>

                <div class="panel-body">


    <table class="table">
        <thead>
        <tr>
            <th>店舗Id</th>
            <th>ロゴ</th>
            <th>会社・事業者</th>
            <th>店舗</th>
            <th>店舗（支店） ID</th>
            <th>支店名</th>
            <th>住所</th>
            <th>作成日</th>
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
