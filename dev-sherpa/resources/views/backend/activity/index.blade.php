@extends('backend/layout/layout')

@section('content')

    <section class="content-header">
        <h1> Activity <small> | Control Panel</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">Activity</li>
        </ol>
    </section>
    <br>


    <div class="container">
        <div class="col-lg-10">

            @include('flash::message')

            <br>

            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{!! langRoute('admin.activity.create') !!}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Activity
                    </a>
                </div>
            </div>
            <br> <br> <br>
            @if($activities->count())

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Destination</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                 <td>{!! $sno++ !!}</td>
                                {{--TITLE--}}
                                <td>
                                    {!! link_to_route( getLang() . '.admin.activity.show', $activity->title,
                                   $activity->id, array( 'class' => 'btn btn-link btn-xs' )) !!}
                                </td>
                                {{--DESC--}}
                                <td>
                                    {!! substr($activity->description, 0, 50) !!}
                                </td>

                                {{--@foreach($activity->destinations as $destination)--}}
                                    {{--{{ $destination->title }}--}}
                                    {{--@endforeach--}}
                                {{--DESTINATION--}}
                                <td>
                                    {!! $destinations[$activity->destination_id]  !!}
                                </td>

                                {{--IMAGE--}}
                                <td>
                                    <img src="{!! url('uploads/activity/' . $activity->image) !!}" height="50">
                                </td>
                                {{--ACTIONS--}}
                                <td>
                                    <div class="btn-group">
                                        {{--Action button--}}
                                        <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
                                            Action <span class="caret"></span> </a>
                                        <ul class="dropdown-menu">
                                            {{--Show Activity--}}
                                            <li>
                                                <a href="{!! langRoute('admin.activity.show', array($activity->id)) !!}">
                                                    <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Show Activity </a>
                                            </li>
                                            <li class="divider"></li>

                                            {{--Edit Activity--}}
                                            <li>
                                                <a href="{!! langRoute('admin.activity.edit', array($activity->id)) !!}">
                                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Activity
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            {{--Delete Activity--}}
                                            <li>
                                                <a href="{!! URL::route('admin.activity.delete', array($activity->id)) !!}">
                                                    <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Delete Activity </a>
                                            </li>
                                           

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
 {!! $activities->appends(['search' => Input::get('search')])->render() !!}
            @endif
            
        <br/><br/><br/><br/><br/><br/>
        </div>
    </div>
@stop