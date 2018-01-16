<main id="content" role="main" class="inner">
<div class="innerTeaser">
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <h1 class="banner-title">{{ $regions->title }}</h1>
                <div class="banner-label"><p>{!! $regions->overview !!}</p></div>
            </div>
        </div>
    </div>
</div>
    <section class="package grey-bg">
        <div class="container">
            <div class="row">
                <div class="loadlist cost-lists" id="package-lists">
                    <?php
                    $i =0;
//                    dd($metadata);
                    ?>
                    @foreach($packages as $package)
                        <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item">
                            <div class="card">
                                <figure>
                                    <a href="{{ Route('dashboard.package.show', $package->slug) }}"> <img src="{{ url('uploads/package/'. $metadata[$i]['images'][0]) }}" alt=""/></a>
                                </figure>
                            <section class="desc">
                                <div class="top-part">
                                    <h3><a href="{{ Route('dashboard.package.show', $package->slug) }}">{{ $package->title }}</a></h3>
                                    <p>
                                        {{strip_tags(substr($package->overview, 0, 100))}}
                                    </p>
                                </div>
                                <footer>
                                    <span class="icon-group">
                                        <span class="icon-group-inner">
                                            <img src="{!! url('sherpaassets/images/icons/day-icon.svg') !!}" class="svg" alt=""/>
                                            <span> {{ $metadata[$i]['days']}}</span>
                                        </span>
                                    </span>
                                    <span class="icon-group">
                                        <span class="icon-group-inner">
                                            <img src="{!! url('sherpaassets/images/icons/cost-icon.svg') !!}" class="svg" alt=""/>
                                            <span>{{ $metadata[$i]['price']}}</span>
                                        </span>
                                    </span>
                                </footer>
                            </section>
                            <!-- .desc -->
                            </div>
                        </div>
                        <!--.destiny-item-->
                        <?php $i++; ?>
                    @endforeach
                    <!--.destiny-item-->
                </div>
            </div>
        </div>
        <!-- /.container -->
    </section>
    <!-- /.package.gray-bg -->
</main>