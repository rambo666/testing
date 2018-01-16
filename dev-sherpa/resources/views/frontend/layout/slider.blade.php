<div id="home-banner" class="owl-carousel owl-theme">
    @foreach( $sliders as $slider )
    <div class="item">
            <img src="{!! url($slider->path) !!}" alt="">
        <div class="container">
            <section>
                <h2 class="banner-title" style="color:#fff;text-align: center;">{{ $slider->title }}</h2>
                <h2 style="color:#fff;text-align: center;">{{ $slider->description }}</h2>
            </section>
        </div>
    </div>
    @endforeach
</div>

