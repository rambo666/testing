<main id="content" role="main" class="inner">
    <?php $destination_slug = $slug;?>
    
    @if( isset( $message ) )

    <div class="container">
        <div id="filters" class="activities-filter">
            <ul class="option-lists clearfix" data-option-key="filter">
                <li> <a href="{{ Route('dashboard.destination.show', 'all') }}" class="{{ (Request::is('*/all')) ? 'selected' : '' }}"> <span>all activities</span> </a>
                </li>
                <?php $des_count = 2; ?>
                @foreach($destinations_data as $slug => $title )

                <li><a href="{{ Route('dashboard.destination.show', $slug) }}" class="{{ (Request::is('*/'.$slug)) ? 'selected' : '' }}"><span>{{ $title }}</span></a>
                </li>
                <?php $des_count++; ?>
                @endforeach

            </ul>
        <!--.option-lists-->
        </div>
    <!--#filters-->
    </div>
        
        <section class="grey-bg">
        <div class="container">
            <div class="row">
                <!--Isotope Section-->
                <div id="activity-container" class="clearfix activities trips-total cost-lists">
            <div class="container">
            <h1>{!! $message !!} for this Destination</h1>
            </div>
        </div>
        </div>
    </div></div>
    @endif


    @if( isset( $activities ) )
    @if( $activities->count() )
    <div class="container">
        <div id="filters" class="activities-filter">
            <ul class="option-lists clearfix" data-option-key="filter">
                <li> <a href="{{ Route('dashboard.destination.show', 'all') }}" class="{{ (Request::is('*/all')) ? 'selected' : '' }}"> <span>all activities</span> </a>
                </li>
                <?php $des_count = 2; ?>
                @foreach($destinations_data as $slug => $title )

                <li><a href="{{ Route('dashboard.destination.show', $slug) }}" class="{{ (Request::is('*/'.$slug)) ? 'selected' : '' }}"><span>{{ $title }}</span></a>
                </li>
                <?php $des_count++; ?>
                @endforeach

            </ul>
        <!--.option-lists-->
        </div>
    <!--#filters-->
    </div>
    <section class="grey-bg">
        <div class="container">
            <div class="row">
                <!--Isotope Section-->
                <div id="activity-container" class="clearfix activities trips-total cost-lists">
                    <?php $act_count = 0; ?>

                        @foreach($activities as $activity)
                        <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item">
                            <div class="card">
                                <figure>
                                
                                    <img src="{{ url('uploads/activity/' . $activity->image) }}" alt=""/>
                                
                            </figure>
                            <section class="desc">
                                <div class="top-part">
                                    <h3><a href="#">{{ $activity->title }}</a></h3>
                                    <p>
                                        <?php // $pos = strpos( $activity->description, ' ', 200 ) ?>
                                        {{ substr( strip_tags($activity->description), 0, 200 ) . ' ...' }}
                                    </p>
                                </div>
                            </section>
                            <!-- .desc -->
                            <div class="hover-item">
                                <div class="package-count">
                                    <span class="number">{{ $region_count[$act_count] }}</span>
                                    <span class="type">region</span>
                                </div>
                                <a href="{!! URL::route('dashboard.activity.show', ['slug' => $activity->slug,'destination_slug' =>$destination_slug]) !!}" class="btn">
                                    browse all
                                </a>
                            </div>
                            <!-- .hover-item -->
                            </div>
                        </div>
                        <!--.destiny-item-->
                            <?php $act_count++; ?>
                        @endforeach

                </div>
                <!-- end destiny container -->
                <div class="center">
                    {{--<span class="btn" id="item-more" style="display:inline-block;">load more</span>--}}
                </div>

            </div>
        </div>
    </section>
    <!-- .isotop-section -->
    @endif
    @endif
</main>