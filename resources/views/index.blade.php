@extends('app')

@section('meta_title', trans('index.meta_title'))

@section('content')

<h1>{{ trans('index.main') }}</h1>

<p class="text-info">{{ trans('index.thank_you_for_registration') }}</p>
<p class="text-info">{{ trans('index.write_to_us') }}</p>
@endsection