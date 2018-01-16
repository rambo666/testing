@extends('backend/layout/layout')
@section('content')

{!! HTML::script('ckeditor/ckeditor.js') !!}
<script type="text/javascript">
    $(document).ready(function () {
                var hash = document.location.hash;
                if (hash) {
                    $('.nav-tabs a[href='+hash+']').tab('show');
                } 

                // Change hash for page-reload
                $('.nav-tabs a').on('shown.bs.tab', function (e) {
                    window.location.hash = e.target.hash;
                });
    });

    function changeTab(val)
        {
            document.getElementById("settingTab").value=val;
        }

    $(document).ready(function () {
        $('#notification').show().delay(4000).fadeOut(700);
    });
</script>
<section class="content-header">
    <h1> Settings
        <small> | Change Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang(). '/admin') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Change Settings</li>
    </ol>
</section>
<br>
<br>
<div class="container">
<div class="col-lg-10">

    @include('flash::message')
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
        <li><a href="#footer" data-toggle="tab">Footer</a></li>
        <li><a href="#contact" data-toggle="tab">Contact us</a></li>
        <li><a href="#homecontent" data-toggle="tab">Home Content</a></li>
        {{--<li><a href="#info" data-toggle="tab">Info</a></li>--}}
    </ul>
    {!! Form::open( array( 'files' => true ) ) !!}
    <div class="tab-content">

        <div class="tab-pane active" id="settings">
            <br>
            <h4><i class="glyphicon glyphicon-cog"></i> Settings</h4>

            <br>


            <!-- Title -->
            <div class="control-group {!! $errors->has('site_title') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Title</label>

                <div class="controls">
                    {!! Form::text('site_title', isset($setting['site_title']) ? $setting['site_title'] : null, array('class'=>'form-control', 'id' => 'site_title', 'placeholder'=>'Title', 'value'=>Input::old('site_title'))) !!}
                    @if ($errors->first('title'))
                    <span class="help-block">{!! $errors->first('site_title') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Google Analytics Code -->
            {{--<div class="control-group {!! $errors->has('ga_code') ? 'has-error' : '' !!}">--}}
                {{--<label class="control-label" for="title"> Google Analytics Code</label>--}}

                {{--<div class="controls">--}}
                    {{--{!! Form::text('ga_code', isset($setting['ga_code']) ? $setting['ga_code'] : null, array('class'=>'form-control', 'id' => 'ga_code', 'placeholder'=>' Google Analytics Code', 'value'=>Input::old('ga_code'))) !!}--}}
                    {{--@if ($errors->first('ga_code'))--}}
                    {{--<span class="help-block">{!! $errors->first('ga_code') !!}</span>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<br>--}}

            <!-- Meta Keywords -->
            <div class="control-group {!! $errors->has('meta_keywords') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Meta Keywords</label>

                <div class="controls">
                    {!! Form::text('meta_keywords', isset($setting['meta_keywords']) ? $setting['meta_keywords'] : null, array('class'=>'form-control', 'id' => 'meta_keywords', 'placeholder'=>'Meta Keywords', 'value'=>Input::old('meta_keywords'))) !!}
                    @if ($errors->first('meta_keywords'))
                    <span class="help-block">{!! $errors->first('meta_keywords') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Meta Description -->
            <div class="control-group {!! $errors->has('meta_description') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Meta Description</label>

                <div class="controls">
                    {!! Form::text('meta_description', isset($setting['meta_description']) ? $setting['meta_description'] : null, array('class'=>'form-control', 'id' => 'meta_description', 'placeholder'=>'Meta Description', 'value'=>Input::old('meta_description'))) !!}
                    @if ($errors->first('meta_description'))
                    <span class="help-block">{!! $errors->first('meta_description') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            <br>
           {!! Form::submit('Save Changes', array('class' => 'btn btn-success','onClick'=> 'changeTab("#settings")')) !!}
        </div>








{{--FOOTER TAB --}}
        <div class="tab-pane" id="footer">
            <br>
            <h4> Social</h4>
            <br>

            {{--FACEBOOK--}}
            <div class="control-group {!! $errors->has('facebook_link') ? 'has-error' : '' !!}">
                <label class="control-label" for="facebook_link">Facebook link</label>

                <div class="controls">
                    {!! Form::text('facebook_link', isset($setting['facebook_link']) ? $setting['facebook_link'] : null, array('class'=>'form-control', 'id' => 'facebook_link', 'placeholder'=>'Facebook Link', 'value'=>Input::old('facebook_link'))) !!}
                    @if ($errors->first('facebook_link'))
                        <span class="help-block">{!! $errors->first('facebook_link') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            {{--TWITTER--}}
            <div class="control-group {!! $errors->has('twitter_link') ? 'has-error' : '' !!}">
                <label class="control-label" for="twitter_link">Twitter link</label>

                <div class="controls">
                    {!! Form::text('twitter_link', isset($setting['twitter_link']) ? $setting['twitter_link'] : null, array('class'=>'form-control', 'id' => 'twitter_link', 'placeholder'=>'Facebook Link', 'value'=>Input::old('twitter_link'))) !!}
                    @if ($errors->first('twitter_link'))
                        <span class="help-block">{!! $errors->first('twitter_link') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            {{--INSTAGRAM--}}
            <div class="control-group {!! $errors->has('instagram_link') ? 'has-error' : '' !!}">
                <label class="control-label" for="instagram_link">Instagram link</label>

                <div class="controls">
                    {!! Form::text('instagram_link', isset($setting['instagram_link']) ? $setting['instagram_link'] : null, array('class'=>'form-control', 'id' => 'instagram_link', 'placeholder'=>'Facebook Link', 'value'=>Input::old('instagram_link'))) !!}
                    @if ($errors->first('instagram_link'))
                        <span class="help-block">{!! $errors->first('instagram_link') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            {{--YOUTUBE--}}
            <div class="control-group {!! $errors->has('youtube_link') ? 'has-error' : '' !!}">
                <label class="control-label" for="youtube_link">Youtube link</label>

                <div class="controls">
                    {!! Form::text('youtube_link', isset($setting['youtube_link']) ? $setting['youtube_link'] : null, array('class'=>'form-control', 'id' => 'youtube_link', 'placeholder'=>'Facebook Link', 'value'=>Input::old('youtube_link'))) !!}
                    @if ($errors->first('youtube_link'))
                        <span class="help-block">{!! $errors->first('youtube_link') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            <br>

            <h4> We Accept</h4>
            <br>

            {{--LOGO 1--}}
            <div class="control-group {!! $errors->has('logo') ? 'has-error' : '' !!}">
                <label class="control-label" for="logo"></label>

                <div class="controls">

                    <img src="{!! ( isset( $setting['content_image'] ) ? url( '/uploads/content/' . $setting['content_image'] ) : '' ) !!}" alt="Content image" class="content-thumb" height="80">
                    <input type="file" name="image" class="form-control content-image" id="logo"  >
                    <input type="hidden" name="content_image" class="hiddenimage" value="{!! ( isset( $setting['content_image'] ) ? $setting['content_image'] : null ) !!}">

                    @if ($errors->first('logo'))
                        <span class="help-block">{!! $errors->first('logo') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            <br>

            {{--COPYRIGHT--}}
            <h4> Copyright</h4>
            <br>

            {{--FACEBOOK--}}
            <div class="control-group {!! $errors->has('copyright') ? 'has-error' : '' !!}">
                <label class="control-label" for="copyright">Copyright text</label>

                <div class="controls">
                    {!! Form::text('copyright', isset($setting['copyright']) ? $setting['copyright'] : null, array('class'=>'form-control', 'id' => 'copyright', 'placeholder'=>'Copyright text', 'value'=>Input::old('copyright'))) !!}
                    @if ($errors->first('copyright'))
                        <span class="help-block">{!! $errors->first('copyright') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            <br>
      {!! Form::submit('Save Changes', array('class' => 'btn btn-success','onClick'=> 'changeTab("#footer")')) !!}
        </div>







{{--CONTACT TAB--}}
        <div class="tab-pane" id="contact">
            {{--PHONE--}}
            <div class="control-group {!! $errors->has('contact_number') ? 'has-error' : '' !!}">
                <label class="control-label" for="contact_number">Phone Number</label>

                <div class="controls">
                    {!! Form::number('contact_number', isset($setting['contact_number']) ? $setting['contact_number'] : null, array('class'=>'form-control', 'id' => 'contact_number', 'placeholder'=>'Phone number', 'value'=>Input::old('contact_number'))) !!}
                    @if ($errors->first('contact_number'))
                        <span class="help-block">{!! $errors->first('contact_number') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            {{--INTRO--}}
            <div class="control-group {!! $errors->has('contact_intro') ? 'has-error' : '' !!}">
                <label class="control-label" for="contact_intro">INTRO</label>

                <div class="controls">
                    {!! Form::text('contact_intro', isset($setting['contact_intro']) ? $setting['contact_intro'] : null, array('class'=>'form-control', 'id' => 'contact_intro', 'placeholder'=>'Contact us page intro', 'value'=>Input::old('contact_intro'))) !!}
                    @if ($errors->first('contact_intro'))
                        <span class="help-block">{!! $errors->first('contact_intro') !!}</span>
                    @endif
                </div>
            </div>
            <br>


            <div class="row">
                <div class="col-md-6">
                    <br>
                    <h4> Main Office</h4>
                    <br>
                    {{-- OFC 1: TITLE --}}
                    <div class="control-group {!! $errors->has('officeone_title') ? 'has-error' : '' !!}">
                        <label class="control-label" for="officeone_title">Title</label>

                        <div class="controls">
                            {!! Form::text('officeone_title', isset($setting['officeone_title']) ? $setting['officeone_title'] : null, array('class'=>'form-control', 'id' => 'officeone_title','required' => 'required', 'placeholder'=>'Main office title', 'value'=>Input::old('officeone_title'))) !!}
                            @if ($errors->first('officeone_title'))
                                <span class="help-block">{!! $errors->first('officeone_title') !!}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    {{-- OFC 1: LOCATION --}}
                    <div class="control-group {!! $errors->has('officeone_addr') ? 'has-error' : '' !!}">
                        <label class="control-label" for="officeone_addr">Address</label>

                        <div class="controls">
                            {!! Form::text('officeone_addr', isset($setting['officeone_addr']) ? $setting['officeone_addr'] : null, array('class'=>'form-control', 'id' => 'officeone_addr', 'placeholder'=>'Main office address', 'required' => 'required','value'=>Input::old('officeone_addr'))) !!}
                            @if ($errors->first('officeone_addr'))
                                <span class="help-block">{!! $errors->first('officeone_addr') !!}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    {{-- OFC 1: PHONE --}}
                    <div class="control-group {!! $errors->has('officeone_phone') ? 'has-error' : '' !!}">
                        <label class="control-label" for="officeone_phone">Phone</label>

                        <div class="controls">
                            {!! Form::text('officeone_phone', isset($setting['officeone_phone']) ? $setting['officeone_phone'] : null, array('class'=>'form-control', 'id' => 'officeone_phone', 'placeholder'=>'Main office phone','required' => 'required|regex:/[0-9]/' , 'value'=>Input::old('officeone_phone'))) !!}
                            @if ($errors->first('officeone_phone'))
                                <span class="help-block">{!! $errors->first('officeone_phone') !!}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    {{-- OFC 1: MAIL --}}
                    <div class="control-group {!! $errors->has('officeone_mail') ? 'has-error' : '' !!}">
                        <label class="control-label" for="officeone_mail">Email</label>

                        <div class="controls">
                            {!! Form::text('officeone_mail', isset($setting['officeone_mail']) ? $setting['officeone_mail'] : null, array('class'=>'form-control', 'id' => 'officeone_mail', 'placeholder'=>'Main office email','required' => 'required', 'value'=>Input::old('officeone_mail'))) !!}
                            @if ($errors->first('officeone_mail'))
                                <span class="help-block">{!! $errors->first('officeone_mail') !!}</span>
                            @endif
                        </div>
                    </div>
                    <br>
                </div>



                <div class="col-md-6">
                  <br>
                    
                    <h4> Map location of Main Office</h4>
                    <br>

                    {{-- Location 1: Title --}}
                    <div class="control-group {!! $errors->has('location1') ? 'has-error' : '' !!}">
                        <label class="control-label" for="location1">Location Name</label>

                        <div class="controls">
                            {!! Form::text('location1', isset($setting['location1']) ? $setting['location1'] : null, array('class'=>'form-control', 'id' => 'location1', 'placeholder'=>'Location one', 'value'=>Input::old('location1'))) !!}
                            @if ($errors->first('location1'))
                                <span class="help-block">{!! $errors->first('location1') !!}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    {{-- Location 1: latitude --}}
                    <div class="control-group {!! $errors->has('lat1') ? 'has-error' : '' !!}">
                        <label class="control-label" for="lat1">Latitude</label>

                        <div class="controls">
                            {!! Form::number('lat1', isset($setting['lat1']) ? $setting['lat1'] : null, array( 'min'=>-90,'max'=>90,'step'=>0.0000001,'class'=>'form-control', 'id' => 'lat1', 'placeholder'=>'Location one latitude', 'value'=>Input::old('lat1'))) !!}
                            @if ($errors->first('lat1'))
                                <span class="help-block">{!! $errors->first('lat1') !!}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    {{-- Location 1: longitude --}}
                    <div class="control-group {!! $errors->has('lng1') ? 'has-error' : '' !!}">
                        <label class="control-label" for="lng1">Longitude</label>

                        <div class="controls">
                            {!! Form::number('lng1', isset($setting['lng1']) ? $setting['lng1'] : null, array('min'=>-180,'max'=>180,'step'=>0.0000001,'class'=>'form-control', 'id' => 'lng1', 'placeholder'=>'Location one latitude', 'value'=>Input::old('lng1'))) !!}
                            @if ($errors->first('lng1'))
                                <span class="help-block">{!! $errors->first('lng1') !!}</span>
                            @endif
                        </div>
                    </div>
                    <br>
                  
                </div>

            </div><!-- /.row -->
            <br/>
           {!! Form::submit('Save Changes', array('class' => 'btn btn-success','onClick'=> 'changeTab("#contact")')) !!}
            <hr>


        </div>

<!-- Home content settings -->
<br/><br/>
        <div class="tab-pane" id="homecontent">
            <div class="row controls">
                <div class="col-md-2"><label class="control-label" for="title">Title</label></div>
                    <div class="controls">
                        {!! Form::text('Hometitle', isset($setting['Hometitle']) ? $setting['Hometitle'] : null, array('class'=>'form-control', 'id' => 'Hometitle', 'placeholder'=>'Hometitle', 'value'=>Input::old('Hometitle'))) !!}
                        @if ($errors->first('title'))
                            <span class="help-block">{!! $errors->first('title') !!}</span>
                        @endif<br/>
                    </div>

            <div ><label class="control-label" for="title">Contents</label></div>
                <div class="controls">
                    {!! Form::textarea('Homeintro', isset($setting['Homeintro']) ? $setting['Homeintro'] : null, array('class'=>'form-control', 'id' => 'Homeintro', 'placeholder'=>'Homeintro', 'value'=>Input::old('Homeintro'))) !!}
                    @if ($errors->first('lng1'))
                        <span class="help-block">{!! $errors->first('lng1') !!}</span>
                    @endif

                </div>
            </div>
            <br/>
            {!! Form::submit('Save Changes', array('class' => 'btn btn-success','onClick'=> 'changeTab("#homecontent")')) !!}
        </div> <!-- div id=homecontent -->



<br/>
                   

        {{--<div class="tab-pane" id="info">--}}
            {{--<br>--}}
            {{--<h4> Info</h4>--}}
            {{--<br>--}}
            {{--Lorem profile dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.--}}
            {{--<p>Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis--}}
                {{--dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan.--}}
                {{--Aliquam in felis sit amet augue.</p>--}}
        {{--</div>--}}
    </div>
{!! Form::hidden('settingTab', null, array('class'=>'form-control', 'id' => 'settingTab')) !!}
    
    {!! Form::close() !!}
</div></div>


 <script>
         window.onload = function () {
            CKEDITOR.replace('Homeintro');
        };
    </script>
{!! HTML::script('/sherpaassets/js/ajaxfileupload.js') !!}
<script>

  
    $('body').on('change', '.content-image', function () {
        console.log('lsdhf');
        var thumbImage = $(this).prev(); // IMAGE TO SHOW
        var base_url = '<?php echo url(); ?>';
        var pathurl = base_url + '/en/admin/imageupload';
        var relative_url = '<?php echo url('uploads/content/'); ?>';
//console.log(relative_url);
        var imageId = $(this).attr('id');
//            console.log(imageId);
        $.ajaxFileUpload({
            url: pathurl,
            secureuri: false,
            fileElementId: imageId,
            data: {'image': imageId},
            dataType: 'json',
            success: function (response, status) {
//                    debugger;
                if(response.success)
                {
                    $('.hiddenimage').val(response.image_name);
                    thumbImage.attr('src', relative_url + '/' + response.image_name); // CHANGE IMAGE SOURCE
                }
            }
        });



    });
</script>

@stop

