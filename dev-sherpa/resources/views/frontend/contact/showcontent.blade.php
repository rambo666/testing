<main id="content" role="main" class="inner">
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-5 col-lg-4 ">
					<div class="title">Our Location</div>
					<section class="address-col">
						<h3>{!! isset($officeone_title) ? $officeone_title : ($settings['officeone_title']) !!}</h3>
						<address>
                            <span class="address-group">
                                <img class="svg" src="{{ url('sherpaassets/images/icons/person-location.svg') }}" alt="">
                                <span class="location">
                                    {!! isset($officeone_addr) ? $officeone_addr : ($settings['officeone_addr']) !!}
                                </span>
                            </span>
							<span class="address-group">
                                <img class="svg" src="{{ url('sherpaassets/images/icons/phone.svg') }}" alt="">
                                <span class="phone">
                                <a href="tel:{!! isset($officeone_phone) ? $officeone_phone : ($settings['officeone_phone']) !!}">{!! isset($officeone_phone) ? $officeone_phone : ($settings['officeone_phone']) !!}</a>
                                    </span>
                            </span>
							<span class="address-group">
                                <img class="svg" src="{{ url('sherpaassets/images/icons/mail-contact.svg') }}" alt="">
                                <span class="mail">
                                <a href="mailto:{!! isset($officeone_mail) ? $officeone_mail : ($settings['officeone_mail']) !!}">{!! isset($officeone_mail) ? $officeone_mail : ($settings['officeone_mail']) !!}</a>
                                    </span>
                            </span>
						</address>
					</section>
					<!-- .address-col -->
				</div>
				
					<div class="col-sm-7 col-lg-8">
						<section class="contact-form-section">
							<div class="title">drop us a message</div>
							{!! Form::open( array( 'action' => 'FormPostController@postContact', 'class' => 'form-contact', 'role' => 'form', 'id' => 'main-contact-form' ) ) !!}
							<div class="row">
								<div class="form-group important col-sm-6 {!! $errors->has('sender_name') ? 'has-error' : '' !!}">

								{!! Form::text('sender_name', null, array('class'=>'form-control', 'id' => 'sender_name', 'placeholder'=>'Your Name', 'value'=>Input::old('sender_name'), 'required' => 'required', 'pattern' => '([a-zA-Z]{3,30}\s*)+' )) !!}

								@if ($errors->first('sender_name'))
									<span class="help-block">{!! $errors->first('sender_name') !!}</span>
								@endif
							</div>

							<div class="form-group important col-sm-6 {!! $errors->has('sender_email') ? 'has-error' : '' !!}">

								{!! Form::email('sender_email', null, array('class'=>'form-control', 'id' => 'sender_email', 'placeholder'=>'your email', 'value'=>Input::old('sender_email'), 'required' => 'required' )) !!}

								@if ($errors->first('sender_email'))
									<span class="help-block">{!! $errors->first('sender_email') !!}</span>
								@endif
							</div>
							
							<div class="form-group important col-sm-12 {!! $errors->has('sender_phone_number') ? 'has-error' : '' !!}">
		                        {!! Form::tel( 'sender_phone_number', null, array('class' => 'form-control', 'placeholder' => 'contact number', 'id' => 'sender_phone_number','required' => 'required', 'pattern' => '^\d{7,}', 'title'=>'phone number must be atleast 7 digits' )) !!}
		                    
		                        @if ($errors->first('sender_phone_number'))
									<span class="help-block">{!! $errors->first('sender_phone_number') !!}</span>
								@endif
		                    </div>

							<div class="form-group important col-sm-12 {!! $errors->has('subject') ? 'has-error' : '' !!}">

								{!! Form::text('subject', null, array('class'=>'form-control', 'id' => 'subject', 'placeholder'=>'subject', 'value'=>Input::old('subject'), 'required' => 'required' )) !!}

								@if ($errors->first('subject'))
									<span class="help-block">{!! $errors->first('subject') !!}</span>
								@endif
 							</div>

							<div class="form-group important col-sm-12 {!! $errors->has('message') ? 'has-error' : '' !!}">

								{!! Form::textarea('message', null, array('class'=>'form-control', 'id' => 'message', 'placeholder'=>'message', 'value'=>Input::old('message'), 'required' => 'required' )) !!}

								@if ($errors->first('message'))
									<span class="help-block">{!! $errors->first('message') !!}</span>
								@endif
 							</div>

							<div class="form-group important col-sm-12">
								<div class="row">
									<div class="col-sm-8">
							            <div id="recaptcha2"></div>
	                       				
									</div>
									<div class="col-sm-4">{!! Form::submit('send message', array('class' => 'btn btn-default', 'id' => 'contact-submit')) !!}</div>
								</div>
 							</div>
							</div><div class="form-group important col-sm-6" id="msgcontact"></div>
							{!! Form::close() !!}
						</section>
					</div>
				</div>

			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div id="overlay"><div id="map"></div></div>
			</div>
		</div>
	</section>
	<!-- End contact section -->
