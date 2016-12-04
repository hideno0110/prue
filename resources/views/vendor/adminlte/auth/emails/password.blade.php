{{-- resources/views/emails/password.blade.php --}}

{{ trans('adminlte_lang::message.passwordclickreset') }} <a href="{{ url('/admin/password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a>
