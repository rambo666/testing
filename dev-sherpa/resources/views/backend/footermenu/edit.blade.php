@extends('backend/layout/layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Footer Menu <small> | Edit Footer Menu</small> </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang(). '/admin/footermenu') !!}">Footer Menu</a></li>
        <li class="active">Edit Footer Menu Item</li>
    </ol>
</section>
       
            
       
<br>
<br>
 
 
<!-- cloning od form data
 --> 
 <div id="readroot" style="display: none">

                    
                       
                        
                        {!! Form::text('footertitle[]', null, array('id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}

                       
                        {!! Form::radio('type[]', 'module', true, array('onClick' => 'changeFunction(this.id)','id'=>'mod', 'class'=>'type')) !!}
                        <span>Module</span>
                    
                        {!! Form::radio('type[]', 'custom', false, array('onClick' => 'changeFunction(this.id)','id'=>'cus', 'class'=>'type')) !!}
                        <span>Custom</span>
                   
                        {!! Form::radio('type[]', 'packages', false, array('onClick' => 'changeFunction(this.id)','id'=>'pac', 'class'=>'type')) !!}
                        <span>Package</span>
                       
                        <b class="{!! $errors->has('url') ? 'has-error' : '' !!} module" id="module">
                        {!! Form::select('option[]', $options, null, array( 'id' => 'options', 'value'=>Input::old('options'))) !!}
                        @if ($errors->first('options'))
                        <span class="help-block">{!! $errors->first('options') !!}</span>
                        @endif
                        </b>
                        
                        
                        <b style="display:none" class="{!! $errors->has('url') ? 'has-error' : '' !!} custom" id="custom">
                        {!! Form::text('url[]',null, array('id' => 'url', 'placeholder'=>'Url', 'value'=>Input::old('url'))) !!}
                        @if ($errors->first('url'))
                        <span class="help-block">{!! $errors->first('url') !!}</span>
                        @endif
                        </b>

                        <b style="display:none" class="{!! $errors->has('package') ? 'has-error' : '' !!} package" id="package">
                        {!! Form::select('optionPackage[]', $optionsPackage, null, array('id' => 'option', 'value'=>Input::old('option'))) !!}
                        @if ($errors->first('package'))
                        <span class="help-block">{!! $errors->first('package') !!}</span>
                        @endif
                        </b>
                       
                    
                            <button type="button" class="btn btn-danger" value="Remove review" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" /><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button><br /><br />
                      <br>
                    
    

</div>

<div id="readroot2" style="display: none">

   
                      
                        @foreach($footermenuChilds as $key=>$footermenuChild)
                        
                        <?php $counters = ++$key ?>

                        <?php $var = $footermenuChild->type;?>
                     

                        @if($var=="module")
                        {{--*/ $change = "module"; /*--}}
                        
                        
                        @elseif ($var=="packages")
                        {{--*/ $change = "packages";/*--}}

                        
                        
                        @else 
                        {{--*/ $change = "url"; /*--}}
                        
                        @endif 
                        
                   
                        
                        
                        <span class="delTable<?php echo $counters?>">{!! Form::text('footertitle[]'.$key.'', $footermenuChild->title, array('id' => 'title'.$key.'', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}</span>

                       
                        {!! Form::radio('type[]'.$key.'', 'module',(($footermenuChild->type == "module") ? true : false), array('onClick' => 'changeFunction(this.id)','id'=>'mod'.$key.'', 'class'=>'type delTable'.$key.'')) !!}
                        <span class="delTable<?php echo $counters?>">Module</span>
                    
                        {!! Form::radio('type[]'.$key.'', 'custom', (($footermenuChild->type == "custom") ? true : false), array('onClick' => 'changeFunction(this.id)','id'=>'cus'.$key.'', 'class'=>'type delTable'.$key.'')) !!}
                        <span class="delTable<?php echo $counters?>">Custom</span>
                   
                       {!! Form::radio('type[]'.$key.'', 'packages', (($footermenuChild->type == "packages") ? true : false), array('onClick' => 'changeFunction(this.id)','id'=>'pac'.$key.'', 'class'=>'type delTable'.$key.'')) !!}
                         <span class="delTable<?php echo $counters?>">Package</span>
                       
                        @if($var=="module")
                        <b class="{!! $errors->has('url') ? 'has-error' : '' !!} module delTable<?php echo $counters?>" id="module<?php echo $counters?>">
                        @else     
                        <b style="display:none" class="{!! $errors->has('url') ? 'has-error' : '' !!} module delTable<?php echo $counters?>" id="module<?php echo $counters?>">
                        @endif
                        {!! Form::select('option[]'.$key.'', $options, $footermenuChild->option, array( 'id' => 'options'.$key.'', 'value'=>$footermenuChild->option)) !!}
                        @if ($errors->first('options'))
                        <span class="help-block delTable<?php echo $counters?>">{!! $errors->first('options') !!}</span>
                        @endif
                        </b>
                        
                        @if($var=="custom")
                         <b class="{!! $errors->has('url') ? 'has-error' : '' !!} custom delTable<?php echo $counters?>" id="custom<?php echo $counters?>">
                        @else     
                         <b style="display:none" class="{!! $errors->has('url') ? 'has-error' : '' !!} custom delTable<?php echo $counters?>" id="custom<?php echo $counters?>">
                        @endif
                       
                        {!! Form::text('url[]'.$key.'',$footermenuChild->url, array('id' => 'url'.$key.'', 'placeholder'=>'Url', 'value'=>$footermenuChild->url)) !!}
                        @if ($errors->first('url'))
                        <span class="help-block delTable<?php echo $counters?>">{!! $errors->first('url') !!}</span>
                        @endif
                        </b>
                        
                        @if($var=="packages")
                        <b class="{!! $errors->has('package') ? 'has-error' : '' !!} package delTable<?php echo $counters?>" id="package<?php echo $counters?>">
                        @else     
                          <b style="display:none" class="{!! $errors->has('package') ? 'has-error' : '' !!} package delTable<?php echo $counters?>" id="package<?php echo $counters?>">
                        @endif
                       
                        {!! Form::select('optionPackage[]'.$key.'', $optionsPackage, $footermenuChild->option, array('id' => 'option'.$key.'', 'value'=>$footermenuChild->option)) !!}
                        @if ($errors->first('package'))
                        <span class="help-block delTable<?php echo $counters?>">{!! $errors->first('package') !!}</span>
                        @endif
                        </b>
                       
                    
                            <button type="button" class="delTable btn btn-danger delTable<?php echo $counters?>" value="Remove review" onclick="removeLine('.delTable<?php echo $counters?>') " /><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button><br /><br />
                            
                      <br>
                        {{--*/ $change = ""; /*--}}
                        {{--*/ $var = ""; /*--}}
                   
                      @endforeach
                     
                       
    

</div>  


<div class="container">
     @include('flash::message')<br/><br/>
     <div class="controls"> 
    {!! Form::open( array( 'route' => array(getLang(). '.admin.footermenu.update', $footermenu->id), 'method' => 'PATCH')) !!}
    <!-- Title -->
    <div class="control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
        <label class="control-label" for="title">Footer Menu Title</label>

        <div class="controls">
            {!! Form::text('title',$footermenu->title, array('class'=>'form-control', 'id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}
            @if ($errors->first('title'))
            <span class="help-block">{!! $errors->first('title') !!}</span>
            @endif
        </div>
        <br>
    </div>

    <h3>Footer Menu Links</h3>
        
       <!--  <h2><a href="#" id="addScnt" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>Add Links</a></h2> -->
   
                <small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another form field :)</small> <br/><br/>      
                 <button type="button" class="btn btn-primary" id="moreFields" value="Add more"  /><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Links</button><br/><br/>
                    


                
                <span id="writeroot"></span>
               
            
            
            </div>
                        
                       
        
       
        <br/><br/>
    <!-- Form actions -->
    {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}

    {!! Form::close() !!}
   

</div>

  <script type="text/javascript">
       
    function removeLine(removeClass) 
    {
        $(removeClass).remove();

    }
     



    function changeFunction(ChangeVal) 
        {
            var val = ChangeVal.substring(0, 3); 
            var index = ChangeVal.substring(6, 3); 
            var module = '#module'+index;
            var custom = '#custom'+index;
            var packages = '#package'+index;
                if (val == "cus") {
                    $(module).css('display', 'none');
                    $(custom).css('display', 'inline');
                    $(packages).css('display', 'none');
                }
                else if (val == "mod") {
                    $(module).css('display', 'inline');
                    $(custom).css('display', 'none');
                    $(packages).css('display', 'none');
                }

                else{$(module).css('display', 'none');
                    $(custom).css('display', 'none');
                    $(packages).css('display', 'inline');}
            //console.log(module);//console.log(index);
            }

    var newCounter = 0;
    var oldCounter = 0;
    var getOldVal =<?php echo $counters;?>;
    var oldVal = getOldVal * 10 + 2; 


function init() {
    document.getElementById('moreFields').onclick = moreFields;

}

function moreFields() {
    
    
    oldVal++;
    newCounter = oldVal;
    // console.log(newCounter,oldVal);
    var newFields = document.getElementById('readroot').cloneNode(true);
    newFields.id = '';
    newFields.style.display = 'block';
    var newField = newFields.childNodes;
    for (var i=0;i<newField.length;i++) {
        var theName = newField[i].name
        var theId = newField[i].id
     
        if (theName)
            newField[i].name = theName + newCounter;
            newField[i].id = theId + newCounter;
          
    }
    var insertHere = document.getElementById('writeroot');
    insertHere.parentNode.insertBefore(newFields,insertHere);

}

function oldData() {
    oldCounter++;
    var newFields = document.getElementById('readroot2').cloneNode(true);
    newFields.id = '';
    newFields.style.display = 'block';
    var newField = newFields.childNodes;
    for (var i=0;i<newField.length;i++) {
        var theName = newField[i].name
        var theId = newField[i].id
     
        if (theName)
            newField[i].name = theName + oldCounter;
            newField[i].id = theId + oldCounter;
          
    }
    var insertHere = document.getElementById('writeroot');
    insertHere.parentNode.insertBefore(newFields,insertHere);

}

    window.onload = function () {
    
    /* Initialise example scripts on content pages in all browsers */
    
    if (self.init)
        init();
        oldData();
   

}



</script>

@stop