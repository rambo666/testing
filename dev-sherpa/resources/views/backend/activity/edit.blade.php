@extends('backend/layout/layout')
@section('content')
    {!! HTML::style('dropzone/css/basic.css') !!}
    {!! HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
    {!! HTML::style('dropzone/css/dropzone.css') !!}
    {!! HTML::script('dropzone/dropzone.js') !!}
    {!! HTML::script('ckeditor/ckeditor.js') !!}
    {!! HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Activity
            <small> | Edit Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! url(getLang(). '/admin/activity') !!}"><i class="fa fa-list"></i> Activity</a></li>
            <li class="active">Edit Activity</li>
        </ol>
    </section>
    <br>
    <br>
    <div class="container">

        {!! Form::open(array( 'route' => array(getLang() . '.admin.activity.update', $activity->id), 'method' => 'PATCH', 'files' =>true )) !!}

        {{--TITLE--}}
        <div class="row control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <?php //var_dump($errors); die();?>
            <div class="col-md-2">
                {!! Form::label('title', 'Title', array('class' => 'control-label')) !!}
            </div>

            <div class="controls col-md-8">
                {!! Form::text('title', $activity->title, array('class'=>'form-control', 'id' => 'title', 'placeholder'=>'Activity Title', 'value'=>Input::old('title'))) !!}
                @if ($errors->first('title'))
                <span class="help-block">{!! $errors->first('title') !!}</span>
                @endif
            </div>

        </div>
        <br>


        {{--DESCRIPTION--}}
        <div class="row control-group" {!! $errors->has('description') ? 'error' : '' !!}>
            <div class="col-md-2">
                {!! Form::label('description', 'Description', array('class' => 'control-label')) !!}
            </div>

            <div class="controls col-md-8">
                {!! Form::textarea('description', $activity->description, array('class' => 'form-control', 'id'=>'description')) !!}

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
               <!--  {!! Form::select('destination', $destinations, $activity->destination_id, array('class' => 'form-control', 'value'=>Input::old('destination'))) !!}
                @if($errors->first('destination'))
                <span class="help-block">{!! $errors->first('destination') !!}</span>
                @endif -->
                 {!! Form::text('dummyDestination', $destinations[$activity->destination_id], array('readonly' => 'true','class' => 'form-control', 'value'=>Input::old('destination'))
                            ) !!}
                            {!! Form::hidden('destination',  $activity->destination_id, array('class' => 'form-control', 'value'=>Input::old('destination'))
                            ) !!}
                            @if ($errors->first('destination'))
                                <span class="help-block">{!! $errors->first('destination') !!}</span>
                            @endif
                         
            </div>
        </div>
        <br>

        {{--IMAGE--}}
        <div class="row fileinput fileinput-new control-group {!! $errors->has('image') ? 'has-error' : '' !!}" data-provides="fileinput" style="display: block;">
            <div class="col-md-2"><label class="control-label" for="description">Activity Image: </label></div>
            <div class="col-md-8">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img data-src="" {!! (($activity->image) ? "src='".url('uploads/activity/' . $activity->image)."'" : null) !!} alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
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

        </div>

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
                                        'meta_keywords', $activity->meta_keywords,
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
                                        {!! Form::text('meta_description', $activity->meta_description,
                                        array('class' => 'form-control', 'id' => 'meta_description' )) !!}
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


        <!-- Form actions -->
        <div class="row">
            <div class="col-md-10">
                {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!} &nbsp;&nbsp;&nbsp;
                <a href="{!! langRoute('admin.activity.index') !!}" class="btn btn-default">&nbsp;Cancel</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    
    <script type="text/javascript">
           window.onload = function () {
               CKEDITOR.replace('description', {
                   "filebrowserBrowseUrl"  : "{!! url('filemanager/show') !!}",
                   height                  : '50%'
               });
           };
        </script>

    @stop