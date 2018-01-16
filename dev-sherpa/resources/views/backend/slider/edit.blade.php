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
        <small> | Update Slider</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang(). '/admin/slider') !!}"><i class="fa fa-tint"></i> Slider</a></li>
        <li class="active">Update Slider</li>
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


        {!! Form::open( array( 'route' => array( getLang() . '.admin.slider.update', $slider->id), 'method' => 'PATCH', 'files'=>true)) !!}

        <!-- Title -->
        <div class="control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label class="control-label" for="title">Title</label>

            <div class="controls">
                {!! Form::text('title', $slider->title, array('onKeyUp'=>'titletoCount("{CHAR} characters remaining",25)','maxlength' => '25','class'=>'form-control', 'id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}
                @if ($errors->first('title'))
                <span class="help-block">{!! $errors->first('title') !!}</span>
                @endif
                <span id="titlecount"></span>
            </div>
        </div>
        <br>

        <!-- Description -->
        <div class="control-group {!! $errors->has('description') ? 'has-error' : '' !!}">
            <label class="control-label" for="description">Description</label>

            <div class="controls">
                {!! Form::textarea('description', $slider->description, array('onKeyUp'=>'toCount("{CHAR} characters remaining",80)','maxlength' => '80','class'=>'form-control', 'id' => 'description', 'placeholder'=>'Description', 'value'=>Input::old('description'))) !!}
                @if ($errors->first('description'))
                <span class="help-block">{!! $errors->first('description') !!}</span>
                @endif
                <span id="count"></span>
            </div>
        </div>
        <br>

        <!-- Image -->
        <div class="fileinput fileinput-new control-group {!! $errors->has('image') ? 'has-error' : '' !!}" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                <img data-src="" {!! (($slider->path) ? "src='".url($slider->path)."'" : null) !!} alt="...">
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
            <br>

        <!-- Form actions -->
        {!! Form::submit('Update', array('class' => 'btn btn-success')) !!}
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


    function counted() {  
        var entranceObj=document.getElementById('description').value.length;
        var cal =  80-entranceObj;
        document.getElementById("count").innerHTML = cal+" characters remaining";
        //console.log(entranceObj);
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


    function titlecounted() {  
        var entranceObj=document.getElementById('title').value.length;
        var cal =  25-entranceObj;
        document.getElementById("titlecount").innerHTML = cal+" characters remaining";
        //console.log(entranceObj);
    }


    window.onload = function() {
      
      counted();
      titlecounted();
    };
    </script>
@stop