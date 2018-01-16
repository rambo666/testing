{{--Show single package category--}}
@extends('backend/layout/layout')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Package Category
        <small> | Show Package Category</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! langRoute('admin.packagecategory.index') !!}"><i class="fa fa-list"></i> Package Category</a></li>
        <li class="active">Show Package Category</li>
    </ol>
</section>
<br>
<br>
<div class="container">
    <div class="pull-left">
        <div class="btn-toolbar">
            <a href="{!! langRoute('admin.packagecategory.index') !!}"
               class="btn btn-primary">
                <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
            </a>
        </div>
    </div>
    <br>
    <br>
    <br>
    <table class="table table-striped">
        <tbody>
            <tr>
                <td><strong>Name</strong></td>
                <td>{!! $packageCategory->name !!}</td>
            </tr>
            <tr>
                <td><strong>Description</strong></td>
                <td>{!! $packageCategory->description !!}</td>
            </tr>
        </tbody>
    </table>
</div>
</div>
</div>
@stop