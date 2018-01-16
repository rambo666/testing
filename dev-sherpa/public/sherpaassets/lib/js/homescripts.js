/*
 Author: View9
 */

$(window).load(function(){

    //Animation ADD:
    jQuery('#destiny-container, #activity-container').addClass("animated fadeInUp");
    var destiny = (function() {
        var $container = $('#destiny-container, #activity-container');
        $select = $('#filters select');

        // initialize Isotope
        $container.imagesLoaded(function(){
            $container.isotope({
                // options...
                resizable: true, // disable normal resizing
                // set columnWidth to a percentage of container width
                masonry: { columnWidth: $container.width() / 12 }
            });
        });

        // update columnWidth on window resize
        $(window).smartresize(function(){
            $container.isotope({
                // update columnWidth to a percentage of container width
                masonry: { columnWidth: $container.width() / 12 }
            });
        });

        $container.isotope({
            itemSelector : '.destiny-item'
        });

        $select.change(function() {
            var filters = $(this).val();

            $container.isotope({
                filter: filters
            });
        });

        // Portfolio Filtering
        var $optionSets = $('#filters .option-lists'),
            $optionLinks = $optionSets.find('a');

        $optionLinks.click(function(){
            var $this = $(this);
            // don't proceed if already selected
            if ( $this.hasClass('selected') ) {
                return false;
            }
            var $optionSet = $this.parents('.option-lists');
            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');

            // make option object dynamically, i.e. { filter: '.my-filter-class' }
            var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
            // parse 'false' as false boolean
            value = value === 'false' ? false : value;
            options[ key ] = value;
            if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
                // changes in layout modes need extra logic
                changeLayoutMode( $this, options )
            } else {
                // otherwise, apply new options
                $container.isotope( options );
            }
            return false;
        });

    });

    destiny();

    $('#package-lists').masonry({
        itemSelector: '.destiny-item'
    });

    // $("#icon-side").click(function(){
    //     $('.sidebar-section').toggleClass('none');
    //     $('.content-wrapper').toggleClass('padding-none');
    //     $(this).parent().toggleClass('post-left');
    //     $('#trip-slider').parent().toggleClass('container').toggleClass('container-fluid');
    //     $('#header > div .row').parent().toggleClass('container').toggleClass('container-fluid');
    //     $("#package-tab").parent().toggleClass('container').toggleClass('container-fluid');
    //     $('#home-banner').parent().toggleClass('container').toggleClass('container-fluid');
    //     $('.banner-image').parent().toggleClass('container').toggleClass('container-fluid');
    //     $('html').toggleClass('font-sizer');
    // });

    // if ($(window).width() < 1500){
    //     $("#icon-side").click();
    // }
});

jQuery(document).ready(function ($) {
    // $("html").niceScroll();

    $('.menu-icon').append('<i class="menu-label">menu</i>');

    $('#main-nav').smartmenus();

    // if ($(window).width() < 1500) {
    //     $("#icon-side").click();
    // }

    $(".form-dropdown").dropdown();


    $("#home-banner").owlCarousel({
        navigation : false, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,

    });


    $("#trip-slider").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true

    });


    $('.menu-icon').click(function(){
        $(this).toggleClass('vertical');
        $('.primary-nav #main-nav').slideToggle();
    });



    $("#testimonial-slider").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items : 2,
        itemsDesktop : [1199,2],
        itemsDesktopSmall : [979,3],
        itemsTablet: [600,2], //2 items between 600 and 0
        itemsMobile : [480,1]
    });


    $(".btn, button[type='submit'], .btn-transparent").addClass("hvr-shutter-in-vertical");


    /*
     * Replace all SVG images with inline SVG
     */
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });


    $('#package-tab').easyResponsiveTabs({
        type: 'default',
        width: 'auto',
        fit: true,
        tabidentify: 'hor_1', // The tab groups identifier
        activetab_bg: '#fff', // background color for active tabs in this group
        inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
        active_border_color: '#c1c1c1', // border color for active tabs heads in this group
        active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
    });

    // Search Interaction
    $('#SearchIcon').click(function(){
        $(this).toggleClass("opened");
        $("#search").toggleClass("expanded");
    });


});






//]]>


// $( window ).resize(function(){
//     $("#icon-side").click();
// }

