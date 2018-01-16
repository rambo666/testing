<main id="content" role="main" class="inner">
    <div class="container-fluid">
        <div class="row padding-none">
            <section class="parallax-section clearfix">
                @foreach($destinations as $destination)
                    <div class="destinations parallax-window" data-parallax="scroll" data-image-src="{{ url('uploads/destination/' . $destination->image_path) }}">
                        <section class="col-sm-8 col-md-5 destiny-desc">
                            <h2>{{ $destination->title }}</h2>
                            <p>{!! $destination->description !!}</p>
                            <a href="{{ Route('dashboard.destination.show', $destination->slug) }}" class="btn btn-transparent">
                                browse activities
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