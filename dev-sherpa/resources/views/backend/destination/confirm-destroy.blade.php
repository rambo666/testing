@extends('backend/layout/layout')
@section('content')
<section class="content-header">
    <h1> Destination
        <small> | Delete Destination</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! langRoute('admin.destination.index') !!}"><i class="fa fa-book"></i> Destination</a></li>
        <li class="active">Delete Destination</li>
    </ol>
</section>
<br>
<br>
<br>
<div class="container">
<div class="col-lg-10">
    {!! Form::open( array(  'route' => array(getLang(). '.admin.destination.destroy', $destination->id ) ) ) !!}
    {!! Form::hidden( '_method', 'DELETE' ) !!}
    <div class="alert alert-warning">
        <div class="pull-left"><b> Be Careful!</b> Are you sure you want to delete <b>{!! $destination->title !!} </b> ?
        </div>
        <div class="pull-right">
            {!! Form::submit( 'Yes', array( 'class' => 'btn btn-danger' ) ) !!}
            {!! link_to( URL::previous(), 'No', array( 'class' => 'btn btn-primary' ) ) !!}
        </div>
        <div class="clearfix"></div>
    </div>
    {!! Form::close() !!}
</div>


<br/>
    <div class="col-lg-10">
    <h2>Please be Careful!! Deleting this Activity will delete following dependencies PERMANENTLY!!</h2></div>
    <div class="col-lg-10">
        <h4>List of packages, regions and activities related to this Destination!!</h4><br/>

        
        
       

     <table class="table table-bordered  table-striped-column">
                        <thead>
                            <tr>
                                
                                <th>Packages</th>
                                <th>Regions</th>
                                <th>Activities</th>
                            </tr>
                        </thead>
         <tbody>               
        <tr><td>
        @if(!count($packages) == 0)
            <?php  $sno=0;?>
            @foreach( $packages as $key=> $package )
            {!!$package!!}<br/>
            @endforeach
            
        @else
         No Packages Found
        @endif
        </td>


         <td>
        @if(!count($regions) == 0)
            <?php  $sno//=0;?>
            @foreach( $regions as $key=> $region )
            {!!$region!!}<br/>
            @endforeach
            
            
        @else
         No Regions Found
        @endif</td>

        <td>
        @if(!count($activities) == 0)
            <?php  $sno//=0;?>
            @foreach( $activities as $key=> $activity )
            {!!$activity!!}<br/>
            @endforeach
            
            
        @else
         No Activities Found
        @endif</td></tr>


    </tbody></table>
    </div>
</div>
@stop