<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin">TOP</a></li>
        <li class="active">@yield('content_breadcrumb')</li>
    </ol>
@yield('breadcrumbs')
</section>
