@extends('backend/layout/layout')
@section('content')
<section class="content-header">
    <h1> Activity
        <small> | Delete Activity</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! langRoute('admin.activity.index') !!}"><i class="fa fa-book"></i> Activity</a></li>
        <li class="active">Delete Activity</li>
    </ol>
</section>
<br>
<br>
<br>
<div class="container">
<div class="col-lg-10">
    {!! Form::open( array(  'route' => array(getLang(). '.admin.activity.destroy', $activity->id ) ) ) !!}
    {!! Form::hidden( '_method', 'DELETE' ) !!}
    <div class="alert alert-warning">
        <div class="pull-left"><b> Be Careful!</b> Are you sure you want to delete <b>{!! $activity->title !!} </b> ?
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
        <h4>List of packages and regions related to this Activity!!</h4><br/>

        
        
       

     <table class="table table-bordered  table-striped-column">
                        <thead>
                            <tr>
                                
                                <th>Packages</th>
                                <th>Regions</th>
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
        @endif</td></tr>


    </tbody></table>
    </div>
</div>
@stop