@if(Session::has('success'))
    <p class="alert alert-{{ 'success' }}">
        {{ Session::get('success') }}
    </p>
@endif

<header id="header" role="banner">
    <div class="container">
        <div class="row clearfix flexrow">
            <div id="logo" class="col-md-3">
                <a href="{!! route('dashboard')!!}">
                    <img src="{{ url('sherpaassets/images/logo.png') }}" alt="">
                </a>
            </div>
            <!-- #logo -->
            @include('frontend/layout/menu')
            <!-- .primary-menu -->
            @include('frontend/search/search')

    
    @yield('home_slider')
    @yield('package_slider')
    @yield('page_banner')
</header>