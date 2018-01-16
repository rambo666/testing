
<main id="content" role="main" class="inner">
    @if( isset( $message ) )
         <div class="container">
        <div id="filters" class="activities-filter">
            <ul class="option-lists clearfix" data-option-key="filter">
                <li> <a href="{{ Route('dashboard.activity.show', 'all') }}" class="{{ (Request::is('*/all')) ? 'selected' : '' }}"> <span>all region</span> </a>
                </li>
                <?php $des_count = 2; ?>
                @foreach($activities_data as $slug => $title )

                <li><a href="{{ Route('dashboard.activity.show', $slug) }}" class="{{ (Request::is('*/'.$slug)) ? 'selected' : '' }}"><span>{{ $title }}</span></a>
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
            <h1>{!! $message !!} </h1>
            </div>
        </div>
        </div>
    </div></div>
    @endif
    @if( isset( $regions ) )
    @if( $regions->count() )
    <div class="container">
        <div id="filters" class="activities-filter">
                    <ul class="option-lists clearfix" data-option-key="filter">
                        <li>
                            <a href="{{ Route('dashboard.activity.show', 'all') }}" class="{{ (Request::is('*/all')) ? 'selected' : '' }}">
                                <span>all regions</span>
                            </a>
                        </li>
                        <?php $des_count = 2; ?>
                        @foreach($activities_data as $slug => $title )

                            <li><a href="{{ Route('dashboard.activity.show', $slug) }}" class="{{ (Request::is('*/'.$slug)) ? 'selected' : '' }}"><span>{{ $title }}</span></a>
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

                        @foreach($regions as $region)
                        <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item">
                            <div class="card">
                                <figure>
                                
                                    <img src="{{ url('uploads/region/' . $region->image_path) }}" alt=""/>
                                
                            </figure>
                            <section class="desc">
                                <div class="top-part">
                                    <h3><a href="#">{{ $region->title }}</a></h3>
                                    <p>
                                        <?php // $pos = strpos( $region->description, ' ', 200 ) ?>
                                        {{ substr( strip_tags($region->overview), 0, 200 ) . ' ...' }}
                                    </p>
                                </div>
                            </section>
                            <!-- .desc -->
                            <div class="hover-item">
                                <div class="package-count">
                                  <span class="number">{{ $package_count[$act_count] }}</span>
                                    <span class="type">package</span>
                                </div>
                                <a href="{!! URL::route('dashboard.region.show', ['slug' => $region->slug]) !!}" class="btn">
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
