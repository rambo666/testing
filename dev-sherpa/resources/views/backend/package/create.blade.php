<?php  //dd($errors->has('itinerary[0][daytitle]')); ?>
<?php  //dd($errors->has('incexc[inc][]')); ?>
@extends('backend/layout/layout')
@section('content')
    {!! HTML::style('assets/bootstrap/css/bootstrap-tagsinput.css') !!}
    {!! HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
    {!! HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
    {!! HTML::script('ckeditor/ckeditor.js') !!}
    {!! HTML::script('assets/bootstrap/js/bootstrap-tagsinput.js') !!}
    {!! HTML::script('assets/js/jquery.slug.js') !!}
    {!! HTML::script('assets/js/jquery.validate.min.js') !!}
   
   {!! HTML::script('assets/js/custom_package_create.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {
            $("#title").slug();
        });
    </script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Package <small> | Add Package</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{!! url(getLang() . '/admin/package') !!}"><i class="fa fa-money"></i> Package</a></li>
            <li class="active">Add Package</li>
        </ol>
    </section>
    <br>
    <br>
    <div class="container">

            {{--FORM STARTS--}}
            {!! Form::open(array('action' => '\Fully\Http\Controllers\Admin\PackageController@store', 'files'=>true, 'id' => 'validate-form')) !!}

                {{--Title--}}
                <div class="row control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                    <div class="col-md-2"><label for="title" class="control-label">Title:</label></div>

                    <div class="controls col-md-8">
                        {!! Form::text(
                                    'title', null,
                                    array('class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title'
                                    )) !!} <!-- name, -->
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
                        {!! Form::select('destination', $destinations, null, array('placeholder' => ' --select a Destination-- ','id'=>'destinationVal','onchange'=>'fetch_select(this.value)','class' => 'form-control', 'value' => Input::old('destination'))) !!}
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
                        
                        
                             <div id ="selectActivity">{!! Form::text('activity', null,array('id'=>'activityVal','readonly' => 'true','class' => 'form-control')) !!}</div>
                            
                    </div>
                </div> <!-- /.control-group -->
                <br>


                 {{-- REGIONS --}}
                <div class="row control-group {!! $errors->has('region') ? 'has-error' : '' !!}">
                    <div class="col-md-2"><label for="region" class="control-label">Region:</label></div>

                    <div class="controls col-md-8">
                        <!-- <select name='region' id="selectRegion" class = "form-control">
                                
                            </select> -->
                          <div id ="selectRegion">{!! Form::text('region', null,array('id'=>'regionVal','readonly' => 'true','class' => 'form-control')) !!}</div>
                       
                    </div>
                </div> <!-- /.control-group -->
                <br>
                
                {{--DAYS AND PRICE--}}
                <div class="row control-group {!! $errors->has('days') || $errors->has('price') ? 'has-error' : '' !!}">
                    <div class="col-md-2"><label for="days" class="control-label">Total Days:</label></div>

                    <div class="controls col-md-3">
                    {!! Form::text(
                                'days', null,
                                array('class' => 'form-control', 'id' => 'days', 'placeholder' => 'Total Days')) !!} <!-- name, -->

                        @if ($errors->first('days'))
                            <span class="help-block">{!! $errors->first('days') !!}</span>
                        @endif
                    </div>

                    <div class="col-md-2"><label for="price" class="control-label">Price:</label></div>

                    <div class="controls col-md-3">
                    {!! Form::text(
                                'price', null,
                                array('class' => 'form-control', 'id' => 'price', 'placeholder' => 'Price',
                                'value' => Input::old('price')
                                )) !!} <!-- name, -->

                        @if ($errors->first('price'))
                            <span class="help-block">{!! $errors->first('price') !!}</span>
                        @endif
                    </div>
                </div> <!-- /.control-group -->
                <br>

                {{-- SLIDER --}}
                <div class="row control-group {!! $errors->has('slider') ? 'has-error' : '' !!}">
                    <div class="col-md-2"><label for="slider" class="control-label">Slider images:</label></div>

                    <div class="controls col-md-4">
                        {!! Form::file('images[]', array('multiple'=>true, 'class' => 'form-control btn btn-default', 'id' => 'images') ) !!}
                        @if ($errors->first('images'))
                            <span class="help-block">{!! $errors->first('images') !!}</span>
                        @endif
                    </div>

                    <div class="controls col-md-4">
                        <label>
                            Is Popular? {!! Form::checkbox('is_popular', 'is_popular') !!}
                        </label>


                    </div> 

                    <div class="controls col-md-4">
                    <label>
                            Is Suggested? {!! Form::checkbox('is_suggested', 'is_suggested') !!}
                    </label></div>
                </div> <!-- /.control-group -->
                <br>

                <br>

                {{--OVERVIEW/ HIGHLIGHTS--}}
                <div class="row">
                    <div class="col-md-10 panel panel-default">

                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOverview"><span class="glyphicon glyphicon-th-list">
                                </span> OVERVIEW/ HIGHLIGHTS</a>
                            </h4>
                        </div>
                        <div id="collapseOverview" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Overview -->
                                        <div class="control-group {!! $errors->has('overview') ? 'has-error' : '' !!}">
                                            <label class="control-label" for="title">Overview</label>

                                            <div class="controls">
                                                {!! Form::textarea('overview', null, array('rows' => 3, 'class'=>'form-control', 'id' => 'overview', 'placeholder'=>'Overview', 'value'=>Input::old('overview'))) !!}
                                                @if ($errors->first('overview'))
                                                    <span class="help-block">{!! $errors->first('overview') !!}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>

                                        <!-- Highlights -->
                                        <div class="control-group {!! $errors->has('highlights') ? 'has-error' : '' !!}">
                                            <label class="control-label" for="title">Trip Highlights</label>

                                            <div class="controls">
                                                {!! Form::textarea('highlights', null, array('rows' => 3, 'class'=>'form-control', 'id' => 'highlights', 'placeholder'=>'Trip Highlights', 'value'=>Input::old('highlights'))) !!}
                                                @if ($errors->first('highlights'))
                                                    <span class="help-block">{!! $errors->first('highlights') !!}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--ITINERARY--}}
                <div class="row">
                    <div class="col-md-10 panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseItinerary"><span class="glyphicon glyphicon-th-list">
                                </span> ITINERARY</a>
                            </h4>
                        </div>
                        <div id="collapseItinerary" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped well table-itinerary">
                                            {{--<thead>--}}
                                                {{--<tr>--}}
                                                    {{--<td colspan="7"><button type="button" class="close" aria-label="Close"><span aria-hidden="true" class="close-itinerary">&times;</span></button></td>--}}
                                                {{--</tr>--}}
                                            {{--</thead>--}}
                                            <tbody>
                                        <!-- Day title -->
                                            <tr>

                                                <td><label class="control-label" for="daytitle">Day Title:</label></td>
                                                <td>
                                                    <div class="control-group {!! $errors->has('itinerary[0][daytitle]') ? 'has-error' : '' !!}">
                                                        <div class="controls">
                                                            {!! Form::text('itinerary[0][daytitle]', null, array('class'=>'form-control daytitle', 'placeholder'=>'Day title', 'value'=>Input::old('itinerary')[0]['daytitle'] )) !!}
                                                            <span class="error-title"></span>
                                                            @if ($errors->first('itinerary[0][daytitle]'))
                                                                <span class="help-block">{!! $errors->first('itinerary[0][daytitle]') !!}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>




                                                <td><label class="control-label" for="daydetails">Day Details:</label></td>
                                                <td colspan="4">
                                                    <div class="control-group {!! $errors->has('itinerary[0][daydetails]') ? 'has-error' : '' !!}">
                                                        <div class="controls">
                                                            {!! Form::textarea('itinerary[0][daydetails]', null, array('rows' => 3, 'class'=>'form-control', 'placeholder'=>'Day details', 'value'=>Input::old('itinerary')[0]['daydetails'] )) !!}
                                                            @if ($errors->first('itinerary[0][daydetails]'))
                                                                <span class="help-block">{!! $errors->first('itinerary[0][daydetails]') !!}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <div class="control-group {!! $errors->has('itinerary[0][accommodation]') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="accommodation">Accommodation:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::text('itinerary[0][accommodation]', null, array('class'=>'form-control', 'placeholder'=>'Accommodation', 'value'=>Input::old('itinerary')[0]['accommodation'] )) !!}
                                                            @if ($errors->first('itinerary[0][accommodation]'))
                                                                <span class="help-block">{!! $errors->first('itinerary[0][accommodation]') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>
                                                <div class="control-group {!! $errors->has('itinerary[0][walkhrs]') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="walkhrs">Walking hours:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::text('itinerary[0][walkhrs]', null, array('class'=>'form-control', 'placeholder'=>'Walking hours', 'value'=>Input::old('itinerary')[0]['walkhrs'] )) !!}
                                                            @if ($errors->first('itinerary[0][walkhrs]'))
                                                                <span class="help-block">{!! $errors->first('itinerary[0][walkhrs]') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>
                                                <div class="control-group {!! $errors->has('itinerary[0][maxaltitude]') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="maxaltitude">Max. Altitude:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::text('itinerary[0][maxaltitude]', null, array('class'=>'form-control', 'placeholder'=>'Max. Altitude', 'value'=>Input::old('itinerary')[0]['maxaltitude'] )) !!}
                                                            @if ($errors->first('itinerary[0][maxaltitude'))
                                                                <span class="help-block">{!! $errors->first('itinerary[0][maxaltitude') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>
                                            </tr>

                                            <tr>
                                                <div class="control-group {!! $errors->has('itinerary[0][lat]') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="lat">Latitude:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::number('itinerary[0][lat]', null, array('min'=>-90,'max'=>90, 'step'=>0.0000001,'class'=>'form-control', 'placeholder'=>'Latitude', 'value'=>Input::old('itinerary')[0]['lat'] )) !!}
                                                            @if ($errors->first('itinerary[0][lat]'))
                                                                <span class="help-block">{!! $errors->first('itinerary[0][lat]') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>


                                                <div class="control-group {!! $errors->has('itinerary[0][lng]') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="lng">Longitude:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::number('itinerary[0][lng]', null, array('min'=>-180,'max'=>180, 'step'=>0.0000001,'class'=>'form-control', 'placeholder'=>'Longitude', 'value'=>Input::old('itinerary')[0]['lng'] )) !!}
                                                            @if ($errors->first('itinerary[0][lng]'))
                                                                <span class="help-block">{!! $errors->first('itinerary[0][lng]') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>
                                                <td>
                                                    <a href="#/" class="btn btn-danger itinerary_del">Remove</a>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>

                                        <br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary" id="add-itinerary">Add New</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{--Itinerary--}}
                </div>


                {{--INC/EXC--}}

                <div class="row">
                    <div class="col-md-10 panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseInclusions"><span class="glyphicon glyphicon-th-list">
                                </span> TRIP INCLUSIONS</a>
                            </h4>
                        </div>
                        <div id="collapseInclusions" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">

                                        <table class="table table-striped well">
                                            <thead>
                                            <tr>
                                                <th>Includes</th>
                                                <th>Excludes</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class = "inc" id="inc-row">
                                                    <div class="control-group includes {!! $errors->has('incexc[inc][]') ? 'has-error' : '' !!}">
                                                        <div class="inc controls">
                                                            {!! Form::text('incexc[inc][]', null, array('class'=>'form-control', 'placeholder'=>'Includes..', 'value'=>Input::old('incexc')['inc'][0] )) !!}
                                                            <span class="error-include"></span>
                                                            @if ($errors->first('incexc[inc][]'))
                                                                <span class="help-block">{!! $errors->first('incexc[inc][]') !!}</span>
                                                            @endif
                                                            <br>
                                                        </div>
                                                             <a href="#/" class="btn btn-danger form-control del-inc"> Remove </a>
                                                            <br>
                                                            <br>
                                                    </div>
                                                    <a href="#" class="btn btn-primary" id="add-inc">Add New</a>
                                                </td>
                                                <td id = "exc-row">
                                                    <div class="control-group excludes {!! $errors->has('incexc[inc][]') ? 'has-error' : '' !!}">
                                                        <div class="exc controls">
                                                            {!! Form::text('incexc[exc][]', null, array('class'=>'form-control', 'placeholder'=>'Excludes..', 'value'=>Input::old('incexc')['exc'][0] )) !!}
                                                            <span class="error-exclude"></span>
                                                            @if ($errors->first('incexc[exc][]'))
                                                                <span class="help-block">{!! $errors->first('incexc[exc][]') !!}</span>
                                                            @endif
                                                             <br>
                                                        </div>
                                                            <a href="#/" class="btn btn-danger form-control del-exc"> Remove </a>
                                                
                                                            <br><br>
                                                      
                                                    </div>
                                                    <a href="#" class="btn btn-primary" id="add-exc">Add New</a>
                                                </td>
                                            </tr>

                                            <tr>
                                               
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Inclusions -->
                </div>

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
            <!-- Meta Keywords -->

            {{-- Is published? --}}
                {{--<div class="control-group">--}}

                    {{--<div class="controls">--}}
                        {{--<label>--}}
                            {{--{!! Form::checkbox('is_published', 'is_published') !!} Publish ?--}}
                        {{--</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<br>--}}

            {{-- Submit button --}}
                {!! Form::submit('Add Package', array('class' => 'btn btn-success')) !!}

            {!! Form::close() !!}
        <!-- package insert form ends -->

        <script type="text/javascript">
                 window.onload = function () {
               CKEDITOR.replace('overview', {
                   "filebrowserBrowseUrl"  : "{!! url('filemanager/show') !!}",
                   height                  : '50%'
               });
               CKEDITOR.replace('highlights', {
                   "filebrowserBrowseUrl"  : "{!! url('filemanager/show') !!}",
                   height                  : '50%'
               });
           };

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
                
                 url: '{{URL::to('en/admin/packages/changeActivity')}}',
                 headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                 data: {
                  get_option:val
                 },
                 success: function (response) {
                  document.getElementById("selectActivity").innerHTML=response; 
                 }
                 });
                }

                function fetch_selectRegion(val)
                {
                    //console.log(val);
                    //document.getElementById("selectRegion").innerHTML="test pass"; 
                    var destinationVal=document.getElementById("destinationVal").value;
                    //console.log(destinationVal);
                 $.ajax({
                 
                 url: '{{URL::to('en/admin/packages/changeRegion')}}',
                 headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                 data: {
                  get_option:val,
                  get_optionDestination:destinationVal
                 },
                 success: function (response) {
                  document.getElementById("selectRegion").innerHTML=response; 
                 }
                 });
                }
        </script>
    </div>
@stop