@extends('frontend/layout/layout')

@section('home_slider')
    <div class="container-fluid padding-none">
        @include('frontend.layout.slider')
    </div>
    @endsection

@section('content')

    {{--.wrapper--}}
    <div class="wrapper clearfix">
        {{-- @include('frontend/layout/sidebar')  --}}
        <div class="content-wrapper">

            @include('frontend.layout.header')

            @include('frontend.layout.homecontent')

            @include('frontend.layout.footer')
        </div>
    </div>
    {{--Modal content--}}
    @include('frontend.layout.modal')
@stop

@section('package-script')
    {!! HTML::script('sherpaassets/lib/js/homescripts.js') !!}
    @stop