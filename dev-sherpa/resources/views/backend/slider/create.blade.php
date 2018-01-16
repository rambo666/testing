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

    <h1> Slider
        <small> | Add Slider</small>
    </h1>
    <ol class="breadcrumb">

        <li><a href="{!! url(getLang(). '/admin/slider') !!}"><i class="fa fa-tint"></i> Slider</a></li>
        <li class="active">Add Slider</li>
    </ol>
</section>
<br>
<br>



<div class="container">
    <div class="col-lg-10">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="{!! langRoute('admin.slider.index') !!}"
                   class="btn btn-primary"> <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back </a>
            </div>
        </div>
        <br> <br> <br>


        {!! Form::open(array('action' => '\Fully\Http\Controllers\Admin\SliderController@store', 'files'=>true)) !!}
        <!-- Title -->
        <div class="control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label class="control-label" for="title">Title</label>

            <div class="controls">
                {!! Form::text('title', null, array('onKeyUp'=>'titletoCount("{CHAR} characters remaining",25)','maxlength' => '25','class'=>'form-control', 'id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}
                @if ($errors->first('title'))
                <span class="help-block">{!! $errors->first('title') !!}</span>
                @endif
                <span id="titlecount">25 characters remaining</span>
            </div>
        </div>
        <br>

        <!-- Description -->
        <div class="control-group {!! $errors->has('description') ? 'has-error' : '' !!}">
            <label class="control-label" for="description">Description</label>

            <div class="controls">
                {!! Form::textarea('description', null, array('onKeyUp'=>'toCount("{CHAR} characters remaining",80)','maxlength' => '80','class'=>'form-control', 'id' => 'description', 'placeholder'=>'Description', 'value'=>Input::old('description'))) !!}
                @if ($errors->first('description'))
                <span class="help-block">{!! $errors->first('description') !!}</span>
                @endif
                <span id="count">80 characters remaining</span>
            </div>
        </div>
        <br>
   
        <!-- Image -->
        <div class="fileinput fileinput-new control-group {!! $errors->has('image') ? 'has-error' : '' !!}" data-provides="fileinput">
            @include('flash::message')
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
            <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span> {!! Form::file('image', null, array('class'=>'form-control', 'id' => 'image', 'placeholder'=>'Image', 'value'=>Input::old('image'))) !!}
          @if ($errors->first('image')) <span class="help-block">{!! $errors->first('image') !!}</span> @endif </span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a></div>
        </div>
        <br>
        <br>

        <!-- Form actions -->
        {!! Form::submit('Create', array('class' => 'btn btn-success')) !!}
        {!! Form::close() !!}
    </div>
</div>
<script type="text/javascript">
function toCount(text,characters) {  
    var entranceObj=document.getElementById('description');  
    var exitObj=document.getElementById('count');  
    var length=characters - entranceObj.value.length;  
    if(length <= 0) {  
    length=0;  
    text='<span class="disable"> '+text+' <\/span>';  
    entranceObj.value=entranceObj.value.substr(0,characters);  
    }  
    exitObj.innerHTML = text.replace("{CHAR}",length);  
    }

function titletoCount(text,characters) {  
    var entranceObj=document.getElementById('title');  
    var exitObj=document.getElementById('titlecount');  
    var length=characters - entranceObj.value.length;  
    if(length <= 0) {  
    length=0;  
    text='<span class="disable"> '+text+' <\/span>';  
    entranceObj.value=entranceObj.value.substr(0,characters);  
    }  
    exitObj.innerHTML = text.replace("{CHAR}",length);  
    }
    </script>
@stop