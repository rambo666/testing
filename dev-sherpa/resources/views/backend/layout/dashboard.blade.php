@extends('backend/layout/layout')
@section('content')
{!! HTML::script('highcharts/highcharts.js') !!}
{!! HTML::script('highcharts/exporting.js') !!}
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Sherpa Guide Nepal</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    @include('flash::message')

    <br> <br>
    <h4>
        Latest Messages
    </h4>
    <div class="table-responsive">
        @if($formPosts->count())
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Action</th>
                    <th>Settings</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $formPosts as $formPost )
                    <tr>
                        <td>{!! $formPost->sender_name_surname !!}</td>
                        <td>{!! $formPost->sender_email !!}</td>
                        <td>{!! $formPost->subject !!}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
                                    Action
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{!! langRoute('admin.form-post.show', array($formPost->id)) !!}">
                                            <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Show Post
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{!! URL::route('admin.form-post.delete', array($formPost->id)) !!}">
                                            <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Delete Post
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <a href="#" id="{!! $formPost->id !!}" class="answer">
                                <img id="answer-image-{!! $formPost->id !!}" src="{!!url('/')!!}/assets/images/{!! ($formPost->is_answered) ? 'answered.png' : 'not_answered.png'  !!}"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        
    {!! $formPosts->appends(['search' => Input::get('search')])->render() !!}
    </div>
    <br> <br>
    <h4>
        Latest Packages
    </h4>
    <div class="table-responsive">

        @if($formPosts->count())

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                    {{--<th>Settings</th>--}}
                </tr>
                </thead>

                <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td>
                            <a href="{!! langRoute('admin.package.show', array($package->id)) !!}" class="btn btn-link btn-xs">{!! $package->title !!}</a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
                                    Action <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{!! langRoute('admin.package.show', array($package->id)) !!}">
                                            <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Show Package
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{!! langRoute('admin.package.edit', array($package->id)) !!}">
                                            <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Package
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{!! URL::route('admin.package.delete', array($package->id)) !!}">
                                            <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Delete Package </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a target="_blank" href="{!! URL::route('dashboard.package.show', ['slug' => $package->slug]) !!}">
                                            <span class="glyphicon glyphicon-eye-open"></span>&nbsp;View On Site
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif

    </div>
</section>

@stop