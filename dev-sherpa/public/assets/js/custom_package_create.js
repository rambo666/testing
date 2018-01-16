/**
 * Created by ashish on 10/3/16.
 */
$(document).ready(function() {
    var i = 1;
    $('#add-itinerary').on('click', function (e) {
        e.preventDefault();
        count_itinerary = $('.table-itinerary').length;
        console.log(count_itinerary);
        var lastitinerary = $('.table-itinerary:last');
        if ( !lastitinerary.find( '.daytitle' ).val() )
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
    // $('#close-itinerary1_0').on('click', function (e) {
        
    //     $('.close-itinerary1_0').remove();
       
    // })
    // $('#remove-itinerary2').on('click', function (e) {
    //     e.preventDefault();
    //      $('.close-itinerary2').remove();
       
    // })
    $( '.close-itinerary' ).on( 'click', function ( e ) {
        // e.preventDefault();
        console.log( $(this).parents('table') );
        $(this).parents('table').remove();
        // $(this).parent().parent().remove();
    } )

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

 $('#add-inc').on('click', function (e) {
        e.preventDefault();

        // get last input from .includes div
        var lastelem = $('.includes:last');

        var include = lastelem.find('.inc');
    
        if ( !include.find('input[type="text"]').val() )
        {
            lastelem.find( '.error-include' ).html( 'Fill the above form' );
        }
        else
        {

        // clone that last input
        lastelem = lastelem.clone(true);

        // remove the value inside it
        lastelem.find('input').val("");
        lastelem.find( '[ class ^= "error-" ]' ).html("");
        // add cloned element after last input
        lastelem.insertAfter($('.includes:last'));
        }

    });

    $('#add-exc').on('click', function (e) {
        e.preventDefault();
        var lastelem = $('.excludes:last');
        var exclude = lastelem.find('.exc');
    
        if ( !exclude.find('input[type="text"]').val() )
        {
            lastelem.find( '.error-exclude' ).html( 'Fill the above form' );
        }
        else
        {

        lastelem = lastelem.clone(true);

        // remove the value inside it
        lastelem.find('input').val("");
        lastelem.find( '[ class ^= "error-" ]' ).html("");

        lastelem.insertAfter($('.excludes:last'));
        }
    });
    
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

    
    // $('#add-inc').on('click', function (e) {
    //     e.preventDefault();
    //     // get last input from .includes div
    //     var lastelem = $('.includes .form-control:last');
    //     // clone that last input
    //     var lastelemclone = lastelem.clone(true);
    //     // lastelemclone.insertAfter('<br>');
    //     // remove the value inside it
    //     lastelemclone = lastelemclone.val("");
    //     // add cloned element after last input
    //     lastelemclone.insertAfter(lastelem);
    //     $("<br>").insertAfter(lastelem);
    // })
    // $('#add-exc').on('click', function (e) {
    //     e.preventDefault();
    //     var lastelem = $('.excludes .form-control:last');
    //     var lastelemclone = lastelem.clone(true);
    //     lastelemclone = lastelemclone.val("");
    //     lastelemclone.insertAfter(lastelem);
    //     $("<br>").insertAfter(lastelem);
    // })
$("#validate-form").submit(function(){  
    
   if(!$('input[type="file"]').val()) {
        // No file is uploaded, do not submit.
        alert("Please select atleast 1 Image");
        
        return false;
    }
    else if (!$('#title').val()) {    
        alert("Title field cannot be empty");
        return false;
    }
    else if (!$('#activityVal').val()) {    
        alert("Please Select an Activity");
        return false;
    }
    else if (!$('#regionVal').val()) {    
        alert("Please Select a Region");
        return false;
    }


    
    

});
});
