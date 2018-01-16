@extends('backend/layout/layout')
@section('content')
    {!! HTML::style('ckeditor/contents.css') !!}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Package
            <small> | Show Package</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! langRoute('admin.package.index') !!}"><i class="fa fa-book"></i> Package</a></li>
            <li class="active">Show Package</li>
        </ol>
    </section>
    <br>
    <br>
    <div class="container">
        <div class="col-lg-10">
            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{!! langRoute('admin.package.index') !!}"
                       class="btn btn-primary"> <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back </a>
                </div>
            </div>
            <br> <br> <br>
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>{!! $package->title !!}</td>
                </tr>
                <tr>
                    <td><strong>Date Created</strong></td>
                    <td>{!! $package->created_at !!}</td>
                </tr>
                <tr>
                    <td><strong>Date Updated</strong></td>
                    <td>{!! $package->updated_at !!}</td>
                </tr>
                <tr>
                    <td><strong>Meta Keywords</strong></td>
                    <td>{!! $package->meta_keywords !!}</td>
                </tr>
                <tr>
                    <td><strong>Meta Description</strong></td>
                    <td>{!! $package->meta_description !!}</td>
                </tr>
                <tr>
                    <td><strong>Published</strong></td>
                    <td>{!! $package->is_published !!}</td>
                </tr>
                <tr>
                    <td><strong>Content</strong></td>
                    <td>{!! $package->overview !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
