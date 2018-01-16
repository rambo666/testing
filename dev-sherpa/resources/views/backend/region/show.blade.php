@extends('backend/layout/layout')
@section('content')
    {!! HTML::style('ckeditor/contents.css') !!}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> region
            <small> | Show region</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! langRoute('admin.region.index') !!}"><i class="fa fa-book"></i> region</a></li>
            <li class="active">Show region</li>
        </ol>
    </section>
    <br>
    <br>
    <div class="container">
        <div class="col-lg-10">
            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{!! langRoute('admin.region.index') !!}"
                       class="btn btn-primary"> <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back </a>
                </div>
            </div>
            <br> <br> <br>
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>{!! $region->title !!}</td>
                </tr>
                <tr>
                    <td><strong>Date Created</strong></td>
                    <td>{!! $region->created_at !!}</td>
                </tr>
                <tr>
                    <td><strong>Date Updated</strong></td>
                    <td>{!! $region->updated_at !!}</td>
                </tr>
                <tr>
                    <td><strong>Meta Keywords</strong></td>
                    <td>{!! $region->meta_keywords !!}</td>
                </tr>
                <tr>
                    <td><strong>Meta Description</strong></td>
                    <td>{!! $region->meta_description !!}</td>
                </tr>
               
                <tr>
                    <td><strong>Content</strong></td>
                    <td>{!! $region->overview !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
