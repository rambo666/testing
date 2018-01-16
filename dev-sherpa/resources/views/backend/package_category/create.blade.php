@extends('backend/layout/layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Package Category
        <small> | Add Package Category</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang(). '/admin/packagecategory') !!}"><i class="fa fa-list"></i> Package Category</a></li>
        <li class="active">Add Package Category</li>
    </ol>
</section>
<br>
<br>
<div class="container">

    {{--Insertion form--}}
    {!! Form::open(array('action' => '\Fully\Http\Controllers\Admin\PackageCategoryController@store' )) !!}

    <!-- NAME -->
    <div class="control-group {!! $errors->has('name') ? 'has-error' : '' !!}">
        {!! Form::label('name', 'Name', array('class' => 'control-label')) !!}

        <div class="controls">
            {!! Form::text('name', null, array('class'=>'form-control', 'id' => 'name', 'placeholder'=>'Package Category Name', 'value'=>Input::old('name'))) !!}
            @if ($errors->first('name'))
            <span class="help-block">{!! $errors->first('name') !!}</span>
            @endif
        </div>

    </div>
    <br>

    <!-- PARENT -->
    <div class="control-group {!! $errors->has('category') ? 'error' : '' !!}">
        {!! Form::label('category', 'Parent', array('class' => 'control-label')) !!}

        <div class="controls">
            {!! Form::select('parent_id', $packageCategories , null, array('class' => 'form-control', 'value'=>Input::old('category'))) !!}

            @if ($errors->first('category'))
                <span class="help-block">{!! $errors->first('category') !!}</span>
            @endif
        </div>
    </div>
    <br>

    <!-- DESCRIPTION -->
    <div class="control-group" {!! $errors->has('description') ? 'error' : '' !!}>
        {!! Form::label('description', 'Description', array('class' => 'control-label')) !!}

        <div class="controls">
            {!! Form::textarea('description', null, array('class' => 'form-control', 'value' => Input::old('description'))) !!}

            @if($errors->first('description'))
                <span class="help-block">{!! $errors->first('description') !!}</span>
            @endif
        </div>
    </div>
    <br>

    <!-- Form actions -->
    {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
    <a href="{!! langUrl('admin/category') !!}" class="btn btn-default">&nbsp;Cancel</a>
    {!! Form::close() !!}
</div>
@stop