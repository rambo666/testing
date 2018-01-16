<?php ///print_r($testimonials); ?>
<footer id="footer">

    @if( isset( $footer_destinations ) )
    <section class="testimonial-section">
        <div class="container">
            <div class="row">
                <h2>OUR SATISFIED CUSTOMERS SAY ...</h2>
                <div id="testimonial-slider" class="owl-carousel owl-theme col-sm-8 padding-none">

                        @foreach($testimonials as $testimonial)
                            <div class="item">
                                <div class="content">
                                    <p>
                                        {!! $testimonial->review !!}
                                    </p>
                                    <span class="customer">
                                      <span class="name">
                                          {!! $testimonial->person_name !!}
                                      </span>
                                      <span class="country">
                                          {!! $testimonial->person_address !!}
                                      </span>
                                  </span>
                                    <!-- .customer -->
                                </div>
                            </div>
                        @endforeach

                </div>
            </div>
        </div>
    </section>
    @endif

    <div class="top-footer">
        <div class="container">
            <div class="row">
                @include('frontend/layout/footermenu')
                <div class="col-sm-3 col-xs-6 pull-right">
                    <section>
                        <h3>We Accept</h3>
                        <img src="{!! isset($content_image1) ? $content_image1 : url( '/uploads/content/' . $settings['content_image'] ) !!}" alt="">
                    </section>
                    <section class="social-section">
                        <h3>find us on..</h3>
                        <ul class="social-medias social-lists">
                            <li><a href="{!! isset($facebook_link) ? $facebook_link : ($settings['facebook_link']) !!}" target="_blank"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="{!! isset($twitter_link) ? $twitter_link : ($settings['twitter_link']) !!}" target="_blank"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="{!! isset($instagram_link) ? $instagram_link : ($settings['instagram_link']) !!}" target="_blank"><span class="fa fa-instagram"></span></a></li>
                            <li><a href="{!! isset($youtube_link) ? $youtube_link : ($settings['youtube_link']) !!}" target="_blank"><span class="fa fa-youtube-play"></span></a></li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- .top-footer -->
    <div class="bottom-footer">
        <div class="container">
            <div class="row clearfix">
                <span class="copyright col-sm-6">{!! isset($copyright) ? $copyright : ($settings['copyright']) !!}</span>
                <span class="credit col-sm-6 alignright" style="float:right;"><a href="http://view9.com.np" target="_blank" style=" display:inline-block; line-height:32px;">Website designed  &amp; developed by: <img src="{{ url( 'sherpaassets/images/logo_view9.png' ) }}" style="width: auto; float: right;
    margin-left: 10px;"></a></span>
            </div>
        </div>
    </div>
    <!-- .bottom-footer -->

</footer>