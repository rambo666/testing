@extends('backend/layout/layout')
@section('content')

    <script type="text/javascript">
        $(document).ready(function () {

            $('#notification').show().delay(4000).fadeOut(700); // views/flash/message.blade.php for notfication at top right
            $(".publish").bind("click", function (e) {
                var id = $(this).attr('id');
                e.preventDefault();

                $.ajax({
                  type:"POST",
                    url:"{!! url(getLang() . '/admin/package/" + id + "/toggle-publish/' ) !!}", // /admin/package/3/toggle-publish/ @ PackageController > togglePublish
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
                      alert('Something error occurred. Please try again!!');
                    }
                })
            })
        });
    </script>
    <section class="content-header">
        <h1> Package
            <small> | Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! url(getLang() . '/admin') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Package</li>
        </ol>
    </section>
    <br>

    <div class="container">
        <div class="col-lg-10">
            @include('flash::message')
            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{!! langRoute('admin.package.create') !!}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Package
                    </a>
                </div>
            </div>

            @if($packages)
                <div class="">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Destination</th>
                                <th>Activity</th>
                                <th>Region</th>
                                <th>Actions</th>
                                {{--<th>Settings</th>--}}
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($packages as $key=>$package)
                            <tr>
                                <td>{!! $sno++ !!}</td>
                                <td>
                                    <a href="{!! langRoute('admin.package.show', array($package->id)) !!}" class="btn btn-link btn-xs">{!!  $package->title !!}</a>
                                </td>
                               {{--Destination--}}
                               <td>{!! $destinations[$package['destination_id']]  !!} </td>

                               {{--Activity--}}
                               <td>{!! $activities[$package['activity_id']]  !!}</td>

                               {{--Region--}}
                               <td>{!! $regions[$package['region_id']]  !!}</td>

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
                                {{--<td>--}}
                                    {{--<a href="http://google.com" id="{!! $package->id !!}" class="publish" target="_blank">--}}
                                        {{--<img id="publish-image-{!! $package->id !!}" src="{!! url('/') !!}/assets/images/{!! ($package->is_published) ? 'publish.png' : 'not_publish.png'  !!}"/>--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                @endif


        <!--pagination-->
        {!! $packages->appends(['search' => Input::get('search')])->render() !!}
        <br/>
        <br/>
        

        </div>
    </div>
@stop