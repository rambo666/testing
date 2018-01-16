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
                    url: "{!! url(getLang() . '/admin/content/" + id + "/toggle-publish/') !!}",
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
        <h1> Content
            <small> | Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! url(getLang() . '/admin') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Content</li>
        </ol>
    </section>
    <br>

    <div class="container">
        <div class="col-lg-10">
            @include('flash::message')
            <br>

           <!--  <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{!! langRoute('admin.content.create') !!}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Content </a>
                </div>
            </div> -->
            <br> <br> <br>
            @if($contents->count())
                <div class="">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Term</th>
                            <th>Intro</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $contents as $content )
                            <tr>
                                <td>
                                    <a href="{!! langRoute('admin.content.show', array($content->id)) !!}" class="btn btn-link btn-xs">
                                        {!! $content->title !!} </a>
                                </td>
                                <td>{!! $content->term !!}</td>
                                <td>{!! str_limit($content->intro, 100) !!}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
                                            Action <span class="caret"></span> </a>
                                        <ul class="dropdown-menu">
                                            {{--<li>--}}
                                                {{--<a href="{!! langRoute('admin.content.show', array($content->id)) !!}">--}}
                                                    {{--<span class="glyphicon glyphicon-eye-open"></span>&nbsp;Show Content--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                            <li>
                                                <a href="{!! langRoute('admin.content.edit', array($content->id)) !!}">
                                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Content
                                                </a>
                                            </li>
                                            <!-- <li class="divider"></li>
                                            <li>
                                                <a href="{!! URL::route('admin.content.delete', array($content->id)) !!}">
                                                    <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Delete
                                                    Content </a>
                                            </li> -->
                                           <!--  <li class="divider"></li> -->
                                            {{--<li>--}}
                                                {{--<a target="_blank" href="{!! URL::route('dashboard.content.show', ['slug' => $content->slug]) !!}">--}}
                                                    {{--<span class="glyphicon glyphicon-eye-open"></span>&nbsp;View On Site--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger">No results found</div>

            @endif
            {!! $contents->appends(['search' => Input::get('search')])->render() !!}
        </div>
        <div class="pull-left">
            <ul class="pagination">
{{--                {!! $contents->render() !!}--}}
            </ul>
        </div>
    </div>
@stop