<ol class="breadcrumb">
    {{--<li><a href="/">Главная</a></li>--}}
    <li><a href="/folders">{{ trans('messages.main') }}</a></li>
    @foreach($breadcrumbs as $breadcrumb)
        @if($breadcrumb == end($breadcrumbs))
            <li class="active">{{ $breadcrumb['name'] }}</li>
        @else
            <li><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
        @endif
    @endforeach
</ol>