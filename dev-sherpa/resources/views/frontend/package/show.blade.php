@extends('frontend/layout/layout')

@section( 'meta' )
    <?php $meta_keywords = $package->meta_keywords; ?>
    <?php $meta_description = $package->meta_description; ?>
@stop

@if( isset( $metaValue ) )
<?php $i =0; ?>
@foreach ($metaValue['itinerary'] as $item)
    <?php
    $latlon[$i]['daytitle'] = $item['daytitle'];
    $latlon[$i]['daydetails'] = $item['daydetails'];
    $latlon[$i]['lat'] = $item['lat'];
    $latlon[$i]['lng'] = $item['lng'];
    $i++;
    ?>
@endforeach
    <?php // echo '<pre>'; print_r($latlon); echo '</pre>'; die; ?>
@endif

@section('content')
    {{--.wrapper--}}
    <div class="wrapper clearfix">
        <div class="content-wrapper">
            @include('frontend.layout.header')
            <div class="container-fluid padding-none">
                <div id="trip-slider" class="owl-carousel owl-theme">

                    @if( isset( $metaValue ) )
                        @foreach($metaValue['images'] as $image)
                        <div class="item">
                            <img src="{{ url('uploads/package/' . $image) }}" alt="">
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @include('frontend.package.package-details')

            @include('frontend.layout.footer')
        </div>
    </div>

    @include('frontend.layout.modal')
    @include('frontend.package.bookmodal')


@stop
@section('package-script')
    {!! HTML::script('sherpaassets/lib/js/scripts.js') !!}
    <script>
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {

        var locations = [
        ['Nepal', 28.3790827,81.8867288]
        ];

        var image = {
        url: "{{url('sherpaassets/images/map-pointer.png')}}"
        };

        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: new google.maps.LatLng(27.720034, 85.313374),
        mapTypeId: google.maps.MapTypeId.ROADMAP3,
        scrollwheel: false

        });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon: image
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }

    //<![CDATA[

    var map; // Global declaration of the map
    var iw = new google.maps.InfoWindow(); // Global declaration of the infowindow
    var lat_longs = new Array();
    var markers = new Array();
    function initialize() {

    var myLatlng = new google.maps.LatLng(27.720034, 85.313374);
    var myOptions = {
        zoom: 8,
        center: myLatlng,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        var count = 0;
        var label = '';
    <?php
        $count2 = 1;
                ?>
        @foreach ($latlon as $ltlng)

            @if ( !empty( $ltlng['lat'] ) && !empty( $ltlng['lng'] ) )

                var myLatlng = new google.maps.LatLng({{ ( isset( $ltlng['lat'] ) ? $ltlng['lat'] : '' ) }}, {{ ( isset( $ltlng['lng'] ) ? $ltlng['lng'] : '' ) }});
                label += <?php echo "'"; ?>+count+<?php echo "'"; ?>;
                var markerOptions = {
                    map: map,
                    position: myLatlng,
                    icon: "{{url('sherpaassets/images/map-pointer.png')}}",
                    label: '<?php echo $count2; ?>'
                };

                marker_6 = createMarker(markerOptions);

                marker_6.set("content", "<h3><span class='day'>Day <?php echo $count2; ?></span> <span class='route-title'>{{ ( isset( $ltlng['daytitle'] ) ? $ltlng['daytitle'] : '' ) }} </span></h3><p>{{ ( isset( $ltlng['daydetails'] ) ? strip_tags($ltlng['daydetails']) : '' ) }}</p>");

                google.maps.event.addListener(marker_6, "click", function(event) {
                    iw.setContent(this.get("content"));
                    iw.open(map, this);
                });
           
           
            @endif
            <?php $count2++; ?>
        @endforeach
    }


    function createMarker(markerOptions) {
        var marker = new google.maps.Marker(markerOptions);
        markers.push(marker);
        lat_longs.push(marker.getPosition());
        return marker;
    }
    window.onload = initialize;
    </script>
    @stop
