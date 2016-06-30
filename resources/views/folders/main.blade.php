@extends('app')

@section('meta_title', trans('folders.meta_title'))


@section('content')
<div class="top-line">
    <div class="row">
        <div class="col-sm-6">
            @include('include.search')
            <br/>
            <h1>{{ trans('folders.files_and_folders') }}</h1>
        </div>
    </div>
</div>

@include('include.breadcrumbs')

<div class="row">
    <div class="col-sm-6 col-lg-4">
        <div class="section-item">
            <img src="{{ asset('/assets/img/sections/section1.jpg') }}" alt=""/>
            <a href="#" class="section-link"></a>
            <div class="section-center">
                <div class="section-title section-title-white">
                    <span>Products</span> (56)
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="section-item">
            <img src="{{ asset('/assets/img/sections/section2.jpg') }}" alt=""/>
            <a href="#" class="section-link"></a>
            <div class="section-center">
                <div class="section-title">
                    <span>Brandbook</span> (5)
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="section-item">
            <img src="{{ asset('/assets/img/sections/section3.jpg') }}" alt=""/>
            <a href="#" class="section-link"></a>
            <div class="section-center">
                <div class="section-title">
                    <span>Video</span> (2)
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="section-item">
            <img src="{{ asset('/assets/img/sections/section4.jpg') }}" alt=""/>
            <a href="#" class="section-link"></a>
            <div class="section-center">
                <div class="section-title">
                    <span>POSm</span> (2)
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="section-item">
            <img src="{{ asset('/assets/img/sections/section5.jpg') }}" alt=""/>
            <a href="#" class="section-link"></a>
            <div class="section-center">
                <div class="section-title">
                    <span>Events</span> (2)
                </div>
            </div>
        </div>
    </div>
</div>


@endsection