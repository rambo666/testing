<?php
//echo '<pre>'; print_r($package); echo '</pre>'; die;
$highlights = $metaValue['highlights'];
$itinerary = $metaValue['itinerary'];
$incexc = $metaValue['incexc'];
$is_popular = $metaValue['is_popular'];
?>
@extends('backend/layout/layout')
@section('content')
    {!! HTML::style('assets/bootstrap/css/bootstrap-tagsinput.css') !!}
    {!! HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
    {!! HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
    {!! HTML::script('ckeditor/ckeditor.js') !!}
    {!! HTML::script('assets/bootstrap/js/bootstrap-tagsinput.js') !!}
    {!! HTML::script('assets/js/jquery.slug.js') !!}
    {!! HTML::script('assets/js/jquery.validate.min.js') !!}
     {!! HTML::script('assets/js/custom_package.js') !!}
  
 
 
    <script type="text/javascript">
        $(document).ready(function () {
            $("#title").slug();

            if ($('#tag').length != 0) {
                var elt = $('#tag');
                elt.tagsinput();
            }
        });
    </script>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Package <small> | Update Package</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{!! url(getLang() . '/admin/package') !!}"><i class="fa fa-book"></i> Package</a></li>
            <li class="active">Update Package</li>
        </ol>
    </section>
    <br>
    <br>

    <div class="container">



        {{--FORM STARTS--}}
        {!! Form::open( array( 'route' => array(getLang(). '.admin.package.update', $package->id), 'method' => 'PATCH', 'files'=>true, 'id' => 'validate-form')) !!}

        {{--Title--}}
        <div class="row control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <div class="col-md-2"><label for="title" class="control-label">Title:</label></div>

            <div class="controls col-md-8">
            {!! Form::text(
                        'title', $package->title,
                        array('class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title',
                        )) !!} <!-- name, -->

                @if ($errors->first('title'))
                    <span class="help-block">{!! $errors->first('title') !!}</span>
                @endif
            </div>
        </div> <!-- /.control-group -->
        <br>

        {{-- DESTINATIONS --}}
        <div class="row control-group {!! $errors->has('destination') ? 'has-error' : '' !!}">
            <div class="col-md-2"><label for="destination" class="control-label">Destination:</label></div>

            <div id ="selectDestination"><div class="controls col-md-8">
                {!! Form::select('destination', $destinations, $package->destination_id, array('id'=>'destinationVal','onchange'=>'fetch_select(this.value)','class' => 'form-control', 'value'=>Input::old('destination'))) !!}
                @if ($errors->first('destination'))
                    <span class="help-block">{!! $errors->first('destination') !!}</span>
                @endif
            </div>
                           <!--  {!! Form::text('dummyDestination', $destinations[$package->destination_id], array('onClick'=>'fetch_selectDestination(this.value)','id'=>'activityVal','readonly' => 'true','class' => 'form-control', 'value'=>Input::old('activity'))) !!}
                            {!! Form::hidden('destination',  $package->destination_id, array('id'=>'destinationVals','class' => 'form-control', 'value'=>Input::old('activity'))) !!}
                            @if ($errors->first('activity'))
                                <span class="help-block">{!! $errors->first('activity') !!}</span>
                            @endif -->
            </div>
        </div> <!-- /.control-group -->
        <br>

        {{-- ACTIVITIES --}}
        <div class="row control-group {!! $errors->has('activity') ? 'has-error' : '' !!}">
            <div class="col-md-2"><label for="activity" class="control-label">Activity:</label></div>

            <div class="controls col-md-8">
               
                        
                            
                             <div id ="selectActivity">
                                {!! Form::select('activity', $filteredActivity, $package->activity_id, array('id'=>'activityVal','onchange'=>'fetch_selectRegion(this.value)','class' => 'form-control', 'value'=>Input::old('activity'))) !!}
                                @if ($errors->first('activity'))
                                    <span class="help-block">{!! $errors->first('activity') !!}</span>
                                @endif
                             <!-- {!! Form::text('dummyActivity', $activities[$package->activity_id], array('id'=>'activityVal','readonly' => 'true','class' => 'form-control', 'value'=>Input::old('activity'))
                            ) !!}
                            {!! Form::hidden('activity',  $package->activity_id, array('class' => 'form-control', 'value'=>Input::old('activity'))
                            ) !!}
                            @if ($errors->first('activity'))
                                <span class="help-block">{!! $errors->first('activity') !!}</span>
                            @endif -->
                             </div>
                           <!--  <select name='activity' id = "selectActivity" onchange="fetch_selectRegion(this.value)" class = "form-control">
                                
                            </select> -->
                    </div>
               
            
        </div> <!-- /.control-group -->
        <br>
        {{-- REGIONS --}}
                <div class="row control-group {!! $errors->has('region') ? 'has-error' : '' !!}">
                    <div class="col-md-2"><label for="region" class="control-label">Region:</label></div>

                    <div class="controls col-md-8">
                        <div id ="selectRegion">
                            {!! Form::select('region', $filteredRegion, $package->region_id, array('id'=>'regionVal','class' => 'form-control', 'value'=>Input::old('region'))) !!}
                                @if ($errors->first('region'))
                                    <span class="help-block">{!! $errors->first('region') !!}</span>
                                @endif
                            <!--  {!! Form::text('dummyRegion', $regions[$package->region_id], array('id'=>'regionVal','disabled','class' => 'form-control', 'value'=>Input::old('activity'))
                            ) !!}
                            {!! Form::hidden('region',  $package->region_id, array('class' => 'form-control', 'value'=>Input::old('region'))
                            ) !!}
                            @if ($errors->first('region'))
                                <span class="help-block">{!! $errors->first('region') !!}</span>
                            @endif -->
                             </div>
                       
                         
                       
                    </div>
                </div> <!-- /.control-group -->
                <br>
        <!-- <div class="row control-group {!! $errors->has('region') ? 'has-error' : '' !!}">
            <div class="col-md-2"><label for="region" class="control-label">Region:</label></div>

            <div class="controls col-md-8">
                {!! Form::select('region', $regions, $package->region_id, array('class' => 'form-control', 'value'=>Input::old('region'))) !!}
                @if ($errors->first('region'))
                    <span class="help-block">{!! $errors->first('region') !!}</span>
                @endif
            </div>
        </div> <!-- /.control-group -->
        <br>
        {{--DAYS AND PRICE--}}
        <div class="row control-group {!! $errors->has('days') || $errors->has('price') ? 'has-error' : '' !!}">
            <div class="col-md-2"><label for="days" class="control-label">Total Days:</label></div>

            <div class="controls col-md-3">
            {!! Form::text(
                        'days', $metaValue['days'],
                        array('class' => 'form-control', 'id' => 'days', 'placeholder' => 'Total Days',
                        )) !!} <!-- name, -->

                @if ($errors->first('days'))
                    <span class="help-block">{!! $errors->first('days') !!}</span>
                @endif
            </div>

            <div class="col-md-2"><label for="price" class="control-label">Price:</label></div>

            <div class="controls col-md-3">
            {!! Form::text(
                        'price', $metaValue['price'],
                        array('class' => 'form-control', 'id' => 'price', 'placeholder' => 'Price',

                        )) !!} <!-- name, -->

                @if ($errors->first('price'))
                    <span class="help-block">{!! $errors->first('price') !!}</span>
                @endif
            </div>
        </div> <!-- /.control-group -->
        <br>

        {{-- SLIDER --}}
        <div class="row control-group {!! $errors->has('slider') ? 'has-error' : '' !!}">

            <div class ="row col-md-12" style="padding-bottom: 10px;">
                <div class="controls col-md-4">
                    {!! Form::file('images[]', array('multiple'=>true,'id'=>'images', 'class' => 'form-control btn btn-default') ) !!}
                    @if ($errors->first('slider'))
                        <span class="help-block">{!! $errors->first('slider') !!}</span>
                    @endif

                </div>
                <div class="controls col-md-4">
                    <label>
                        Is Popular? {!! Form::checkbox('is_popular', 'is_popular', ($is_popular == 1 ? true : false)) !!}
                    </label>
                    
                </div>
                <div class="controls col-md-4">
                    <label>
                       Is Suggested? {!! Form::checkbox('is_suggested', 'is_suggested', ($package->is_suggested == 1 ? true : false)) !!}
                            
                    </label></div>
            </div>

            <div class="row" style="margin-left: 0px;">
                <div class="col-md-10 panel panel-default" style="margin-bottom: 0px;">
                    <div class="panel-heading" >
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseImages"><span class="glyphicon glyphicon-th">
                                    </span> CURRENT IMAGES</a>
                        </h4>
                    </div>

                    <div id="collapseImages" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php $counter = 0; ?>
                            @foreach($metaValue['images'] as $image)
                                <div id= "closeimg_<?php echo $image; ?>">
                                    {!! Form::hidden("oldImages[$counter]", "$image", array('id' => 'oldImages'))  !!}
                                </div>
                                
                                <div id= "closeimg_<?php echo $counter;?>"  style="width: 160px; height:160px; padding-bottom:2px; float:left;">
                                    
                                    <!-- Image Column -->
                                    <div class="table-text">
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 100px; margin-bottom:10px">
                                            <img data-src="" {!! (($image ) ? "src='".url('uploads/package/' . $image)."'" : null) !!} alt="...">
                                        </div>
                                        <!-- Remove Button -->
                                        <a href="#/" class="btn btn-default fileinput-exists" data-dismiss="fileinput" onClick='deleteImage("closeimg_<?php echo $counter;?>", "closeimg_<?php echo $image;?>")'>Remove</a>
                                    </div>
                                        
                                </div>

                                <?php $counter++ ; ?>
                            @endforeach
                        </div>
                    </div>     
                </div>
            </div>   

        </div> <!-- /.control-group -->
        <br>

        <?php // echo '<pre>'; print_r($package); echo '</pre>'; die; ?>
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
                                        {!! Form::textarea('overview', $package->overview, array('rows' => 3, 'class'=>'form-control', 'id' => 'overview', 'placeholder'=>'Overview')) !!}
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
                                        {!! Form::textarea('highlights', $highlights, array('rows' => 3, 'class'=>'form-control', 'id' => 'highlights', 'placeholder'=>'Trip Highlights')) !!}
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
        
        <!-- Itinerary -->
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

                                <?php 
                                $it_count = 0; 
                                $count = count($itinerary);
                                $c=0;
                                ?>

                                @foreach( $itinerary as $day )
                                    @if (--$count <= 0)
                                    <?php 
                                        $daytitleN = $day['daytitle'];
                                        $daydaydetailsN = $day['daydetails'];
                                        $dayaccommodationN = $day['accommodation'];
                                        $daywalkhrsN = $day['walkhrs'];
                                        $daymaxaltitudeN = $day['maxaltitude'];
                                        $daylatN = $day['lat'];
                                        $daylngN = $day['lng'];

                                        break;?>
                                    @endif

                                    <table class="table table-striped well table-itinerary">
                                        {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<td colspan="7"><button type="button" class="close" aria-label="Close"><span aria-hidden="true" class="close-itinerary">&times;</span></button></td>--}}
                                            {{--</tr>--}}
                                        {{--</thead>--}}
                                        <tbody>
                                            <!-- Day title -->
                                            <tr>
                                                <div class="control-group {!! $errors->has('daytitle') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="daytitle">Day Title : {!!$c=$it_count+1!!}</label></td>
                                                    <td>
                                                        <div class="daytitle controls">
                                                            {!! Form::text('itinerary['.$it_count.'][daytitle]', $day['daytitle'], array('class'=>'form-control', 'placeholder'=>'Title')) !!}
                                                            <span class="error-title"></span>
                                                            @if ($errors->first('daytitle'))
                                                                <span class="help-block">{!! $errors->first('daytitle') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>

                                                <div class="control-group {!! $errors->has('daydetails') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="daydetails">Day Details:</label></td>
                                                    <td colspan="4">
                                                        <div class="controls">
                                                            {!! Form::textarea('itinerary['.$it_count.'][daydetails]', $day['daydetails'], array('rows' => 3, 'class'=>'form-control', 'placeholder'=>'Details' )) !!}
                                                            @if ($errors->first('daydetails'))
                                                                <span class="help-block">{!! $errors->first('daydetails') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>
                                            </tr>

                                            <tr>
                                                <div class="control-group {!! $errors->has('accommodation') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="accommodation">Accommodation:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::text('itinerary['.$it_count.'][accommodation]', $day['accommodation'], array('class'=>'form-control', 'placeholder'=>'Accommodation' )) !!}
                                                            @if ($errors->first('accommodation'))
                                                                <span class="help-block">{!! $errors->first('accommodation') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>
                                                
                                                <div class="control-group {!! $errors->has('walkhrs') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="walkhrs">Walking hours:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::text('itinerary['.$it_count.'][walkhrs]', $day['walkhrs'], array('class'=>'form-control', 'placeholder'=>'Walking hours' )) !!}
                                                            @if ($errors->first('walkhrs'))
                                                                <span class="help-block">{!! $errors->first('walkhrs') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>
                                                
                                                <div class="control-group {!! $errors->has('maxaltitude') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="maxaltitude">Max. Altitude:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::text('itinerary['.$it_count.'][maxaltitude]', $day['maxaltitude'], array('class'=>'form-control', 'placeholder'=>'Max. Altitude' )) !!}
                                                            @if ($errors->first('maxaltitude'))
                                                                <span class="help-block">{!! $errors->first('maxaltitude') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>
                                            </tr>

                                            <tr>
                                                <div class="control-group {!! $errors->has('lat') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="lat">Latitude:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::number('itinerary['.$it_count.'][lat]', $day['lat'], array('min'=>-90,'max'=>90,'step'=>0.0000001,'class'=>'form-control', 'placeholder'=>'Latitude' )) !!}
                                                            @if ($errors->first('lat'))
                                                                <span class="help-block">{!! $errors->first('lat') !!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>

                                                <div class="control-group {!! $errors->has('lng') ? 'has-error' : '' !!}">
                                                    <td><label class="control-label" for="lng">Longitude:</label></td>
                                                    <td>
                                                        <div class="controls">
                                                            {!! Form::number('itinerary['.$it_count.'][lng]', $day['lng'], array('min'=>-180,'max'=>180,'step'=>0.0000001,'class'=>'form-control', 'placeholder'=>'Longitude' )) !!}
                                                            @if ($errors->first('lng'))
                                                                <span class="help-block">{!! $errors->first('lng') !!}</span>
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

                                <?php $it_count++;?>
                                    
                                @endforeach
                                   
                                <br>
                            </div>
                        </div>

                        <!--Adding New Itenerary while editing the package-->

                        <table class="table table-striped well table-itinerary" >
                            {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<td colspan="7"><button type="button" class="close" aria-label="Close"><span aria-hidden="true" class="close-itinerary">&times;</span></button></td>--}}
                                {{--</tr>--}}
                            {{--</thead>--}}
                            
                            <tbody>
                                <!-- Day title -->
                                <tr>
                                    <td><label class="control-label" for="daytitle">Day Title : {!!++$c!!}</label></td>
                                    <td>
                                        <div class="control-group {!! $errors->has('itinerary[0][daytitle]') ? 'has-error' : '' !!}">
                                            <div class="daytitle controls">
                                                {!! Form::text('itinerary['.$it_count.'][daytitle]', $daytitleN, array('class'=>'form-control daytitle', 'placeholder'=>'Day title'))!!}
                                                <span class="error-title"></span>
                                                @if ($errors->first('itinerary[$it_count][daytitle]'))
                                                    <span class="help-block">{!! $errors->first('itinerary[$it_count][daytitle]') !!}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td><label class="control-label" for="daydetails">Day Details:</label></td>
                                    <td colspan="4">
                                        <div class="control-group {!! $errors->has('itinerary[0][daydetails]') ? 'has-error' : '' !!}">
                                            <div class="controls">
                                                {!! Form::textarea('itinerary['.$it_count.'][daydetails]', $daydaydetailsN, array('rows' => 3, 'class'=>'form-control', 'placeholder'=>'Day details')) !!}
                                                @if ($errors->first('itinerary[$it_count][daydetails]'))
                                                    <span class="help-block">{!! $errors->first('itinerary[$it_count][daydetails]') !!}</span>
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
                                                {!! Form::text('itinerary['.$it_count.'][accommodation]', $dayaccommodationN, array('class'=>'form-control', 'placeholder'=>'Accommodation')) !!}
                                                @if ($errors->first('itinerary[$it_count][accommodation]'))
                                                    <span class="help-block">{!! $errors->first('itinerary[$it_count][accommodation]') !!}</span>
                                                @endif
                                            </div>
                                        </td>
                                    </div>
                                    <div class="control-group {!! $errors->has('itinerary[0][walkhrs]') ? 'has-error' : '' !!}">
                                        <td><label class="control-label" for="walkhrs">Walking hours:</label></td>
                                        <td>
                                            <div class="controls">
                                                {!! Form::text('itinerary['.$it_count.'][walkhrs]', $daywalkhrsN, array('class'=>'form-control', 'placeholder'=>'Walking hours')) !!}
                                                @if ($errors->first('itinerary[$it_count][walkhrs]'))
                                                    <span class="help-block">{!! $errors->first('itinerary[$it_count][walkhrs]') !!}</span>
                                                @endif
                                            </div>
                                        </td>
                                    </div>
                                    <div class="control-group {!! $errors->has('itinerary[0][maxaltitude]') ? 'has-error' : '' !!}">
                                        <td><label class="control-label" for="maxaltitude">Max. Altitude:</label></td>
                                        <td>
                                            <div class="controls">
                                                {!! Form::text('itinerary['.$it_count.'][maxaltitude]', $daymaxaltitudeN, array('class'=>'form-control', 'placeholder'=>'Max. Altitude')) !!}
                                                @if ($errors->first('itinerary[$it_count][maxaltitude'))
                                                    <span class="help-block">{!! $errors->first('itinerary[$it_count][maxaltitude') !!}</span>
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
                                                {!! Form::number('itinerary['.$it_count.'][lat]', $daylatN, array('min'=>-90,'max'=>90,'step'=>0.0000001,'class'=>'form-control', 'placeholder'=>'Latitude')) !!}
                                                @if ($errors->first('itinerary[$it_count][lat]'))
                                                    <span class="help-block">{!! $errors->first('itinerary[$it_count][lat]') !!}</span>
                                                @endif
                                            </div>
                                        </td>
                                    </div>
                                    <div class="control-group {!! $errors->has('itinerary[0][lng]') ? 'has-error' : '' !!}">
                                        <td><label class="control-label" for="lng">Longitude:</label></td>
                                        <td>
                                            <div class="controls">
                                                {!! Form::number('itinerary['.$it_count.'][lng]', $daylngN, array('min'=>-180,'max'=>180,'step'=>0.0000001,'class'=>'form-control', 'placeholder'=>'Longitude')) !!}
                                                @if ($errors->first('itinerary[$it_count][lng]'))
                                                    <span class="help-block">{!! $errors->first('itinerary[$it_count][lng]') !!}</span>
                                                @endif
                                            </div>
                                        </td>
                                    </div>
                                    <td><a href="#/" class="btn btn-danger itinerary_del ">Remove</a> </td>
                                </tr>
            
                            </tbody>
                        </table>
                            
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#/" class="btn btn-primary" id="add-itinerary">Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End of Itinerary -->
        


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

                                <table class="table table-striped well" id="table-inclusion">
                                    <thead>
                                    <tr>
                                        <th>Includes</th>
                                        <th>Excludes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class = "inc" id="inc-row">
                                            @foreach($incexc['inc'] as $inc)
                                                <div class="control-group includes {!! $errors->has('inclusion') ? 'has-error' : '' !!}" style="padding-bottom:20px;">
                                                    <div class="inc controls">
                                                        {!! Form::text('incexc[inc][]', $inc, array('class'=>'form-control',  'placeholder'=>'Includes..' )) !!}
                                                        <span class="error-include"></span>
                                                        @if ($errors->first('inclusion'))
                                                            <span class="help-block">{!! $errors->first('inclusion') !!}</span>
                                                        @endif
                                                        <br>
                                                    </div>
                                                        <a href="#/" class="btn btn-danger form-control del-inc"> Remove </a>
                                                        <br>
                                                </div>
                                            @endforeach
                                            <a href="#/" class="btn btn-primary" id="add-inc">Add New</a>
                                        </td>
                                        <td id = "exc-row">
                                             @foreach($incexc['exc'] as $exc)
                                                <div class="control-group excludes {!! $errors->has('exclusion') ? 'has-error' : '' !!}" style="padding-bottom:20px;">
                                                    <div class="exc controls">
                                                        {!! Form::text('incexc[exc][]', $exc, array('class'=>'form-control',  'placeholder'=>'Excludes..' )) !!}
                                                        <span class="error-exclude"></span>
                                                        @if ($errors->first('exclusion'))
                                                            <span class="help-block">{!! $errors->first('exclusion') !!}</span>
                                                        @endif
                                                        <br>
                                                    </div>
                                                    <a href="#/" class="btn btn-danger form-control del-exc"> Remove </a>
                                                
                                                    <br>
                                                </div>
                                            @endforeach
                                            <a href="#/" class="btn btn-primary" id="add-exc">Add New</a>
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
                                            'meta_keywords', $package->meta_keywords,
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
                                        {!! Form::text('meta_description', $package->meta_description,
                                                        array('class' => 'form-control', 'id' => 'meta_description' )) !!}
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
                    {{--{!! Form::checkbox('is_published', 'is_published', ($package->is_published == 1 ? true : false)) !!} Publish ?--}}
                {{--</label>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<br>--}}

    {{-- Submit button --}}
    {!! Form::submit('Update Package', array('class' => 'btn btn-success')) !!}

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
                    
                    $('#regionVal')
                        .find('option')
                        .remove()
                        .end()
                        .append(' <option disabled selected value> -- select a Region -- </option>')
                        .val('whatever')
                    ;
                                     
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
               
                // window.onload = function(){
                //     var hasElement = document.getElementById('changeDestination').value;
                //     fetch_select(hasElement);
                // }
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

                //  function fetch_selectDestination(val)
                // {
                //     console.log(val,document.getElementById("destinationVals").value);
                //     //document.getElementById("destinationVals").innerHTML="test pass"; 
                //     var destinationVal=document.getElementById("destinationVals").value;
                //     //console.log(destinationVal);
                //  $.ajax({
                 
                //  url: '{{URL::to('en/admin/packages/changeDestination')}}',
                //  headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                //  data: {
                //   get_option:val,
                //   get_optionDestination:destinationVal
                //  },
                //  success: function (response) {
                //   document.getElementById("selectDestination").innerHTML=response; 

                //  }
                //  });

                // }
        </script>

    </div>


 <script type="text/javascript">
  
  function deleteImage(id, image){
            document.getElementById(id).remove();
            document.getElementById(image).remove();
             }
</script>

<script type="text/javascript">
$(document).ready(function() {
$("#validate-form").submit(function(){  
    
  
 if (!$('#title').val()) {    
        alert("Title field cannot be empty");
        return false;
    }
    else if (!$('#activityVal').val()) {    
        alert("Please Select an Activity");
        return false;
    }
    else if (!$('#regionVal').val()) {    
        alert("Please Select a Region");
        return false;
    }

    
 else if(!$('input[type="file"]').val() && !$('#oldImages').val())
           
                {
                    alert("Please select atleast one Image");
                    return false;
                }
  
    }); 
}); 
 
   </script>


@stop