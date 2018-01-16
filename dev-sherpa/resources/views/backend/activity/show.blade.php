{{--Show single package category--}}
@extends('backend/layout/layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Activity
            <small> | Show Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! langRoute('admin.activity.index') !!}"><i class="fa fa-list"></i> Activity</a></li>
            <li class="active">Show Activity</li>
        </ol>
    </section>
    <br>
    <br>
    <div class="container">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="{!! langRoute('admin.activity.index') !!}"
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
                <td><strong>Title</strong></td>
                <td>{!! $activity->title !!}</td>
            </tr>
            <tr>
                <td><strong>Description</strong></td>
                <td>{!! $activity->description !!}</td>
            </tr>
            <tr>
                <td><strong>Image</strong></td>
                <td><img src="{!! url('uploads/activity/' . $activity->image) !!}" height="250"></td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
@stop