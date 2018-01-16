<div class="modal fade org" id="book" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <section class="contact-form-section col-sm-12">

                <h2>Book this trip</h2>
              
                {!! Form::open(array( 'route' => 'dashboard.booktrip', 'class' => 'form-contact', 'role' => 'form', 'id' => 'booktrip' )) !!}

                    {{--Send hidden package title--}}
                    {!! Form::hidden('package_title', $package->title, ['id' => 'book-ptitle']) !!}
                    <div class="form-group important col-sm-12">
                        {!! Form::text( 'name', null, ['class' => 'form-control', 'placeholder' => 'contact name','required' => 'required', 'id' => 'book-name', 'pattern' => '([a-zA-Z]{3,30}\s*)+'] ) !!}
                     @if ($errors->has('name'))<p style="color:red;">{!!$errors->first('name')!!}</p>@endif
                    </div>

                    <div class="form-group important col-sm-12">
                        {!! Form::tel( 'number', null, ['class' => 'form-control', 'placeholder' => 'contact number','required' => 'required', 'pattern' => '^\d{7,}', 'title'=>'phone number must be atleast 7 digits', 'id' => 'book-number' ] ) !!}
                    </div>

                    {{--<div class="form-group important col-sm-12">--}}
                        {{--<select name="dropdown" class="form-dropdown">--}}
                            {{--<option value="1">business name</option>--}}
                            {{--<option value="2">business name 2</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}

                    <div class="form-group important col-sm-12">
                        {!! Form::email( 'email', null, ['class' => 'form-control', 'placeholder' => 'contact email','required' => 'required', 'id' => 'book-email'] ) !!}
                    </div>

                    <div class="form-group important col-sm-12">

                        <div id="recaptcha2"></div>

                    </div>

                    {{--<div class="form-group col-sm-12">--}}
                        {{--<div class="radio">--}}
                            {{--<label class="form-control" for="">Have you travel with us before</label>--}}
                            {{--<label><input type="radio" name="optradio">Yes</label>--}}
                        {{--</div>--}}
                        {{--<div class="radio">--}}
                            {{--<label><input type="radio" name="optradio">No</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    <div class="form-group col-sm-12">
                        {!! Form::submit('Book this trip', ['class' => 'btn btn-default']) !!}
                    </div><div class="form-group important col-sm-6" id="msgbookmodal"></div>
                {!! Form::close() !!}
            </section>
        </div><!-- /.modal-content -->
        <span data-dismiss="modal" class="close-btn" style="cursor: pointer;"><img class="svg" src="{{ url('sherpaassets/images/icons/close-icon.svg') }}" alt=""></span>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready( function () {
        $('#booktrip').submit(function ( e ) {
            e.preventDefault();
            //console.log('hi');
            $("#msgbookmodal").empty();
            var url = "{{  route( 'dashboard.booktrip' ) }}";

            var _token = $( 'input[name=_token]' ).val();
            var name = $( '#book-name' ).val();
            var ptitle = $( '#book-ptitle' ).val();
            var number = $( '#book-number' ).val();
            var email = $( '#book-email' ).val();
            var recaptcha2 = $('#g-recaptcha-response-1').val();

            var formData = {
                _token: _token,
                name: name,
                ptitle: ptitle,
                number: number,
                email: email,
                recaptcha2: recaptcha2,
            }

            $.ajax({
                url: url,
                data: formData,
                type: 'post',
                dataType: 'json',
                success: function ( response ) {
                     $( '#msgbookmodal' ).append( '<b>' + response.responseText + '</b>' );
                },
                error: function ( response ) {
                     $( '#msgbookmodal' ).append( '<b>' + response.responseText + '</b>' );
                }

            });
            $("#book-name").val("");
                    $("#book-number").val("");
                    $("#book-ptitle").val("");
                    $("#book-email").val("");
        } );


    } );


</script>


