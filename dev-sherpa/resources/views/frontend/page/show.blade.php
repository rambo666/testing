@extends('frontend/layout/layout')

@section('page_banner')
    
        @if(isset($banner))
                <?php
                    $content_image = $banner['content'][0]['content_image'];
                    $content_image_url = url( 'uploads/content/' . $content_image ); 
                ?>
                <div class="banner banner-image" style="background:url('{{ $content_image_url }}'); background-size:cover; background-attachment: fixed;">
                    <div class="container">
                        <section><h2 class="banner-title"> {{ $banner['title'] }}</h2>
                        <div class="banner-label">{!!$banner['intro'] !!}</div>
                        </section>
                        <ol class="breadcrumb"> <li class="breadcrumb-item"><a href="{{ url() }}">Home</a></li> <li class="breadcrumb-item active">About Us</li> </ol>
                    </div>
                </div>
            @endif
        <!-- .banner -->
@stop

@section('content')
    {{--@include('frontend.layout.header')--}}
    {{--.wrapper--}}
    <div class="wrapper clearfix">
        <div class="content-wrapper">
            @include('frontend.layout.header')

            @include('frontend.page.pagecontent')

            @include('frontend.layout.footer')
        </div>
    </div>

    @include('frontend.layout.modal')


@stop
@section('package-script')
    {!! HTML::script('sherpaassets/lib/js/scripts.js') !!}
@stop