@extends('master.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Rss Lists</div>

                <div class="panel-body">

                  <table class="table">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Logo</th>
                          <th>Merchant</th>
                          <th>Admin Id</th>
                          <th>Rss URL</th>
                          <th>Created</th>
                      </tr>
                      </thead>
                      <tbody>
              
                      @if($rss_lists)
                          @foreach($rss_lists as $rss_list)
              
                              <tr>
                                  <td>{{ $rss_list->id }}</td>
                                  <td><img src="{{$rss_list->admin->merchant->photo->file }}" height="50"></td>
                                  <td>{{$rss_list->admin->merchant->name }}</td>
                                  <td>{{$rss_list->admin_id }}</td>
                                  <td><a href="{{ $rss_list->url }}">{{ $rss_list->url }}</a></td>
                                  <td>{{ $rss_list->created_at->diffForHumans() }}</td>
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
