@extends('app')

@section('meta_title', trans('messages.500_server_error'))

@section('content')

<h1>500</h1>
<p class="text-danger">{{ trans('messages.server_error') }}</p>
@endsection