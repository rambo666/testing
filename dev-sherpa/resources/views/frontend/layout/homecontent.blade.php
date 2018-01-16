<main id="content" role="main">
    <div class="container">
        <!-- MOST POPULAR BANNER --> 
        <div class="top-section clearfix iso-top">
            <section class="col-sm-7">
                <h2>
                    MOST POPULAR PACKAGES In nepal
                </h2>
                <p>We’ve curated some of the most loved packages since last decades of operation.</p>
            </section>
            <div class="call-sec col-sm-3 col-lg-3 alignright padding-none">
                <a href="tel:{!! isset($contact_number) ? $contact_number : ($settings['contact_number']) !!}" class="btn-transparent call"><img src="{{ url('sherpaassets/images/icons/tel-icon.svg') }}" alt="" class="svg">
                    {!! isset($contact_number) ? $contact_number : ($settings['contact_number']) !!}
                </a>
                <p class="tel-label">Call your Sherpa for customized packages.</p>
            </div>
        </div>

        <!-- Dest -->
        <div id="filters">
            <ul class="option-lists clearfix" data-option-key="filter">
                <li><a href="#filter" data-option-value="*" class="selected">
                        <span class="filter-title">All</span>
                    </a></li>
                @foreach($data as $activity)
                    <?php
                        $activity_name = $activity['activity_name'];
                        $activity_slug = $activity['activity_slug'];
                    ?>
                    <li><a href="#filter" data-option-value=".isotop{!! $activity_slug !!}">
                            <span class="filter-title">{!! $activity_name !!}</span>
                        </a></li>
                @endforeach
            </ul>
            <!--.option-lists-->
        </div>
        <!--#filters-->

    </div>
    <section class="isotop-section">
        <div class="container">
            <div class="row">
                <!--Isotope Section-->
                <div id="destiny-container" class="clearfix cost-lists">

                    @foreach( $data as $activities )
                        <?php
                        $activity_slug = $activities['activity_slug'];
                        ?>
                        @foreach($activities['package'] as $package_data)
                            <?php //echo '<pre>'; print_r($package_data); echo '</pre>'; die; ?>
                                <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item isotop{!! $activity_slug !!}">
                                    <div class="card">
                                        <figure>
                                            <a href="{!! URL::route('dashboard.package.show', ['slug' => $package_data['slug']]) !!}">
                                                <img src="{{ url('uploads/package/'.$package_data['image']) }}" alt=""/>
                                            </a>
                                        </figure>
                                        <section class="desc">
                                            <div class="top-part">
                                                <h3>
                                                    <a href="{!! URL::route('dashboard.package.show', ['slug' => $package_data['slug']]) !!}">
                                                        {!! $package_data['title'] !!}
                                                    </a>
                                                </h3>
                                                <p>{!! substr(strip_tags($package_data['overview']), 0, 200) !!}</p>
                                            </div>
                                            <footer>
                                            @if(array_key_exists('days', $package_data))
                                            <span class="icon-group">
                                                <span class="icon-group-inner">
                                                    <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                                                    <span> {!! $package_data['days'] !!}</span>
                                                </span>
                                            </span>
                                            @endif
                                            @if(array_key_exists('days', $package_data))
                                            <span class="icon-group">
                                                <span class="icon-group-inner">
                                                    <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                                                    <span>{!! $package_data['price'] !!} </span>
                                                </span>  
                                            </span>
                                            @endif
                                            </footer>
                                        </section>
                                    <!-- .desc -->
                                    </div>
                                </div>
                                <!--.destiny-item-->

                        @endforeach
                    @endforeach

                </div>
                <!-- end destiny container -->
                <div class="center">
                    <a href="{{ route('dashboard.destination.show', 'nepal') }}" class="btn" style="display:inline-block;">view all packages</a>
                </div>

            </div>
        </div>
    </section>
    <!-- .isotop-section -->

    <section class="about-section">
        <div class="container">
            <div class="row">
                @if(isset($settings))
                    <h2 class="col-sm-5 col-sm-offset-1 padding-none">{{ $settings['Hometitle'] }}</h2>
                    <div class="desc col-sm-5">
                        <p>{!! $settings['Homeintro']  !!}</p>
                        <a href="{{ route('dashboard.page.show', 'about-us') }}" class="btn btn-transparent">FIND MORE ABOUT Us</a>
                    </div>
                @endif
                
            </div>
        </div>
    </section>
    <!-- .about-section -->

</main>