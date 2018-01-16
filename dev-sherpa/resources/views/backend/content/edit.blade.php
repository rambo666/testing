@extends('backend/layout/layout')
@section('content')
    {!! HTML::style('assets/bootstrap/css/bootstrap-tagsinput.css') !!}
    {!! HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
    {!! HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
    {!! HTML::script('ckeditor/ckeditor.js') !!}
    {!! HTML::script('assets/bootstrap/js/bootstrap-tagsinput.js') !!}
    {!! HTML::script('assets/js/jquery.slug.js') !!}
    {!! HTML::script('/assets/js/content_custom.js') !!}
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

        {!! Form::open(array('action' => ['\Fully\Http\Controllers\Admin\ContentController@update', $content->id], 'method' => 'PATCH', 'files'=>true)) !!}

        {{--TITLE--}}
        <div class="row control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <div class="col-md-2"><label class="control-label" for="title">Title</label></div>

            <div class="col-md-8 controls">
                {!! Form::text('title', $content->title, array('class'=>'form-control', 'id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}
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
                {!! Form::text('terms', $content->term, array('class'=>'form-control','disabled', 'id' => 'term', 'placeholder'=>'Term', 'value'=>Input::old('term'))) !!}
                {!! Form::hidden('term', $content->term, array('class'=>'form-control', 'id' => 'term', 'placeholder'=>'Term', 'value'=>Input::old('term'))) !!}
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
                {!! Form::textarea('intro', $content->intro, array('class'=>'form-control', 'id' => 'intro', 'placeholder'=>'Introduction', 'value'=>Input::old('intro'))) !!}
                @if ($errors->first('intro'))
                    <span class="help-block">{!! $errors->first('intro') !!}</span>
                @endif
            </div>
        </div>
        <br>

        @if($term=='whysherpa' || $term=='content')
            {!! Form::hidden('noContent', 'noCon', array('class'=>'form-control')) !!}


        @elseif ($term=='banner')



        <div class="row">
            <div class="col-md-2"><label class="control-label" for="title">Banner Image:</label></div>
            <div class="col-md-8">

                <?php $it_count = 0;
                $count = count($content); ?>
                @foreach($content->content as $contentdata)
                    
                <table class="table table-striped well table-content">

                    <tbody>
                        <tr>
                            {{-- CONTENT NAME --}}
                            <div class="control-group {!! $errors->has('content_name') ? 'has-error' : '' !!}">
                                <td></td>
                                <td>
                                    <div class="contentname controls">
                                        {!! Form::hidden('allcontent['.$it_count.'][content_name]', $contentdata['content_name'], array('class'=>'form-control', 'placeholder'=>'Content Name' )) !!}
                                        <span class="error-title"></span>
                                        @if ($errors->first('content_name'))
                                            <span class="help-block">{!! $errors->first('content_name') !!}</span>
                                        @endif
                                    </div>
                                </td>
                            </div>

                            {{--CONTENT DESCRIPTION--}}
                            <div class="control-group {!! $errors->has('content_desc') ? 'has-error' : '' !!}">
                                <td></td>
                                <td colspan="4">
                                    <div class="controls">
                                        {!! Form::hidden('allcontent['.$it_count.'][content_desc]', $contentdata['content_desc'], array('rows' => 3, 'class'=>'form-control', 'placeholder'=>'Content Description' )) !!}
                                        @if ($errors->first('content_desc'))
                                            <span class="help-block">{!! $errors->first('content_desc') !!}</span>
                                        @endif
                                    </div>
                                </td>
                            </div>
                        </tr>

                        <tr>
                            <td>
                            {{--CONTENT IMAGE--}}
                           <!--  -->
                           <div class="row fileinput fileinput-new control-group {!! $errors->has('image') ? 'has-error' : '' !!}" data-provides="fileinput" style="display: block;">
                               
                                <div class="col-md-8">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img data-src="" {!! (($content) ? "src='".url('uploads/content/' . $contentdata['content_image'])."'" : null) !!} alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                <input type="file" name="allcontent[<?php echo $it_count; ?>][content_image]" class="form-control" placeholder="Image" value="<?php echo $contentdata['content_image']; ?>" >
                                                @if ($errors->first('image'))
                                                    <span class="help-block">{!! $errors->first('image') !!}</span>
                                                @endif
                                            </span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <br>

                            </div>
                                {!! Form::hidden('allcontentOld['.$it_count.'][content_imageOld]', $contentdata['content_image']) !!}

                                </td>
                            </div>
                            <td> </td>
                        </tr>

                        <?php $it_count++; ?>

                    </tbody>
                </table>
                @endforeach

                
            </div>
            {{--Content--}}
        </div>



        @else



        {{--CONTENTS--}}
        <div class="row">
            <div class="col-md-2"><label class="control-label" for="title">Contents</label></div>
            <div class="col-md-8">

                <?php $it_count = 0;
                $count = count($content); ?>
                @foreach($content->content as $contentdata)
                    
                <table class="table table-striped well table-content">

                    <tbody>
                        <tr>
                            {{-- CONTENT NAME --}}
                            <div class="control-group {!! $errors->has('content_name') ? 'has-error' : '' !!}">
                                <td><label class="control-label" for="content_name">Content Name:</label></td>
                                <td>
                                    <div class="contentname controls">
                                        {!! Form::text('allcontent['.$it_count.'][content_name]', $contentdata['content_name'], array('class'=>'form-control', 'placeholder'=>'Content Name' )) !!}
                                        <span class="error-title"></span>
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
                                        {!! Form::textarea('allcontent['.$it_count.'][content_desc]', $contentdata['content_desc'], array('rows' => 3, 'class'=>'form-control', 'placeholder'=>'Content Description' )) !!}
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
                                            
                                     <input type="file" name="allcontent[<?php echo $it_count; ?>][content_image]" class="form-control" placeholder="Image" value="<?php echo $contentdata['content_image']; ?>" >
                                     <!-- {!! Form::file('images['.$it_count.']')  !!} -->
                                     <br/>
                                    <span class="content-thumb"><?php echo $contentdata['content_image']; ?> </span>
                                    
                            
                                {!! Form::hidden('allcontentOld['.$it_count.'][content_imageOld]', $contentdata['content_image']) !!}

                                </td>
                            </div>
                            <td><a href="#/" class="btn btn-danger content_del ">Remove</a> </td>
                        </tr>

                        <?php $it_count++; ?>

                    </tbody>
                </table>
                @endforeach

                <a href="#/" class="btn btn-primary" id="add-content">Add New</a>
            </div>
            {{--Content--}}
        </div>
        @endif 
        {!! Form::submit('Update', array('class' => 'btn btn-success')) !!}
        {!! Form::close() !!}
    </div>
    <script>
         window.onload = function () {
            CKEDITOR.replace('intro');
        };
    </script>


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