/**
 * Created by ashish on 10/3/16.
 */
$(document).ready(function() {
    
    //ITINERARY
    var i = 1;
    $('#add-itinerary').on('click', function (e) {
        e.preventDefault();

        count_itinerary = $('.table-itinerary').length;
        console.log(count_itinerary);
        var lastitinerary = $('.table-itinerary:last');

        var some = lastitinerary.find('.daytitle');
    
        if ( !some.find('input[type="text"]').val() )
        {
            lastitinerary.find( '.error-title' ).html( 'Fill the day title' );
        }
        else
        {
            lastitinerary = lastitinerary.clone(true);

            lastitinerary.find("input, textarea, file").val("");
            lastitinerary.find(".fileinput-preview.thumbnail").html("");
            lastitinerary.find( '[ class ^= "error-" ]' ).html("");
            lastitinerary.find("img.content-thumb").attr("src", '');
            lastitinerary.find("span.content-thumb").html("");

            lastitinerary.insertAfter('.table-itinerary:last');

            // change name attribute

            $('.table-itinerary:last').each(function () {
                var inputfield = $(this).find("input, textarea");

                inputfield.each(function () {
                    // if first add new replace 0 by count

                    inputname = $(this).attr('name');
                    if ( inputname.indexOf('[0]') != -1 ){
                        var newinputname = inputname.replace('[0]','['+ i +']');
                        $(this).attr('name', newinputname);
                    } else {
                        var newinputname = inputname.replace('['+ (count_itinerary-1) +']','['+ count_itinerary +']');
                        $(this).attr('name', newinputname);
                    }

                });

            });
            i++;
        }

    })
    
    // REMOVE ITINERARY
    $( '.itinerary_del' ).on( 'click', function ( e ) {
        e.preventDefault();

        var count_itinerary = $('.table-itinerary').length;

        if(count_itinerary == 1){
            
            $('.table-itinerary').find("input, textarea, file").val("");
            $('.table-itinerary').find(".fileinput-preview.thumbnail").html("");
            $('.table-itinerary').find( '[ class ^= "error-" ]' ).html("");
            $('.table-itinerary').find("img.content-thumb").attr("src", '');
            $('.table-itinerary').find("span.content-thumb").html("");

        }else{
            
             $(this).closest('.table-itinerary').remove();
        }
    
    } )  

    




    $( '.close-itinerary' ).on( 'click', function ( e ) {
        // e.preventDefault();

        console.log( $(this).parents('table') );
        $(this).parents('table').remove();
        // $(this).parent().parent().remove();
    } )

    // TRIP INCLUSIONS JS
    $('#add-inc').on('click', function (e) {
        e.preventDefault();

        // get last input from .includes div
        var lastelem = $('.includes:last');

        // clone that last input
        var lastelemclone = lastelem.clone(true);

        // remove the value inside it
        lastelemclone.find('input').val("");
    
        // add cloned element after last input
        lastelemclone.insertAfter(lastelem);
    })

    $('#add-exc').on('click', function (e) {
        e.preventDefault();

        cloneCount = 0;

        var lastelem = $('.excludes:last');

        var lastelemclone = lastelem.clone(true);

        // remove the value inside it
        lastelemclone.find('input').val("");

        lastelemclone.insertAfter(lastelem);
    })


    $('.del-inc').on('click', function (e) {
        e.preventDefault();
        
        count_inc = $('.includes').length;

        if (count_inc == 1)
        {
            $('.includes').find("input, textarea, file").val("");
        }
        else
        {
        $(this).closest(".includes").remove();
        }
    })

    $('.del-exc').on('click', function (e) {
        e.preventDefault();

        count_inc = $('.excludes').length;

                if (count_inc == 1)
                {
                    $('.excludes').find("input, textarea, file").val("");
                }
                else
                {
                $(this).closest(".control-group").remove();
                }

    })
    

}); //top


