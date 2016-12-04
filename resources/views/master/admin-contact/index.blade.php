
@extends('master.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Contact</div>

                <div class="panel-body">


    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>corp</th>
            <th>name</th>
            <th>sub</th>
            <th>content</th>
        </tr>
        </thead>
        <tbody>

        @if($admin_contacts)
            @foreach($admin_contacts as $admin_contact)

                <tr>
                    <td>{{ $admin_contact->id }}</td>
                    <td>{{ $admin_contact->admin->merchant->name }}</td>
                    <td>{{ $admin_contact->admin->name }}</td>
                    <td>{{ $admin_contact->subject }}</td>
                    <td>{{ $admin_contact->content }}</td>
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
