@extends('master.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">登録者一覧（サブユーザー含む）</div>

                <div class="panel-body">


    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>ロゴ</th>
            <th>会社・事業者</th>
            <th>画像</th>
            <th>お名前</th>
            <th>メールアドレス</th>
            <th>権限</th>
            <th>有効フラグ</th>
            <th>作成日</th>
            <th>更新日</th>
        </tr>
        </thead>
        <tbody>

        @if($admin_users)
            @foreach($admin_users as $admin_user)

                <tr>
                    <td>{{ $admin_user->id }}</td>
                    <td><img src="{{ $admin_user->merchant->photo ? $admin_user->merchant->photo->file :  'http://placehold.it/50x50'}}" height="50"></td>
                    <td>{{ $admin_user->merchant->name }}</td>
                    <td><img height="50" src="{{ $admin_user->photo ?  url('').$admin_user->photo->file : 'http://placehold.it/400x400' }}" alt=""></td>
                    <td><a href="{{ route('users.edit',$admin_user->id) }}">{{ $admin_user->name }}</a></td>
                    <td>{{ $admin_user->email }}</td>
                    <td>{{ $admin_user->role->name }}</td>
                    <td>{{ $admin_user->is_active == 1 ? 'Active' : 'NO Active'  }}</td>
                    <td>{{ $admin_user->created_at->diffForHumans() }}</td>
                    <td>{{ $admin_user->updated_at->diffForHumans() }}</td>
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
