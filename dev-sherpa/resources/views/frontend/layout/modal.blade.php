{{--Modal content--}}
<div class="modal fade org" id="request" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <section class="contact-form-section col-sm-12">

                <h2>Request a Quote</h2>
                

                {!! Form::open(array( 'route' => 'dashboard.sendmail', 'class' => 'form-contact', 'id' => 'requestquote' )) !!}
                <div class="row">
                    <div class="form-group important col-sm-12">
                        {!! Form::text( 'name', null, ['class' => 'form-control', 'placeholder' => 'contact name', 'id' => 'quote-name', 'required' => 'required', 'pattern' => '([a-zA-Z]{3,30}\s*)+' ] ) !!}
                    </div>

                    <div class="form-group important col-sm-12">
                        {!! Form::tel( 'number', null, ['class' => 'form-control', 'placeholder' => 'contact number', 'id' => 'quote-number','required' => 'required', 'pattern' => '^\d{7,}', 'title'=>'phone number must be atleast 7 digits' ]) !!}
                    </div>

                    <div class="form-group important col-sm-12">
                        {!! Form::text( 'package_title', null, ['class' => 'form-control', 'placeholder' => 'name of package', 'id' => 'quote-ptitle', 'required' => 'required' ] ) !!}
                    </div>

                    <div class="form-group important col-sm-12">
                        {!! Form::email( 'email', null, ['class' => 'form-control', 'placeholder' => 'contact email  ', 'id' => 'quote-email', 'required' => 'required'] ) !!}
                    </div>
                    <div class="form-group important col-sm-12">
                        {!! Form::hidden( 'test', null, ['class' => 'form-control', 'placeholder' => 'contact email  ', 'id' => 'testemail']) !!}
                    </div>

                    <div class="form-group important col-sm-6">
                        <div id="recaptcha1"></div>
                        {!! $errors->first('g-recaptcha-response','<p class="alert alert-danger">:message</p>')!!}
                    </div>
                    
                    <div class="form-group col-sm-6">
                        {!! Form::submit('Send Message', ['class' => 'btn btn-default']) !!}
                    </div>
                </div><div class="form-group important col-sm-6" id="msg"></div>
                {!! Form::close()  !!}
            </section>
        </div><!-- /.modal-content -->
        <span data-dismiss="modal" class="close-btn" style="cursor: pointer;"><img class="svg" src="<?php url('sherpaasets/images/icons/close-icon.svg'); ?>" alt=""></span>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready( function () {
       
        $('#requestquote').submit(function ( e ) {
            e.preventDefault();
           
             $("#msg").empty();
//                var url = $('.form-contact');
//                console.log(url);
            var url = "{{  route( 'dashboard.sendmail' ) }}";

            var _token = $( 'input[name=_token]' ).val();
            var name = $( '#quote-name' ).val();
            var number = $( '#quote-number' ).val();
            var ptitle = $( '#quote-ptitle' ).val();
            var email = $( '#quote-email' ).val();
            var testemail = $( '#testemail' ).val();
            var recaptcha1 = $('#g-recaptcha-response').val();
//console.log(subject + message);

            var formData = {
                _token: _token,
                name: name,
                number: number,
                package_title: ptitle,
                email: email,
                testemail: testemail,
                recaptcha1: recaptcha1,
            }

            $.ajax({
                url: url,
                data: formData,
                type: 'post',
                dataType: 'json',
                success: function ( response ) {
                
                    $( '#msg' ).append( '<b>' + response.responseText + '</b>' );
               

                },
                error: function ( response ) {
                    $( '#msg' ).append( '<b>' + response.responseText + '</b>' );
                }

            });

            $("#quote-name").val("");
                    $("#quote-number").val("");
                    $("#quote-ptitle").val("");
                    $("#quote-email").val("");
        } );
    } );


</script>