</main>

@section('package-script')
	{!! HTML::script('sherpaassets/lib/js/scripts.js') !!}
	
	<script>
	// var map;

			// function initMap() {
			// 	map = new google.maps.Map(document.getElementById('map'), {
			// 		center: {
			// 			lat: -34.397,
			// 			lng: 15.644
			// 		},
			// 		zoom: 8
			// 	});
			// }	
		// When the window has finished loading create our google map below
		google.maps.event.addDomListener(window, 'load', init);

		function init() {

			var locations = [
				['<?php echo $settings['location1']; ?>', <?php echo $settings['lat1']; ?>,<?php echo $settings['lng1']; ?>],
			
			];
			// var locations = [
   //      ['Nepal', 28.3790827,81.8867288]
   //      ];

			var image = {
				url: '{{url("sherpaassets/images/marker.png")}}'
			};

			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 12,
				center: new google.maps.LatLng(27.720034, 85.313374),
				mapTypeId: google.maps.MapTypeId.ROADMAP3,
				scrollwheel: false

			});

			//if(map=null){console.log("error")}

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


		function createMarker(markerOptions) {
			var marker = new google.maps.Marker(markerOptions);
			markers.push(marker);
			lat_longs.push(marker.getPosition());
			return marker;
		}

		window.onload = initialize;
	</script>

	<script>
		$(document).ready( function () {
			$('#main-contact-form').submit(function ( e ) {
				e.preventDefault();
				$("#msgcontact").empty();
				var url = "{{  route( 'dashboard.contact.post' ) }}";

				var _token = $( '.form-contact input[name=_token]' ).val();
				var sender_name = $( '.form-contact input[name=sender_name]' ).val();
				var sender_email = $( '.form-contact input[name=sender_email]' ).val();
				var sender_phone_number = $( '.form-contact input[name=sender_phone_number]' ).val();
				var subject = $( '.form-contact input[name=subject]' ).val();
				var message = $( '.form-contact textarea[name=message]' ).val();
				var created_ip = 0;
				var recaptcha2 = $("#g-recaptcha-response-1").val();
//console.log(subject + message);

				var formData = {
					_token: _token,
					sender_name: sender_name,
					sender_email: sender_email,
					sender_phone_number: sender_phone_number,
					subject: subject,
					message: message,
					created_ip: created_ip,
					recaptcha2: recaptcha2,
				}

				$.ajax({
					url: url,
					data: formData,
					type: 'post',
					dataType: 'json',
					success: function ( response ) {
						$( '#msgcontact' ).append( '<b>' + response.responseText + '</b>' );
					},
					error: function ( response ) {
						$( '#msgcontact' ).append( '<b>' + response.responseText + '</b>' );
					}

				});
				    $( '.form-contact input[name=sender_name]' ).val("");
    				$( '.form-contact input[name=sender_email]' ).val("");
    				$( '.form-contact input[name=sender_phone_number]' ).val("");
    				$( '.form-contact input[name=subject]' ).val("");
    				$( '.form-contact textarea[name=message]' ).val("");
			} );
		} );
	</script>
@stop