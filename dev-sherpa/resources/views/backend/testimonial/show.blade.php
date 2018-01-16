@extends('backend/layout/layout')
@section('content')
{!! HTML::style('ckeditor/contents.css') !!}
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Testimonial
        <small> | Show Testimonial</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! langRoute('admin.testimonial.index') !!}"><i class="fa fa-book"></i> Testimonial</a></li>
        <li class="active">Show Testimonial</li>
    </ol>
</section>
<br>
<br>
<div class="container">
    <div class="col-lg-10">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="{!! langRoute('admin.testimonial.index') !!}"
                   class="btn btn-primary"> <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back </a>
            </div>
        </div>
        <br> <br> <br>
        <table class="table table-striped">
            <tbody>
            <tr>
                <td><strong>Person Name: </strong></td>
                <td>{!! $testimonial->person_name !!}</td>
            </tr>
            <tr>
                <td><strong>Person Address</strong></td>
                <td>{!! $testimonial->person_address !!}</td>
            </tr>
            <tr>
                <td><strong>Review</strong></td>
                <td>{!! $testimonial->review !!}</td>
            </tr>
        </table>
    </div>
</div>
@stop
