/**
 * Created by ashish on 10/3/16.
 */
$(document).ready(function() {
    var i = 1;
    $('#add-itinerary').on('click', function (e) {
        e.preventDefault();

        count_itinerary = $('.table-itinerary').length;
        // console.log(count_itinerary);
        var lastitinerary = $('.table-itinerary:last');
        lastitinerary = lastitinerary.clone(true);

        lastitinerary.find("input, textarea, file").val("");
        lastitinerary.find(".fileinput-preview.thumbnail").html("");
        lastitinerary.find("img.content-thumb").attr("src", '');
        lastitinerary.find("span.content-thumb").html("");

        lastitinerary.insertAfter('.table-itinerary:last');

        // change name attribute

        $('.table-itinerary:last').each(function () {
            var inputfield = $(this).find("input, textarea");

            inputfield.each(function () {
                // if first add new replace 0 by count

                var inputname = $(this).attr('name');
                if ( inputname.indexOf('[0]') != -1 ){ // if first content
                    var newinputname = inputname.replace('[0]','['+ i +']');
                    $(this).attr('name', newinputname);
                } else {
                    var newinputname = inputname.replace('['+ (count_itinerary-1) +']','['+ count_itinerary +']');
                    $(this).attr('name', newinputname);
                }

            });

            var imagefield = $(this).find("input[type=file]");
            // console.log(imagefield);

            imagefield.each(function () {
                var imageId = $(this).attr('id');
                if ( imageId.indexOf('0') != -1 ) { // if first content's image
                    // console.log('first');
                    var newImageId = imageId.replace( 0, i );
                    $(this).attr('id', newImageId);
                } else {
                    // console.log(count_itinerary);
                    var newImageId = imageId.replace( count_itinerary-1, count_itinerary);
                    $(this).attr('id', newImageId);
                }

            });

        });
        i++;
    })
})