@extends('backend/layout/layout')

@section('content')

    <section class="content-header">
        <h1> Destination <small> | Control Panel</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">Destination</li>
        </ol>
    </section>
    <br>


    <div class="container">
        <div class="col-lg-10">

            @include('flash::message')

            <br>
            <div id="msg"></div>
            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{!! langRoute('admin.destination.create') !!}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Destination
                    </a>
                </div>
            </div>
            <br> <br> <br> 
            @if($destinations->count())

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ordering</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($destinations as $destination)
                            <tr>
                               <td>{!! $sno++ !!}</td>
                                <td>
                                    {!! Form::hidden('desID', $destination->id,array('class' => 'form-control','id'=>'desID')) !!}
                                    {!! Form::select('destination', $counts, $destination->ordering, array('onchange'=>'fetch_select(this.value,' . $destination->id . ')','class' => 'form-control', 'value'=>Input::old('destination'))) !!}
                               
                            </td>
                                {{--TITLE--}}
                                <td>
                                    {!! link_to_route( getLang() . '.admin.destination.show', $destination->title,
                                   $destination->id, array( 'class' => 'btn btn-link btn-xs' )) !!}
                                </td>
                                {{--DESC--}}
                                <td>
                                    {!! substr($destination->description, 0, 50) !!}
                                </td>

                                {{--IMAGE--}}
                                <td>
                                    <img src="{!! url('uploads/destination/' . $destination->image_path) !!}" height="50">
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
                                                <a href="{!! langRoute('admin.destination.show', array($destination->id)) !!}">
                                                    <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Show Category </a>
                                            </li>
                                            <li class="divider"></li>

                                            {{--Edit Category--}}
                                            <li>
                                                <a href="{!! langRoute('admin.destination.edit', array($destination->id)) !!}">
                                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Category
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            {{--Delete Category--}}
                                            <li>
                                                <a href="{!! URL::route('admin.destination.delete', array($destination->id)) !!}">
                                                    <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Delete Category </a>
                                            </li>
                                            

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif
        {!! $destinations->appends(['search' => Input::get('search')])->render() !!}
        </div>
    </div>
    <script type="text/javascript">
                function fetch_select(val,id)
                {
                    
                  //var id= document.getElementById("desID").value;
                    //console.log(id);
                 $.ajax({
                
                 url: "{{URL::to('en/admin/destination/changeOrdering')}}",
                 headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                 data: {
                  option:val,
                  id:id
                 },
                 success: function (response) {
                   $("#msg").append('<div class="msg-save" style="float:right; color:red;">Saved!</div>');
                            $('.msg-save').delay(10).fadeOut(3000);
                 }
                 });
                }

              
        </script>
@stop