<main id="content" role="main" class="inner">
    <section class="package gray-bg">
        <div class="container">
            <div class="row">
                <ul class="loadlist cost-lists" id="package-lists">
                    <?php
                    $i =0;
                    //                    dd($metadata);
                    ?>
                    @foreach($packages as $package)
                        <li class="col-xs-4 col-sm-4 col-md-3 destiny-item">
                            <figure>
                                <a href="package-details.html">
                                    <?php
                                    //                                        print_r($metadata[$i]['images'][0]);
                                    ?>
                                    <img src="{{ url('uploads/package/'. $metadata[$i]['images'][0]) }}" alt=""/>
                                    {{--<img src="uploads/activity1.jpg" alt=""/>--}}
                                </a>
                            </figure>

                            <section class="desc">
                                <div class="top-part">
                                    <h3><a href="{{ Route('dashboard.package.show', $package->slug) }}">{{ $package->title }}</a></h3>
                                    <p>
                                        {!! substr($package->overview, 0, 100) !!}
                                    </p>
                                </div>
                                <footer>
                                                <span class="icon-group">
                                                    <img src="{!! url('sherpaassets/images/icons/day-icon.svg') !!}" class="svg" alt=""/>
                                                    <span>
                                                            {{ $metadata[$i]['days'] }}
                                                    </span>
                                                </span>
                                    <span class="icon-group">
                                                    <img src="{!! url('sherpaassets/images/icons/cost-icon.svg') !!}" class="svg" alt=""/>
                                                    <span>{{ $metadata[$i]['price'] }}</span>
                                                </span>
                                </footer>
                            </section>
                            <!-- .desc -->
                        </li>
                        <!--.destiny-item-->
                    <?php $i++; ?>
                @endforeach


                <!--.destiny-item-->
                </ul>

            </div>
        </div>
        <!-- /.container -->
    </section>
    <!-- /.package.gray-bg -->
</main>