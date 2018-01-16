<?php // echo '<pre>'; print_r($testimonials); echo '</pre>'; die; ?>
@extends('backend/layout/layout')
@section('content')
    <script type="text/javascript">
        $(document).ready(function () {

            $('#notification').show().delay(4000).fadeOut(700);

            // publish settings
            $(".publish").bind("click", function (e) {
                var id = $(this).attr('id');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{!! url(getLang() . '/admin/testimonial/" + id + "/toggle-publish/') !!}",
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    },
                    success: function (response) {
                        if (response['result'] == 'success') {
                            var imagePath = (response['changed'] == 1) ? "{!!url('/')!!}/assets/images/publish.png" : "{!!url('/')!!}/assets/images/not_publish.png";
                            $("#publish-image-" + id).attr('src', imagePath);
                        }
                    },
                    error: function () {
                        alert("error");
                    }
                })
            });
        });
    </script>
    <section class="content-header">
        <h1> Testimonial
            <small> | Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! url(getLang() . '/admin') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Testimonial</li>
        </ol>
    </section>
    <br>

    <div class="container">
        <div class="col-lg-10">
            @include('flash::message')
            <br>

            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{!! langRoute('admin.testimonial.create') !!}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Testimonial </a>
                </div>
            </div>
            <br> <br> <br>
            @if(count($testimonials))

                <div class="">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Person Name</th>
                            <th>Person Address</th>
                            <th>Review</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $testimonials as $testimonial )
                            <tr>
                                <td>
                                    <a href="{!! langRoute('admin.testimonial.show', $testimonial['id']) !!}" class="btn btn-link btn-xs">
                                        {!! $testimonial['person_name']!!} </a>
                                </td>
                                <td>{!! $testimonial['person_address']!!}</td>
                                <td>{!! $testimonial['review']!!}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
                                            Action <span class="caret"></span> </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{!! langRoute('admin.testimonial.show', $testimonial['id']) !!}">
                                                    <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Show Testimonial
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{!! langRoute('admin.testimonial.edit', $testimonial['id']) !!}">
                                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Testimonial
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="{!! URL::route('admin.testimonial.delete', $testimonial['id']) !!}">
                                                    <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Delete
                                                    Testimonial </a>
                                            </li>
                                            <li class="divider"></li>
                                            {{--<li>--}}
                                                {{--<a target="_blank" href="{!! URL::route('dashboard.testimonial.show', ['slug' => $testimonial['slug']]) !!}">--}}
                                                    {{--<span class="glyphicon glyphicon-eye-open"></span>&nbsp;View On Site--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                        </ul>
                                    </div>
                                </td>
                                {{--<td>--}}
                                    {{--<a href="#" id="{!! $testimonial['id']!!}" class="publish">--}}
                                        {{--<img id="publish-image-{!! $testimonial['id']!!}" src="{!! url('/') !!}/assets/images/{!! ($testimonial['is_published']) ? 'publish.png' : 'not_publish.png'  !!}"/>--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger">No results found</div>
               
            @endif
            {!! $testimonials->appends(['search' => Input::get('search')])->render() !!}
        </div>
        <div class="pull-left">
            <ul class="pagination">
                {{--{!! $testimonials['render']() !!}--}}
            </ul>
        </div>
    </div>
@stop