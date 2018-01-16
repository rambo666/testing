<main id="content" role="main">

    @if( isset( $package ) )
    <div class="container">
        <div class="top-section clearfix iso-top package-titles">
            <section class="col-sm-8">
                <h2 class="package-title">{{ $package->title }}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ Route('dashboard.destination') }}">destination</a></li>
                    <li class="breadcrumb-item"><a href="{{ Route('dashboard.destination.show', $destination->slug) }}">{{ $destination->title }}</a></li>
                    <li class="breadcrumb-item active">{{ $package->title }}</li>
                </ol>
            </section>
            <div class="call-sec col-sm-4 alignright padding-none">
                <div class="share-holder">
                    <div class="sharethis-inline-share-buttons"></div>
                </div>
                <a href="#" class="btn" data-toggle="modal" data-target="#book">book this trip</a>
            </div>
        </div>
        <!-- top-section -->

    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 trip-info col-sm-push-9">
                <div class="icon-group">
                    <div class="days">
                        <img src="{!! url('sherpaassets/images/icons/day-icon.svg') !!}" class="svg" alt=""/>
                        <span class="img-desc">{{ $metaValue['days'] }}</span>
                    </div>
                    <span class="label">Kathmandu to Kathmandu</span>
                </div>
                <span class="icon-group">
                    <div class="days">
                        <img src="{!! url('sherpaassets/images/icons/cost-icon.svg') !!}" class="svg" alt=""/>
                        <span class="img-desc">{{ $metaValue['price'] }}</span>
                    </div>
                    <span class="label">Starting From (Per Person)</span>
                </span>
                <div class="call-sec">
                    <a href="tel:{!! isset($contact_number) ? $contact_number : ($settings['contact_number']) !!}" class="call"><img src="{!! url('sherpaassets/images/icons/tel-icon.svg') !!}" alt="" class="svg">
                    {!! isset($contact_number) ? $contact_number : ($settings['contact_number']) !!}
                    </a>
                    <p class="tel-label">Call your Sherpa for customized packages.</p>
                </div>
            </div>
            <div class="col-sm-9 col-sm-pull-3">
                <div id="package-tab">
                    <ul class="resp-tabs-list hor_1">
                    <li>overview</li>
                    <li>trip highlights</li>
                    <li>itinerary</li>
                    <li>trip inclusions</li>
                </ul>
                <div class="resp-tabs-container hor_1">
                    <div>
                        @if( isset($package->overview) )
                            {!! $package->overview !!}
                        @endif
                    </div>

                    <div>
                        @if( isset($metaValue['highlights']) )
                            {!! $metaValue['highlights'] !!}
                        @endif
                    </div>

                    <div>
                        <?php $count = 1; 
                            if( ($metaValue['itinerary'][0]['daytitle'] == "") && ($metaValue['itinerary'][0]['daydetails'] == "") && ($metaValue['itinerary'][0]['accommodation']== "") && ($metaValue['itinerary'][0]['walkhrs']== "") && ( $metaValue['itinerary'][0]['maxaltitude'] == "") && ( $metaValue['itinerary'][0]['lat'] == "") && ( $metaValue['itinerary'][0]['lng'] == "")) { ?>
                            <h3>No Itinerary</h3>
                        <?php } else { ?>

                        <ul class="trip-itinerary-lists">
                            
                            @foreach($metaValue['itinerary'] as $key => $arrItinerary)
                                <li>
                                    <section class="trips-itineraries">
                                        <h5>Day <?php echo ($count < 10) ? str_pad($count, 2, "0", STR_PAD_LEFT): $count; ?>: {{ $arrItinerary['daytitle'] }}</h5>
                                        <p>
                                            {{ $arrItinerary['daydetails'] }}
                                        </p>
                                    </section>
                                    <!-- .trips-itineraries -->
                                    <ul class="info-lists">
                                        <li class="accommodation"><i class="fa fa-building"></i>Accommodation:{{ $arrItinerary['accommodation'] }}</li>
                                        <li class="walking-hrs"><i class="fa fa-clock-o"></i>Walking hours: {{ $arrItinerary['walkhrs'] }}</li>
                                        <li class="altitude"><i class="fa fa-area-chart"></i>Max. Altitude: {{ $arrItinerary['maxaltitude'] }}</li>
                                    </ul>
                                </li>
                                <?php $count++; ?>
                            @endforeach
                        </ul>
                        
                        <?php } ?>
                    </div>

                    <div>
                    <?php if($metaValue['incexc']['inc'][0] == "") { ?> 
                        <h4>Inclusions</h4>
                        <h3>No Inclusions </h3>
                        <?php } else { ?>
                        <section class="include-section">
                            <h4>It includes</h4>

                            <ol>
                           
                                @foreach($metaValue['incexc']['inc'] as $key => $valInc)
                                    <li>{{ $valInc }}</li><br/>
                                @endforeach
                            </ol>
                        </section>
                        <?php } ?>
                        <!-- .include-section -->
                        <?php if($metaValue['incexc']['exc'][0] == "") { ?> 
                        <h4>Exclusions</h4>
                        <h3>No Exclusions </h3>
                        <?php } else { ?>
                        <section class="exclude-section">
                            <h4>It excludes</h4>

                            <ol>

                                @foreach($metaValue['incexc']['exc'] as $key => $valExc)
                                    <li>{{ $valExc }}</li><br/>
                                @endforeach
                            </ol>
                        </section>
                        <?php } ?>
                    </div>
                </div>
                <!-- resp-tabs-container -->
                </div>
            </div>

            <!-- #package-tab -->
            
        </div>
    </div>

    <div class="map-section">
        <div id="map_canvas"></div>
    </div>
    @endif

</main>