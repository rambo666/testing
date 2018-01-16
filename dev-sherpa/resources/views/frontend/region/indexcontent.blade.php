<main id="content" role="main" class="inner">
    <div class="container-fluid">
        <div class="row padding-none">
            <section class="parallax-section clearfix">
                @foreach($regions as $region)
                    <div class="destinations parallax-window" data-parallax="scroll" data-image-src="{{ url('uploads/region/' . $region->image_path) }}">
                        <section class="col-sm-8 col-md-5 destiny-desc">
                            <h2>{{ $region->title }}</h2>
                            <p>{!! $region->description !!}</p>
                            <a href="{{ Route('dashboard.region.show', $region->slug) }}" class="btn btn-transparent">
                                browse packages
                            </a>
                        </section>
                        <!-- destiny-desc -->
                    </div>
                @endforeach

            </section>
            <!-- .parallax-section -->
        </div>
    </div>
</main>