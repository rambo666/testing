{{-- Show all packages of current activity --}}
@extends('frontend/layout/layout')

@section( 'meta' )
    <?php $meta_keywords = $regions->meta_keywords; ?>
    <?php $meta_description = $regions->meta_description; ?>
@stop

@section('content')

    {{--.wrapper--}}
    <div class="wrapper clearfix">
        <div class="content-wrapper">
            @include('frontend/layout/header')
            @include('frontend.region.showcontent')
            @include('frontend.layout.footer')
        </div>
    </div>
    @include('frontend.layout.modal')
@stop

@section('package-script')
    {!! HTML::script('sherpaassets/lib/js/scripts.js') !!}
@stop