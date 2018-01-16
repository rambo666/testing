@extends('backend/layout/layout')
@section('content')
<section class="content-header">
    <h1> Package Category <small> | Delete Package Category</small> </h1>
    <ol class="breadcrumb">
        <li><a href="{!! langRoute('admin.packagecategory.index') !!}"><i class="fa fa-list"></i> Package Category</a></li>
        <li class="active">Delete Package Category</li>
    </ol>
</section>
<br>
<br>
<br>
<div class="container">
    {!! Form::open( array( 'route' => array( getLang() . '.admin.packagecategory.destroy', $packageCategory->id ) ) ) !!}
    {!! Form::hidden( '_method', 'DELETE' ) !!}
    <div class="alert alert-warning">
        <div class="pull-left"><b> Be Careful!</b> Are you sure you want to delete Package Category: <b>{!! $packageCategory->name !!}</b> ?
        </div>
        <div class="pull-right">
            {!! Form::submit( 'Yes', array( 'class' => 'btn btn-danger' ) ) !!}
            {!! link_to( URL::previous(), 'No', array( 'class' => 'btn btn-primary' ) ) !!}
        </div>
        <div class="clearfix"></div>
    </div>
    {!! Form::close() !!}
</div>
@stop