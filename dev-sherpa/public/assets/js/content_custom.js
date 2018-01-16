$(document).ready(function() {
    
    //CONTENT
    var i = 1;
    $('#add-content').on('click', function (e) {
        e.preventDefault();
        
        count_content = $('.table-content').length;
        console.log(count_content);
        var lastcontent = $('.table-content:last');

        var some = lastcontent.find('.contentname');
    
        if ( !some.find('input[type="text"]').val() )
        {
            lastcontent.find( '.error-title' ).html( 'Fill the content name' );
        }
        else
        {
            lastcontent = lastcontent.clone(true);

            lastcontent.find("input, textarea, file").val("");
            lastcontent.find(".fileinput-preview.thumbnail").html("");
            lastcontent.find( '[ class ^= "error-" ]' ).html("");
            lastcontent.find("img.content-thumb").attr("src", '');
            lastcontent.find("span.content-thumb").html("");

            lastcontent.insertAfter('.table-content:last');

            // change name attribute

            $('.table-content:last').each(function () {
                var inputfield = $(this).find("input, textarea");

                inputfield.each(function () {
                    // if first add new replace 0 by count

                    inputname = $(this).attr('name');
                    if ( inputname.indexOf('[0]') != -1 ){
                        var newinputname = inputname.replace('[0]','['+ i +']');
                        $(this).attr('name', newinputname);
                    } else {
                        var newinputname = inputname.replace('['+ (count_content-1) +']','['+ count_content +']');
                        $(this).attr('name', newinputname);
                    }

                });

            });
            i++;
        }

    })
    
    // REMOVE CONTENT
    $( '.content_del' ).on( 'click', function ( e ) {
        e.preventDefault();

        var count_content = $('.table-content').length;

        if(count_content == 1){
            
            $('.table-content').find("input, textarea, file").val("");
            $('.table-content').find(".fileinput-preview.thumbnail").html("");
            $('.table-content').find( '[ class ^= "error-" ]' ).html("");
            $('.table-content').find("img.content-thumb").attr("src", '');
            $('.table-content').find("span.content-thumb").html("");

        }else{
            
             $(this).closest('.table-content').remove();
        }
    
    } )  

    // END OF CONTENT JS
});