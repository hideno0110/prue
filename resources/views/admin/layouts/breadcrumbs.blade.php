@if ($breadcrumbs)
<ul class="breadcrumb">
    @foreach($breadcrumbs as $breadcrumb)
    @if(!$breadcrumb->last)
    <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
    @else
    <li>{{ $breadcrumb->title }}</li>
    @endif
    @endforeach
</ul>
@endif
