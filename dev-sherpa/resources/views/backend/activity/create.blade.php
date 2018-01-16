@extends('backend.layout.layout')

@section('content')
    {!! HTML::style('dropzone/css/basic.css') !!}
    {!! HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
    {!! HTML::style('dropzone/css/dropzone.css') !!}
    {!! HTML::script('dropzone/dropzone.js') !!}
    {!! HTML::script('ckeditor/ckeditor.js') !!}
    {!! HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js') !!}

    {{--PAGE HEADER--}}
    <section class="content-header">
        <h1> Activity <small> | Add Activity</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route(getLang() . '.admin.activity.index') !!}"><i class="fa fa-bus"></i> Activity</a>
            </li>
            <li class="active">Add Activity</li>
        </ol>
    </section>
    <br>
    <br>

        <div class="container">
        {!! Form::open(array('action' => '\Fully\Http\Controllers\Admin\ActivityController@store', 'files' => true)) !!}

            {{--TITLE--}}
            <div class="row control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                <div class="col-md-2"><label class="control-label" for="title">Title: </label></div>

                <div class="controls col-md-8">
                    {!! Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter activity title', 'value' => Input::old('title'))) !!}
                    @if($errors->first('title'))
                        <span class="help-block">{!! $errors->first('title') !!}</span>
                        @endif
                </div>
            </div>
            <br>

            {{--DESCRIPTION--}}
            <div class="row control-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                <div class="col-md-2"><label class="control-label" for="description">Description: </label></div>

                <div class="controls col-md-8">
                    {!! Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'placeholder' => 'Enter activity description', 'value' => Input::old('description'))) !!}
                    @if($errors->first('description'))
                        <span class="help-block">{!! $errors->first('description') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            {{--DESTINAIIONS--}}
            <div class="row control-group {!! $errors->has('destination') ? 'has-error' : '' !!}">
                <div class="col-md-2"><label class="control-label" for="destination">Destination: </label></div>

                <div class="controls col-md-8">
                    {!! Form::select('destination', $destinations, null, array('class' => 'form-control', 'value'=>Input::old('destination'))) !!}
                    @if($errors->first('destination'))
                        <span class="help-block">{!! $errors->first('destination') !!}</span>
                    @endif
                </div>
            </div>
            <br>


            {{--IMAGE--}}
            <div class="fileinput fileinput-new row control-group {!! $errors->has('image') ? 'has-error' : '' !!}" data-provides="fileinput" style="display: block;">
                <div class="col-md-2"><label class="control-label" for="image">Activity Image: </label></div>
                <div class="col-md-8">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                    <div>
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>

                            {!! Form::file('image', null, array('class'=>'form-control', 'id' => 'image', 'placeholder'=>'Image', 'value'=>Input::old('image'))) !!}

                            @if ($errors->first('image'))
                                <span class="help-block">{!! $errors->first('image') !!}</span>
                            @endif
                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
            </div>
            <br>

            {{--META DATA--}}
            <div class="row">
                <div class="col-md-10 panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#packageMetaData" data-parent="#accordian" data-toggle="collapse">
                                <span class="glyphicon glyphicon-th-list"> META DATA</span>
                            </a>
                        </h4>
                    </div> <!-- /.panel-heading -->

                    <div id="packageMetaData" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">

                                    {{-- Meta Keywords--}}
                                    <div class="control-group">
                                        <label for="meta_keywords" class="control-label">Meta Keywords</label>

                                        <div class="controls">
                                            {!! Form::textarea(
                                                'meta_keywords', null,
                                                array('rows' => 3, 'class'=>'form-control', 'id' => 'meta_keywords', 'placeholder' => 'Meta Keywords')
                                            ) !!}
                                            @if ($errors->first('meta_keywords'))
                                                <span class="help-block">{!! $errors->first('meta_keywords') !!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                </div  >

                                <div class="col-md-6">
                                    <div class="control-group">
                                        <label for="meta_description" class="control-label">Meta Description</label>

                                        <div class="controls">
                                            {!! Form::text('meta_description', null,
                                                            array('class' => 'form-control', 'id' => 'meta_description', 'placeholder' => 'Meta Description' )) !!}
                                            @if ($errors->first('meta_description'))
                                                <span class="help-block">{!! $errors->first('meta_description') !!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- /.panel -->
            </div>
            <br>

            {{--SUBMIT--}}
            <div class="row">
                <div class="col-md-10">
                    {!! Form::submit('Add Activity', array('class' => 'btn btn-success')) !!}
                </div>
            </div>

        {!! Form::close() !!}
        </div>
        {{--.container--}}
         <script type="text/javascript">
           window.onload = function () {
               CKEDITOR.replace('description', {
                   "filebrowserBrowseUrl"  : "{!! url('filemanager/show') !!}",
                   height                  : '50%'
               });
               
           };
</script>
@stop
