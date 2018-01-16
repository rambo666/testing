@yield( 'meta' )
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title>{!! $settings['site_title'] or "SHERPA GUIDE NEPAL" !!}</title>
    <script type="text/javascript" src="http://platform-api.sharethis.com/js/sharethis.js#property=58995b65880a0c001243d0b5&product=inline-share-buttons"></script>
    <meta name="description" content="{!! isset($meta_description) ? $meta_description : ($settings['meta_description']) !!}">
    <meta name="keywords" content="{!! isset($meta_keywords) ? $meta_keywords : ($settings['meta_keywords']) !!}">
    <meta name="author" content="Ashish Shrestha">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{!! url('sherpaassets/favicon.ico') !!}">
    <link rel="apple-touch-icon" href="{!! url('sherpaassets/images/apple-touch-icon.png') !!}">
    <link rel="apple-touch-icon" sizes="72x72" href="{!! url('sherpaassets/images/apple-touch-icon-72x72.png') !!}">
    <link rel="apple-touch-icon" sizes="114x114" href="{!! url('sherpaassets/images/apple-touch-icon-114x114.png') !!}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>


 <script>
       var recaptcha1;
       var recaptcha2;
       var myCallBack = function() {
         //Render the recaptcha1 on the element with ID "recaptcha1"
         recaptcha1 = grecaptcha.render('recaptcha1', {
           'sitekey' : '6LfLOA4UAAAAAKdPHjB-pqYk8v1PFKdBqgSTCvhj', //Replace this with your Site key
          'theme' : 'light'
         });
        
         //Render the recaptcha2 on the element with ID "recaptcha2"
         recaptcha2 = grecaptcha.render('recaptcha2', {
           'sitekey' : '6LfLOA4UAAAAAKdPHjB-pqYk8v1PFKdBqgSTCvhj', //Replace this with your Site key
           'theme' : 'light'
        });
      };
    </script>
    {{-- SHERPAGUIDE STYLESHEETS --}}
    {!! HTML::style('sherpaassets/lib/css/screen.css') !!}
    {!! HTML::style('sherpaassets/lib/css/font-awesome-min.css') !!}
    {!! HTML::style('sherpaassets/lib/css/animated.css') !!}
    {!! HTML::style('sherpaassets/lib/css/bootstrap.min.css') !!}
    {!! HTML::style('sherpaassets/lib/css/owl.theme.css') !!}
    {!! HTML::style('sherpaassets/lib/css/component.css') !!}
    {!! HTML::style('sherpaassets/lib/css/owl.carousel.css') !!}
    {!! HTML::style('sherpaassets/lib/css/sm-core-css.css') !!}
    {!! HTML::style('sherpaassets/lib/css/sm-blue.css') !!}
    {!! HTML::style('sherpaassets/lib/css/easy-responsive-tabs.css') !!}
    {!! HTML::style('sherpaassets/lib/css/navigation.css') !!}
    {!! HTML::style('sherpaassets/lib/css/dropdown.css') !!}
    {!! HTML::style('sherpaassets/style.css') !!}
    {!! HTML::style('sherpaassets/css/style-change.css') !!}
    {!! HTML::script('sherpaassets/lib/js/vendor/jquery-1.11.0.min.js') !!}

    {{-- SHERPAGUIDE SCRIPTS --}}
    {!! HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyB9ZnQxPT3ALgXJzeo8njb2XVBAywvA7Ig') !!}

    <!--[if lt IE 9]>
        {!! HTML::script('http://html5shim.googlecode.com/svn/trunk/html5.js') !!}
    <![endif]-->

    {{--Google Webfonts--}}

    {!! HTML::style('https://fonts.googleapis.com/css?family=Montserrat') !!}
    {!! HTML::style('https://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700') !!}
    {!! HTML::script('sherpaassets/lib/js/vendor/modernizr-2.7.1.min.js') !!}

   

</head><!--/head-->
<body>

{{--START SHERPA HOMEPAGE--}}
@yield('content')


{!! HTML::script('sherpaassets/lib/js/vendor/bootstrap.min.js') !!}
{!! HTML::script('sherpaassets/lib/js/owl.carousel.min.js') !!}
{!! HTML::script('sherpaassets/lib/js/jquery.isotope.js') !!}
{!! HTML::script('sherpaassets/lib/js/parallax.min.js')!!}
{!! HTML::script('sherpaassets/lib/js/easyResponsiveTabs.js') !!}
{!! HTML::script('sherpaassets/lib/js/core.js') !!}
{!! HTML::script('sherpaassets/lib/js/touch.js') !!}
{!! HTML::script('sherpaassets/lib/js/dropdown.js') !!}
{!! HTML::script('sherpaassets/lib/js/classie.js') !!}
{!! HTML::script('sherpaassets/lib/js/sidebarEffects.js') !!}
{!! HTML::script('sherpaassets/lib/js/plugins.js') !!}

<!--[if lt IE 9]>
    {!! HTML::script('sherpaassets/lib/js/vendor/selectivizr-min.js') !!}
<![endif]-->

{{--END SHERPA HOMEPAGE--}}

@yield('package-script')

</body>
</html>
