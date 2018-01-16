@extends('frontend/layout/layout')

@section('content')

    {{--.wrapper--}}
    <div class="wrapper clearfix">
        <div class="content-wrapper">
            @include('frontend/layout/header')
            @include('frontend.destination.indexcontent')
            @include('frontend.layout.footer')
        </div>
    </div>
    @include('frontend.layout.modal')
@stop

@section('package-script')
    {!! HTML::script('sherpaassets/lib/js/scripts.js') !!}
@stop
