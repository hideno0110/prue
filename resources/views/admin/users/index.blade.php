@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb',trans('adminlte_lang::message.users'))
@section('contentheader_title')
{{ trans('adminlte_lang::message.users') }}
@endsection

@section('main-content')
<div class="col-sm-12 box">

    @if(Session::has('deleted_user'))
        <p class="bg-danger">{{ session('deleted_user') }}</p>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>{{ trans('adminlte_lang::message.profile_pic') }}</th>
            <th>{{ trans('adminlte_lang::message.fullname') }}</th>
            <th>{{ trans('adminlte_lang::message.email') }}</th>
            <th>{{ trans('adminlte_lang::message.role') }}</th>
            <th>{{ trans('adminlte_lang::message.active_flg') }}</th>
            <th>{{ trans('adminlte_lang::message.created_at') }}</th>
            <th>{{ trans('adminlte_lang::message.updated_at') }}</th>
        </tr>
        </thead>
        <tbody>

        @if($users)
            @foreach($users as $user)

                <tr>
                    <td>{{ $user->id }}</td>
                    <td><img height="50" src="{{ $user->photo ?  url('').$user->photo->file : 'http://placehold.it/400x400' }}" alt=""></td>
                    <td><a href="{{ route('users.edit',$user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->is_active == 1 ? trans('adminlte_lang::message.active') : trans('adminlte_lang::message.nonactive')  }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                </tr>


            @endforeach
        @endif
        </tbody>
    </table>
    <a href="{{route('users.create')}}"><input class="btn btn-primary col-sm-6" type="submit" name="new" value="{{ trans('adminlte_lang::message.create_user') }}"></a>
</div>
@stop
