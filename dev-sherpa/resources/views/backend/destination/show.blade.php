{{--Show single package category--}}
@extends('backend/layout/layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Destination
            <small> | Show Destination</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! langRoute('admin.destination.index') !!}"><i class="fa fa-list"></i> Destination</a></li>
            <li class="active">Show Destination</li>
        </ol>
    </section>
    <br>
    <br>
    <div class="container">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="{!! langRoute('admin.destination.index') !!}"
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
                <td>{!! $destination->title !!}</td>
            </tr>
            <tr>
                <td><strong>Description</strong></td>
                <td>{!! $destination->description !!}</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
@stop