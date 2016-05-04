@extends('app')

@section('meta_title', trans('messages.404_page_not_found'))

@section('content')

<h1>404</h1>
<p class="text-danger">{{ trans('messages.page_not_found') }}</p>
@endsection