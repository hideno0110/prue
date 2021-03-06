@extends('master.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">会社・事業者</div>

                <div class="panel-body">


    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>ロゴ</th>
            <th>会社・事業者</th>
            <th>メールアドレス</th>
            <th>電話番号</th>
            <th>住所</th>
            <th>有効フラグ</th>
            <th>作成日</th>
            <th>更新日</th>
        </tr>
        </thead>
        <tbody>

        @if($merchants)
            @foreach($merchants as $merchant)

                <tr>
                    <td>{{ $merchant->id }}</td>
                    <td><img height="50" src="{{ $merchant->photo ?  url('').$merchant->photo->file : 'http://placehold.it/400x400' }}" alt=""></td>
                    <td>{{ $merchant->name }}</td>
                    <td>{{ $merchant->mail }}</td>
                    <td>{{ $merchant->tel }}</td>
                    <td>{{ $merchant->prefecture }}{{ $merchant->city }}{{ $merchant->address }}{{ $merchant->address2 }}</td>
                    <td>{{ $merchant->is_active == 1 ? 'Active' : 'NO Active'  }}</td>
                    <td>{{ $merchant->created_at->diffForHumans() }}</td>
                    <td>{{ $merchant->updated_at->diffForHumans() }}</td>
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
