@extends('frontend/layout/layout')

@section('content')

    {{--.wrapper--}}
    <div class="wrapper search clearfix">
        <div class="content-wrapper">
            @include('frontend/layout/header')

            @if( isset( $metadata ) )
                @include('frontend.search.showcontent')
            @else
                @include('frontend.search.none')
            @endif

            @include('frontend.layout.footer')
        </div>
    </div>
    @include('frontend.layout.modal')
@stop

@section('package-script')
    {!! HTML::script('sherpaassets/lib/js/scripts.js') !!}
@stop