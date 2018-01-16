@extends('frontend/layout/layout')

@section('content')

    {{--.wrapper--}}
    <div class="wrapper clearfix">
        <div class="content-wrapper">
            @include('frontend/layout/header')
            <main id="content" role="main">
                <div class="container">
                    <div class="top-section clearfix iso-top">
                        <section class="col-sm-7">
                            <h2>
                                MOST POPULAR PACKAGES FOR TREKKING In nepal
                            </h2>
                            <p>We’ve curated some of the most loved packages since last decades of operation.</p>
                        </section>
                        <div class="call-sec col-sm-3 col-lg-2 alignright padding-none">
                            <a href="tel:+9779841369003" class="btn-transparent call"><img src="{{ url('sherpaassets/images/icons/tel-icon.svg') }}" alt="" class="svg">
                                9841369003
                            </a>
                            <p class="tel-label">Call your Sherpa for customized packages.</p>
                        </div>
                    </div>
                    <div id="filters">
                        <ul class="option-lists clearfix" data-option-key="filter">
                            <li><a href="#filter" data-option-value="*" class="selected">
                                    <span class="filter-title">All</span>
                                </a></li>
                            <li><a href="#filter" data-option-value=".isotop1">
                                    <span class="filter-title">trekking</span>
                                </a></li>
                            <li><a href="#filter" data-option-value=".isotop2">
                                    <span class="filter-title">peak climbing</span>
                                </a></li>
                            <li><a href="#filter" data-option-value=".isotop3">
                                    <span class="filter-title">cultural tours</span>
                                </a></li>
                            <li><a href="#filter" data-option-value=".isotop4">
                                    <span class="filter-title">kathmandu valley tours</span>
                                </a></li>
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
                                <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item isotop4">
                                    <figure> <a href="#">
                                            <img src="{{ url('sherpaassets/uploads/trekking-image1.jpg') }}" alt=""/>
                                        </a> </figure><section class="desc">
                                        <div class="top-part">
                                            <h3><a href="#">Annapurna Circuit Trekking in Nepal</a></h3>
                                            <p>The Annapurna Circuit (Around the Annapurna) Trek has been highly praised and is a spectacular trekking route ...</p>
                                        </div>
                                        <footer>
                            <span class="icon-group">
                                <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                                <span>14 days</span>
                            </span>
                                            <span class="icon-group">
                                <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                                <span>$320</span>
                            </span>
                                        </footer>
                                    </section>
                                    <!-- .desc -->
                                </div>
                                <!--.destiny-item-->

                                <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item isotop2 isotop1">
                                    <figure> <a href="#">
                                            <img src="{{  url('sherpaassets/uploads/trekking-image2.jpg') }}" alt=""/>
                                        </a></figure><section class="desc">
                                        <div class="top-part">
                                            <h3><a href="#">Ghorepani Poon Hills & Ghandruk Trekking in Nepal</a></h3>
                                            <p>Since trek starts from one place and end at another place this trek offer varities of himalayan scenery, different types of people and their live cultures, amazing views of different areas</p>
                                        </div>
                                        <footer>
                            <span class="icon-group">
                                <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                                <span>14 days</span>
                            </span>
                                            <span class="icon-group">
                                <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                                <span>$320</span>
                            </span>
                                        </footer>
                                    </section>
                                    <!-- .desc -->
                                </div>
                                <!--.destiny-item-->

                                <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item isotop3 isotop4">
                                    <figure> <a href="#"><img src="{{  url('sherpaassets/uploads/trekking-image3.jpg') }}" alt=""/>
                                        </a></figure><section class="desc">
                                        <div class="top-part">
                                            <h3><a href="#">Annapurna Circuit Trekking in Nepal</a></h3>
                                            <p>The Annapurna Circuit (Around the Annapurna) Trek has been highly praised and is a spectacular trekking route ...</p>
                                        </div>
                                        <footer>
                        <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                            <span>14 days</span>
                        </span>
                                            <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                            <span>$320</span>
                        </span>
                                        </footer>
                                    </section>
                                    <!-- .desc -->
                                </div>
                                <!--.destiny-item-->

                                <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item">
                                    <figure> <a href="#">
                                            <img src="{{  url('sherpaassets/uploads/trekking-image4.jpg') }}" alt=""/>
                                        </a></figure><section class="desc">
                                        <div class="top-part">
                                            <h3><a href="#">Manaslu and Annapurna High Pass Trek</a></h3>
                                            <p>Since trek starts from one place and end at another place this trek offer varities of himalayan scenery, different types of people and their live cultures, amazing views of different areas</p>
                                        </div>
                                        <footer>
                        <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                            <span>14 days</span>
                        </span>
                                            <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                            <span>$320</span>
                        </span>
                                        </footer>
                                    </section>
                                    <!-- .desc -->
                                </div>
                                <!--.destiny-item-->

                                <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item isotop4 isotop3">
                                    <figure> <a href="#">
                                            <img src="{{  url('sherpaassets/uploads/trekking-image5.jpg') }}" alt=""/>
                                        </a></figure><section class="desc">
                                        <div class="top-part">
                                            <h3><a href="#">Langtang Valley Trek</a></h3>
                                            <p>Since trek starts from one place and end at another place this trek offer varities of himalayan scenery, different types of people and their live cultures, amazing views of different areas</p>
                                        </div>
                                        <footer>
                        <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                            <span>14 days</span>
                        </span>
                                            <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                            <span>$320</span>
                        </span>
                                        </footer>
                                    </section>
                                    <!-- .desc -->
                                </div>
                                <!--.destiny-item-->

                                <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item isotop1 isotop3">
                                    <figure> <a href="#">
                                            <img src="{{  url('sherpaassets/uploads/trekking-image6.jpg') }}" alt=""/>
                                        </a></figure><section class="desc">
                                        <div class="top-part">
                                            <h3><a href="#">Short and Best Trek in Langtang Region</a></h3>
                                            <p>The Annapurna Circuit (Around the Annapurna) Trek has been highly praised and is a spectacular trekking route ...</p>
                                        </div>
                                        <footer>
                        <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                            <span>14 days</span>
                        </span>
                                            <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                            <span>$320</span>
                        </span>
                                        </footer>
                                    </section>
                                    <!-- .desc -->
                                </div>
                                <!--.destiny-item-->

                                <div class="isotop1 isotop2 col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item">
                                    <figure> <a href="#">
                                            <img src="{{ url('sherpaassets/uploads/trekking-image7.jpg') }}" alt=""/>
                                        </a></figure><section class="desc">
                                        <div class="top-part">
                                            <h3><a href="#">Siklis Royal Trek around Pokhara and Annapurna Region</a></h3>
                                            <p>Since trek starts from one place and end at another place this trek offer varities of himalayan scenery, different types of people and their live cultures, amazing views of different areas</p>
                                        </div>
                                        <footer>
                        <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                            <span>14 days</span>
                        </span>
                                            <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                            <span>$320</span>
                        </span>
                                        </footer>
                                    </section>
                                    <!-- .desc -->
                                </div>
                                <!--.destiny-item-->

                                <div class="isotop2 col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item">
                                    <figure> <a href="#">
                                            <img src="{{  url('sherpaassets/uploads/trekking-image2.jpg') }}" alt=""/>
                                        </a></figure><section class="desc">
                                        <div class="top-part">
                                            <h3><a href="#">Manaslu and Annapurna High Pass Trek</a></h3>
                                            <p>Since trek starts from one place and end at another place this trek offer varities of himalayan scenery, different types of people and their live cultures, amazing views of different areas</p>
                                        </div>
                                        <footer>
                        <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                            <span>14 days</span>
                        </span>
                                            <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                            <span>$320</span>
                        </span>
                                        </footer>
                                    </section>
                                    <!-- .desc -->
                                </div>
                                <!--.destiny-item-->
                                <div class="isotop3 isotop2 col-xs-4 col-sm-3 col-md-4 col-lg-3 destiny-item">
                                    <figure> <a href="#">
                                            <img src="{{ url('sherpaassets/uploads/trekking-image3.jpg') }}" alt=""/>
                                        </a></figure><section class="desc">
                                        <div class="top-part">
                                            <h3><a href="#">Annapurna Circuit Trekking in Nepal</a></h3>
                                            <p>The Annapurna Circuit (Around the Annapurna) Trek has been highly praised and is a spectacular trekking route ...</p>
                                        </div>
                                        <footer>
                        <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/day-icon.svg') }}" class="svg" alt=""/>
                            <span>14 days</span>
                        </span>
                                            <span class="icon-group">
                            <img src="{{ url('sherpaassets/images/icons/cost-icon.svg') }}" class="svg" alt=""/>
                            <span>$320</span>
                        </span>
                                        </footer>
                                    </section>
                                    <!-- .desc -->
                                </div>
                                <!--.destiny-item-->
                            </div>
                            <!-- end destiny container -->
                            <div class="center">
                                <a href="package.html" class="btn" style="display:inline-block;">view all packages</a>
                            </div>

                        </div>
                    </div>
                </section>
                <!-- .isotop-section -->

                <section class="about-section">
                    <div class="container">
                        <div class="row">
                            <h2 class="col-sm-5 col-sm-offset-1 padding-none">MOST TRUSTED LOCAL GUIDE FOR TREKKING IN NEPAL.</h2>
                            <div class="desc col-sm-5">
                                <p>Sherpa Guide Nepal co-operative confers on the preeminent service and the highly competitive price for trekking and Expeditions in Nepal. Our main objective is to endow with highly comprehensive travel and tour support to our valuable home and foreign guests, offering personalized itineraries and routes. </p>
                                <a href="company.html" class="btn btn-transparent">FIND MORE ABOUT Us</a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- .about-section -->

            </main>

            <footer id="footer">
                <section class="testimonial-section">
                    <div class="container">
                        <div class="row">
                            <h2>OUR SATISFIED CUSTOMERS SAY ...</h2>
                            <div id="testimonial-slider" class="owl-carousel owl-theme col-sm-8 padding-none">
                                <div class="item">
                                    <div class="content">
                                        <p>Mr Pasang is a highly recommended guide. He was recommended to us by Mr Yee Chee Leong and bingo he was that good. We did had a very enjoyable trekking trip with him for the whole 12 days.</p>
                                        <span class="customer">
                      <span class="name">
                          jeremy wan
                      </span>
                      <span class="country">
                          malaysia
                      </span>
                  </span>
                                        <!-- .customer -->
                                    </div>

                                </div>
                                <div class="item">
                                    <div class="content">
                                        <p>Mr Pasang is a highly recommended guide. He was recommended to us by Mr Yee Chee Leong and bingo he was that good. We did had a very enjoyable trekking trip with him for the whole 12 days.</p>
                                        <span class="customer">
                      <span class="name">
                          jeremy wan
                      </span>
                      <span class="country">
                          malaysia
                      </span>
                  </span>
                                        <!-- .customer -->
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <p>Mr Pasang is a highly recommended guide. He was recommended to us by Mr Yee Chee Leong and bingo he was that good. We did had a very enjoyable trekking trip with him for the whole 12 days.</p>
                                        <span class="customer">
                      <span class="name">
                          jeremy wan
                      </span>
                      <span class="country">
                          malaysia
                      </span>
                  </span>
                                        <!-- .customer -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="top-footer">
                    <div class="container">
                        <div class="row">
                            <section class="col-sm-2 col-xs-6 col-sm-offset-2">
                                <h3>company</h3>
                                <ul class="sherpa-lists">
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="ourteam.html">Our Team</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="#">sitemap</a></li>
                                </ul>
                            </section>
                            <section class="col-sm-2 col-xs-6">
                                <h3>destinations</h3>
                                <ul class="sherpa-lists">
                                    <li><a href="#">Nepal</a></li>
                                    <li><a href="#">Bhutan</a></li>
                                    <li><a href="#">Tibet</a></li>
                                    <li><a href="#">India</a></li>
                                    <li><a href="#">Mustang</a></li>
                                    <li><a href="#">Dolpa</a></li>
                                </ul>
                            </section>
                            <section class="col-sm-2 col-xs-6">
                                <h3>activities</h3>
                                <ul class="sherpa-lists">
                                    <li><a href="#">Trekking in Nepal</a></li>
                                    <li><a href="#">Mountaineering in Nepal</a></li>
                                    <li><a href="#">Culture Tour</a></li>
                                    <li><a href="#">Kathmandu Valley Tour</a></li>
                                    <li><a href="#">Fixed Departure</a></li>
                                </ul>
                            </section>
                            <section class="col-sm-2 col-xs-6">
                                <h3>useful information</h3>
                                <ul class="sherpa-lists">
                                    <li><a href="#">When is best season for trekking in Nepal?</a></li>
                                    <li><a href="#">Trekking Equipment</a></li>
                                    <li><a href="#">Nepal Visa</a></li>
                                    <li><a href="#">Getting to Nepal</a></li>
                                </ul>
                            </section>
                            <div class="alignright col-sm-2 col-xs-6">
                                <section>
                                    <h3>We Accept</h3>
                                    <img src="sherpaassets/images/accept-btn.png" alt="">
                                </section>
                                <section class="social-section">
                                    <h3>find us on..</h3>
                                    <ul class="social-medias social-lists">
                                        <li><a href="#" target="_blank"><span class="fa fa-facebook"></span></a></li>
                                        <li><a href="#" target="_blank"><span class="fa fa-twitter"></span></a></li>
                                        <li><a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
                                        <li><a href="#" target="_blank"><span class="fa fa-youtube-play"></span></a></li>
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
                            <span class="copyright col-xs-4 col-xs-offset-2">&copy; Copyright 2016. Sherpaguide Nepal Services. All Rights Reserved.</span>
                            <span class="credit col-xs-4" style="float:right;"><a href="http://view9.com.np" target="_blank" style=" display:inline-block; line-height:32px;">Website designed  &amp; developed by: <img src="sherpaassets/images/logo_view9.png" style="width: auto; float: right;
    margin-left: 10px;"></a></span>
                        </div>
                    </div>
                </div>
                <!-- .bottom-footer -->

            </footer>
        </div>
    </div>
    {{--Modal content--}}
    <div class="modal fade org" id="request" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <section class="contact-form-section col-sm-12">

                    <h2>Request a Quote</h2>
                    <p>Phasellus tempus scelerisque bibendum. Duis aliquet, urna eu condimentum placera</p>

                    <form class="form-contact">
                        <div class="form-group important col-sm-12">
                            <input type="text" class="form-control" placeholder="contact name">
                        </div>

                        <div class="form-group important col-sm-12">
                            <input type="tel" class="form-control" placeholder="contact number">
                        </div>

                        <div class="form-group important col-sm-12">
                            <select name="dropdown" class="form-dropdown">
                                <option value="1">Trekking</option>
                                <option value="2">Rafting</option>
                                <option value="3">Hiking</option>
                            </select>
                        </div>

                        <div class="form-group important col-sm-12">
                            <select name="dropdown" class="form-dropdown">
                                <option value="1">Easy</option>
                                <option value="2">Medium</option>
                                <option value="3">Hard</option>
                            </select>
                        </div>

                        <div class="form-group important col-sm-12">
                            <input type="email" class="form-control" placeholder="contact email">
                        </div>


                        <div class="form-group col-sm-12">
                            <img src="{{ url('sherpaassets/uploads/robot.png" alt') }}="">
                            <button type="submit" class="btn btn-default">send message</button>
                        </div>
                    </form>
                </section>
            </div><!-- /.modal-content -->
            <span data-dismiss="modal" class="close-btn" style="cursor: pointer;"><img class="svg" src="images/icons/close-icon.svg" alt=""></span>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
