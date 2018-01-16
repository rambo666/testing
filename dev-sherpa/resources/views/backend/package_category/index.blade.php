@extends('backend/layout/layout')
@section('content')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#notification').show().delay(4000).fadeOut(700);
        });
    </script>
    <section class="content-header">
        <h1> Package Category
            <small> | Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! url(getLang(). '/admin') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Package Category</li>
        </ol>
    </section>
    <br>

    <div class="container">
        <div class="col-lg-10">
            @include('flash::message')
            <br>

            <div class="pull-left">
                <div class="btn-toolbar"><a href="{!! langRoute('admin.packagecategory.create') !!}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Package Category </a></div>
            </div>
            <br> <br> <br>
            @if($packageCategories->count())
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $packageCategories as $category )
                            <tr>
                                {{--Name--}}
                                <td> {!! link_to_route( getLang() . '.admin.packagecategory.show', $category->name,
                                    $category->id, array( 'class' => 'btn btn-link btn-xs' )) !!} {{--try by slug : $category->slug--}}
                                </td>

                                {{--Actions--}}
                                <td>
                                    <div class="btn-group">
                                        {{--Action button--}}
                                        <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
                                            Action <span class="caret"></span> </a>
                                        <ul class="dropdown-menu">
                                            {{--Show Category--}}
                                            <li>
                                                <a href="{!! langRoute('admin.packagecategory.show', array($category->id)) !!}">
                                                    <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Show Category </a>
                                            </li>
                                            <li class="divider"></li>

                                            {{--Edit Category--}}
                                            <li>
                                                <a href="{!! langRoute('admin.packagecategory.edit', array($category->id)) !!}">
                                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Category
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            {{--Delete Category--}}
                                            <li>
                                                <a href="{!! URL::route('admin.packagecategory.delete', array($category->id)) !!}"> {{-- @see routes.php --}}
                                                    <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Delete Category </a>
                                            </li>
                                            <li class="divider"></li>

                                            {{--View On Site--}}
                                            <li>
                                                <a target="_blank" href="{!! URL::route('dashboard.packagecategory', ['slug' => $category->slug]) !!}">
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
            @else
                <div class="alert alert-danger">No results found</div>
            @endif
        </div>
    </div>
@stop