@extends('frontend/layout/layout')

@section('content')
    {{--@include('frontend.layout.header')--}}
    {{--.wrapper--}}
    <div class="wrapper clearfix">
       
        <div class="content-wrapper">
            @include('frontend.layout.header')

            <section id="error" class="container">
                <h1>404, Page not found</h1>
                <p>The Page you are looking for doesn't exist or an other error occurred.</p>
                <a class="btn btn-success" href="{{ url('/') }}">GO BACK TO THE HOMEPAGE</a>
            </section><!--/#error-->

          
        </div>
    </div>

    @include('frontend.layout.modal')


@stop

