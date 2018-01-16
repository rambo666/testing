@extends('backend/layout/layout')
@section('content')

  <section class="content-header">
        <h1> Region <small> | Control Panel</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">Region</li>
        </ol>
    </section>
    <br>


    <div class="container">
        <div class="col-lg-10">

            @include('flash::message')

            <br>

            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{!! langRoute('admin.region.create') !!}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Region
                    </a>
                </div>
            </div>
            <br> <br> <br>
            @if($regions->count())

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                           
                            <th>Destination</th>
                            <th>Activity</th>
                             <th>Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($regions as $key=>$region)
                            <tr>
                               <td>{!! $sno++ !!}</td>
                                {{--TITLE--}}
                                <td>
                                    {!! link_to_route( getLang() . '.admin.region.show', $region->title,
                                   $region->id, array( 'class' => 'btn btn-link btn-xs' )) !!}
                                </td>
                                

                                {{--Destination--}}
                                <td>
                                    {!! $destinations[$regions[$key]['destination_id']]  !!}
                                </td>
                                {{--Activity--}}
                                <td>
                                    {!! $activities[$regions[$key]['activity_id']]  !!}
                                </td>

                                {{--DESC--}}
                                <td>
                                     <img src="{!! url('uploads/region/' . $regions[$key]['image_path']) !!}" height="50">
                                </td>
                                {{--ACTIONS--}}
                                <td>
                                    <div class="btn-group">
                                        {{--Action button--}}
                                        <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
                                            Action <span class="caret"></span> </a>
                                        <ul class="dropdown-menu">
                                            {{--Show Category--}}
                                            <li>
                                                <a href="{!! langRoute('admin.region.show', array($region->id)) !!}">
                                                    <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Show Region </a>
                                            </li>
                                            <li class="divider"></li>

                                            {{--Edit Category--}}
                                            <li>
                                                <a href="{!! langRoute('admin.region.edit', array($region->id)) !!}">
                                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Region
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            {{--Delete Category--}}
                                            <li>
                                                <a href="{!! URL::route('admin.region.delete', array($region->id)) !!}">
                                                    <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Delete region </a>
                                            </li>
                                            

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif
           {!! $regions->appends(['search' => Input::get('search')])->render() !!}

        </div>
    </div>
      <br>   <br>   <br>   <br>   <br>   <br>   
@stop