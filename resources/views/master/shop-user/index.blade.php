@extends('master.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">ショッピング会員</div>

                <div class="panel-body">


    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>有効フラグ</th>
            <th>作成日</th>
            <th>更新日</th>
        </tr>
        </thead>
        <tbody>

        @if($shop_users)
            @foreach($shop_users as $shop_user)

                <tr>
                    <td>{{ $shop_user->id }}</td>
                    <td><a href="{{ route('users.edit',$shop_user->id) }}">{{ $shop_user->name }}</a></td>
                    <td>{{ $shop_user->email }}</td>
                    <td>{{ $shop_user->is_active == 1 ? 'Active' : 'NO Active'  }}</td>
                    <td>{{ $shop_user->created_at->diffForHumans() }}</td>
                    <td>{{ $shop_user->updated_at->diffForHumans() }}</td>
                </tr>


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
