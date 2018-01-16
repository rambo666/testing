@extends('backend/layout/layout')
@section('content')
{!! HTML::style('assets/bootstrap/css/bootstrap-tagsinput.css') !!}
{!! HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
{!! HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
{!! HTML::script('ckeditor/ckeditor.js') !!}
{!! HTML::script('assets/bootstrap/js/bootstrap-tagsinput.js') !!}
{!! HTML::script('assets/js/jquery.slug.js') !!}
{!! HTML::script('/assets/js/customContent.js') !!}
<script type="text/javascript">
    $(document).ready(function () {
        $("#title").slug();
    });
</script>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Content <small> | Add Content</small> </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang() . '/admin/content') !!}"><i class="fa fa-book"></i> Content</a></li>
        <li class="active">Add Content</li>
    </ol>
</section>
<br>
<br>
<div class="container">

    {!! Form::open(array('action' => '\Fully\Http\Controllers\Admin\ContentController@store', 'method' => 'POST', 'files'=>true)) !!}

    {{--TITLE--}}
    <div class="row control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
        <div class="col-md-2"><label class="control-label" for="title">Title</label></div>

        <div class="col-md-8 controls">
            {!! Form::text('title', null, array('class'=>'form-control', 'id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}
            @if ($errors->first('title'))
            <span class="help-block">{!! $errors->first('title') !!}</span>
            @endif
        </div>
    </div>
    <br>

    {{--TERM--}}
    <div class="row control-group {!! $errors->has('term') ? 'has-error' : '' !!}">
        <div class="col-md-2"><label class="control-label" for="term">Term</label></div>

        <div class="col-md-8 controls">
            {!! Form::text('term', null, array('class'=>'form-control', 'id' => 'term', 'placeholder'=>'Term', 'value'=>Input::old('term'))) !!}
            @if ($errors->first('term'))
                <span class="help-block">{!! $errors->first('term') !!}</span>
            @endif
        </div>
    </div>
    <br>

    {{--INTRO--}}
    <div class="row control-group {!! $errors->has('intro') ? 'has-error' : '' !!}">
        <div class="col-md-2"><label class="control-label" for="title">Introduction</label></div>

        <div class="col-md-8 controls">
            {!! Form::textarea('intro', null, array('class'=>'form-control', 'id' => 'intro', 'placeholder'=>'Introduction', 'value'=>Input::old('intro'))) !!}
            @if ($errors->first('intro'))
            <span class="help-block">{!! $errors->first('intro') !!}</span>
            @endif
        </div>
    </div>
    <br>

    {{--CONTENTS--}}
    <div class="row">
        <div class="col-md-2"><label class="control-label" for="title">Contents</label></div>
        <div class="col-md-8">
            <table class="table table-striped well table-itinerary">

                <tbody>

                    <tr>
                        {{-- CONTENT NAME --}}
                        <div class="control-group {!! $errors->has('content_name') ? 'has-error' : '' !!}">
                            <td><label class="control-label" for="content_name">Content Name:</label></td>
                            <td>
                                <div class="controls">
                                    {!! Form::text('allcontent[0][content_name]', null, array('class'=>'form-control', 'placeholder'=>'Content Name', 'value'=>Input::old('allcontent')[0]['content_name'] )) !!}
                                    @if ($errors->first('content_name'))
                                        <span class="help-block">{!! $errors->first('content_name') !!}</span>
                                    @endif
                                </div>
                            </td>
                        </div>

                        {{--CONTENT DESCRIPTION--}}
                        <div class="control-group {!! $errors->has('content_desc') ? 'has-error' : '' !!}">
                            <td><label class="control-label" for="content_desc">Content Description:</label></td>
                            <td colspan="4">
                                <div class="controls">
                                    {!! Form::textarea('allcontent[0][content_desc]', null, array('rows' => 3, 'class'=>'form-control', 'placeholder'=>'Content Description', 'value'=>Input::old('allcontent')[0]['content_desc'] )) !!}
                                    @if ($errors->first('content_desc'))
                                        <span class="help-block">{!! $errors->first('content_desc') !!}</span>
                                    @endif
                                </div>
                            </td>
                        </div>
                    </tr>

                    <tr>

                        

                        {{--CONTENT IMAGE--}}
                        <div class="control-group {!! $errors->has('content_image') ? 'has-error' : '' !!}">
                            <td><label class="control-label" for="content_image">Image:</label></td>
                            <td colspan="3">
                                {{--IMAGE--}}
                                <img src="" alt="Content image" class="content-thumb" height="80">
                                <input type="file" name="image" class="form-control content-image" id="image0"  >
                                <input type="hidden" name="allcontent[0][content_image]" class="hiddenimage">
                          </td>
                        </div>
                    </tr>


                </tbody>
            </table>

            <a href="#" class="btn btn-primary" id="add-itinerary">Add New</a>
        </div>
        {{--Itinerary--}}
    </div>

    {!! Form::submit('Create', array('class' => 'btn btn-success')) !!}
    {!! Form::close() !!}
</div>

    {!! HTML::script('/sherpaassets/js/ajaxfileupload.js') !!}
    <script>
        window.onload = function () {
            CKEDITOR.replace('intro');
        };
        $('body').on('change', '.content-image', function () {
            // console.log('lsdhf');
            var thumbImage = $(this).prev(); // IMAGE TO SHOW
            var base_url = '<?php echo url(); ?>';
            var pathurl = base_url + '/en/admin/imageupload';
            var relative_url = '<?php echo url('uploads/content/'); ?>';
            //console.log(relative_url);
            var imageId = $(this).attr('id');
            // console.log(imageId);
            $.ajaxFileUpload({
                url: pathurl,
                secureuri: false,
                fileElementId: imageId,
                data: {'image': imageId},
                dataType: 'json',
                success: function (response, status) {
                // debugger;
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