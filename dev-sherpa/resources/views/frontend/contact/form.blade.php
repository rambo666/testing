@extends('frontend/layout/layout')

@section('page_banner')
    <div class="container-fluid padding-none">
        <div class="banner banner-image" data-parallax="scroll" data-image-src="{{ url('uploads/contact.jpg') }}">
            <div class="container">
                <section>
                    <h2 class="banner-title">
                        contact us
                    </h2>
                    <div class="banner-label"><p>  {!! isset($contact_intro) ? $contact_intro : ($settings['contact_intro']) !!}</p></div>
                </section>
                @yield('partial/breadcrumbs', Breadcrumbs::render('contact'))
                {{--<ol class="breadcrumb"> <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a><li class="breadcrumb-item active">contact us</li> </ol>--}}
            </div>
        </div>
        <!-- .banner -->
    </div>
@stop

@section('content')
    {{--@include('frontend.layout.header')--}}
    {{--.wrapper--}}
    <div class="wrapper clearfix">
        <div class="content-wrapper">
            @include('frontend.layout.header')

            @include('frontend.contact.showcontent')

            @include('frontend.layout.footer')
        </div>
    </div>

    @include('frontend.layout.modal')
@stop

@section('package-script')
    {!! HTML::script('sherpaassets/lib/js/scripts.js') !!}
@stop
