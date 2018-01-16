@extends('backend/layout/layout')
@section('content')
{!! HTML::style('assets/bootstrap/css/bootstrap-tagsinput.css') !!}
    {!! HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
    {!! HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
    {!! HTML::script('ckeditor/ckeditor.js') !!}
    {!! HTML::script('assets/bootstrap/js/bootstrap-tagsinput.js') !!}
    {!! HTML::script('assets/js/jquery.slug.js') !!}
    {!! HTML::script('assets/js/jquery.validate.min.js') !!}
   
  

    <script type="text/javascript">
        $(document).ready(function () {
            $("#title").slug();
        });
    </script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Region <small> | Add Region</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{!! url(getLang() . '/admin/region') !!}"><i class="fa fa-money"></i> Region</a></li>
            <li class="active">Add Region</li>
        </ol>
    </section>
    <br>
    <br>
    <div class="container">

            {{--FORM STARTS--}}
            {!! Form::open(array('action' => '\Fully\Http\Controllers\Admin\RegionController@store', 'files'=>true, 'id' => 'validate-form','enctype'=>'multipart/form-data')) !!}

                {{--Title--}}
                <div class="row control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                    <div class="col-md-2"><label for="title" class="control-label">Title:</label></div>

                    <div class="controls col-md-8">
                        {!! Form::text(
                                    'title', null,
                                    array('class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title')) !!} <!-- name, -->
                        @if ($errors->first('title'))
                            <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif

                    </div>
                </div> <!-- /.control-group -->
                <br>

                {{-- DESTINATIONS --}}
                <div class="row control-group {!! $errors->has('destination') ? 'has-error' : '' !!}">
                    <div class="col-md-2"><label for="destination" class="control-label">Destination:</label></div>

                    <div class="controls col-md-8">
                        {!! Form::select('destination',  $destinations, null,array('id'=>'destinations','placeholder' => ' --select a Destination-- ','class' => 'form-control','onchange'=>'fetch_select(this.value)')) !!}
                        @if ($errors->first('destination'))
                            <span class="help-block">{!! $errors->first('destination') !!}</span>
                        @endif
                    </div>
                </div> <!-- /.control-group -->
                <br>
                
                {{-- ACTIVITIES --}}
                <div class="row control-group {!! $errors->has('activity') ? 'has-error' : '' !!}">
                    <div class="col-md-2"><label for="activity" class="control-label">Activity:</label></div>

                    <div class="controls col-md-8">
                        
                            <div id ="selectActivity">{!! Form::select('activity',  $activities, null,array('id'=>'activitys','readonly' => 'true','placeholder' => ' --select an Activity-- ','class' => 'form-control')) !!}
                               <!--  {!! Form::text('activity', $activities,null,array('readonly' => 'true','class' => 'form-control')) !!} --></div>
                            
                            
                    </div>
                </div> <!-- /.control-group -->
                <br>

                
            {{--OBERVIEW--}}
                <div class="row control-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                    <div class="col-md-2"><label class="control-label" for="description">Overview: </label></div>

                    <div class="controls col-md-8">
                        {!! Form::textarea('overview', null, array('class' => 'form-control', 'id' => 'overview', 'placeholder' => 'Enter region description')) !!}
                        @if($errors->first('overview'))
                            <span class="help-block">{!! $errors->first('overview') !!}</span>
                        @endif
                    </div>
                </div>
                <br>


                 {{--IMAGE--}}
            <div class="fileinput fileinput-new row control-group {!! $errors->has('image') ? 'has-error' : '' !!}" data-provides="fileinput" style="display: block;">
                <div class="col-md-2"><label class="control-label" for="description">Region Image: </label></div>
                <div class="col-md-8">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                    <div>
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>

                            {!! Form::file('image', null, array('class'=>'form-control', 'id' => 'image', 'placeholder'=>'Image', 'value'=>Input::old('image'))) !!}

                            @if ($errors->first('image'))
                                <span class="help-block">{!! $errors->first('image') !!}</span>
                            @endif
                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
            </div>
            <br>

            {{--META DATA--}}
            <div class="row">
                <div class="col-md-10 panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#packageMetaData" data-parent="#accordian" data-toggle="collapse">
                                <span class="glyphicon glyphicon-th-list"> META DATA</span>
                            </a>
                        </h4>
                    </div> <!-- /.panel-heading -->

                    <div id="packageMetaData" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">

                                    {{-- Meta Keywords--}}
                                    <div class="control-group">
                                        <label for="meta_keywords" class="control-label">Meta Keywords</label>

                                        <div class="controls">
                                            {!! Form::textarea(
                                                'meta_keywords', null,
                                                array('rows' => 3, 'class'=>'form-control', 'id' => 'meta_keywords', 'placeholder' => 'Meta Keywords')
                                            ) !!}
                                            @if ($errors->first('meta_keywords'))
                                                <span class="help-block">{!! $errors->first('meta_keywords') !!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                </div  >

                                <div class="col-md-6">
                                    <div class="control-group">
                                        <label for="meta_description" class="control-label">Meta Description</label>

                                        <div class="controls">
                                            {!! Form::text('meta_description', null,
                                                            array('class' => 'form-control', 'id' => 'meta_description', 'placeholder' => 'Meta Description' )) !!}
                                            @if ($errors->first('meta_description'))
                                                <span class="help-block">{!! $errors->first('meta_description') !!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- /.panel -->
            </div>
            <br>

            {{-- Submit button --}}
                {!! Form::submit('Add Region', array('class' => 'btn btn-success')) !!}

            {!! Form::close() !!}
        <!-- Region insert form ends -->

        <script type="text/javascript">
//            window.onload = function () {
//                CKEDITOR.replace('overview', {
//                    "filebrowserBrowseUrl"  : "{!! url('filemanager/show') !!}",
//                    height                  : '50%'
//                });
//            };
   

            $(document).ready(function () {

                if ($('#tag').length != 0) {
                    var elt = $('#tag');
                    elt.tagsinput();
                }
            });
        </script>
        <script type="text/javascript">
                function fetch_select(val)
                {
                    //console.log(val);
                    

                 $.ajax({
                
                 url: '{{URL::to('en/admin/region/changeActivity')}}',
                 headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                 data: {
                  get_option:val
                  // getAct:inputAct
                 },
                 success: function (response) {
                  document.getElementById("selectActivity").innerHTML=response; 
                 }
                 });
                }


            
        </script>
        <script type="text/javascript">
         function fetch_selectChange(val)
                {
                    //console.log(val);
                    
                var inputAct = document.getElementById("activitys").value;
                    console.log(inputAct);
                 $.ajax({
                
                 url: '{{URL::to('en/admin/region/changeActivitySecond')}}',
                 headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                 data: {
                  get_option:val,
                  getAct:inputAct
                 },
                 success: function (response) {
                  document.getElementById("selectActivity").innerHTML=response; 
                 }
                 });
                }


           window.onload = function () {
                var input = document.getElementById("destinations").value;
                //console.log(input);
                fetch_selectChange(input);

               CKEDITOR.replace('overview', {
                   "filebrowserBrowseUrl"  : "{!! url('filemanager/show') !!}",
                   height                  : '50%'
               });
               
           };
</script>
    </div>
    @stop