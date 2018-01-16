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
        <h1> Testimonial <small> | Edit Testimonial</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route(getLang() . '.admin.testimonial.index') !!}"><i class="fa fa-bus"></i> Testimonial</a>
            </li>
            <li class="active">Edit Testimonial</li>
        </ol>
    </section>
    <br>
    <br>

    <div class="container">
        {!! Form::open( array( 'route' => array(getLang(). '.admin.testimonial.update', $testimonial->id), 'method' => 'PATCH')) !!}

        {{--Person Name--}}
        <div class="row control-group {!! $errors->has('person_name') ? 'has-error' : '' !!}">
            <div class="col-md-2"><label class="control-label" for="person_name">Person Name: </label></div>

            <div class="controls col-md-8">
                {!! Form::text('person_name', $testimonial->person_name, array('class' => 'form-control', 'id' => 'person_name', 'placeholder' => 'Enter Person Name', 'value' => Input::old('person_name'))) !!}
                @if($errors->first('person_name'))
                    <span class="help-block">{!! $errors->first('person_name') !!}</span>
                @endif
            </div>
        </div>
        <br>

        {{--Person Address--}}
        <div class="row control-group {!! $errors->has('person_address') ? 'has-error' : '' !!}">
            <div class="col-md-2"><label class="control-label" for="person_address">Person Address: </label></div>

            <div class="controls col-md-8">
                {!! Form::text('person_address', $testimonial->person_address, array('class' => 'form-control', 'id' => 'person_address', 'placeholder' => 'Enter Person Address', 'value' => Input::old('person_address'))) !!}
                @if($errors->first('person_address'))
                    <span class="help-block">{!! $errors->first('person_address') !!}</span>
                @endif
            </div>
        </div>
        <br>

        {{--DESCRIPTION--}}
        <div class="row control-group {!! $errors->has('review') ? 'has-error' : '' !!}">
            <div class="col-md-2"><label class="control-label" for="review">Review: </label></div>

            <div class="controls col-md-8">
                {!! Form::textarea('review', $testimonial->review, array('class' => 'form-control', 'id' => 'review', 'placeholder' => 'Enter review')) !!}
                @if($errors->first('review'))
                    <span class="help-block">{!! $errors->first('review') !!}</span>
                @endif
            </div>
        </div>
        <br>

        {{--SUBMIT--}}
        <div class="row">
            <div class="col-md-10">
                {!! Form::submit('Update', array('class' => 'btn btn-success')) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
    {{--.container--}}
    
    <script type="text/javascript">
           window.onload = function () {
               CKEDITOR.replace('review', {
                   "filebrowserBrowseUrl"  : "{!! url('filemanager/show') !!}",
                   height                  : '50%'
               });
           };
        </script>
@stop
