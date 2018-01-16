@extends('backend/layout/layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Footer Menu <small> | Add Footer Menu</small> </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang(). '/admin/footermenu') !!}">Footer Menu</a></li>
        <li class="active">Add Footer Menu Item</li>
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
                        {!! Form::select('option[]', $options, null, array( 'id' => 'options')) !!}
                        @if ($errors->first('options'))
                        <span class="help-block">{!! $errors->first('options') !!}</span>
                        @endif
                        </b>
                        
                        
                        <b style="display:none" class="{!! $errors->has('url') ? 'has-error' : '' !!} custom" id="custom">
                        {!! Form::text('url[]',null, array('id' => 'url', 'placeholder'=>'Url')) !!}
                        @if ($errors->first('url'))
                        <span class="help-block">{!! $errors->first('url') !!}</span>
                        @endif
                        </b>

                        <b style="display:none" class="{!! $errors->has('package') ? 'has-error' : '' !!} package" id="package">
                        {!! Form::select('optionPackage[]', $optionsPackage, null, array('id' => 'option')) !!}
                        @if ($errors->first('package'))
                        <span class="help-block">{!! $errors->first('package') !!}</span>
                        @endif
                        </b>
                       
                     
                            <button type="button" class="btn btn-danger" value="Remove review" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" /><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button><br /><br />
                      <br>
                    
    

</div>



<div class="container">
     <div class="controls"> 
    {!! Form::open(array('action' => '\Fully\Http\Controllers\Admin\FooterMenuController@store')) !!}
    <!-- Title -->
    <div class="control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
        <label class="control-label" for="title">Footer Menu Title</label>

        <div class="controls">
            {!! Form::text('title', null, array('class'=>'form-control', 'id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}
            @if ($errors->first('title'))
            <span class="help-block">{!! $errors->first('title') !!}</span>
            @endif
        </div>
        <br>
    </div>

    <h3>Footer Menu Links</h3>
        
       <!--  <h2><a href="#" id="addScnt" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>Add Links</a></h2> -->
               
                <small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another form field :)</small>  <br/><br/>
                <button type="button" id="moreFields" value="Add more" class="btn btn-primary "/> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Links</button>  <br/><br/>
                <span id="writeroot"></span>

                
               
            
            
            </div>
                        
                       
        
       
        <br/><br/>
    <!-- Form actions -->
    {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}

    {!! Form::close() !!}
   </div>






<script type="text/javascript">

 function changeFunction(ChangeVal) 
        {
            var val = ChangeVal.substring(0, 3); 
            var index = ChangeVal.substring(6, 3); 
            var module = '#module'+index;
            var custom = '#custom'+index;
            var packages = '#package'+index;
            // console.log(module,custom,packages);
            // console.log(val,index,ChangeVal);
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

var counter = 0;

function init() {
    document.getElementById('moreFields').onclick = moreFields;
    moreFields();
}

function moreFields() {
    counter++;
    var newFields = document.getElementById('readroot').cloneNode(true);
    newFields.id = '';
    newFields.style.display = 'block';
    var newField = newFields.childNodes;
    for (var i=0;i<newField.length;i++) {
        var theName = newField[i].name
        var theId = newField[i].id
     
        if (theName)
            newField[i].name = theName + counter;
            newField[i].id = theId + counter;
          
    }
    var insertHere = document.getElementById('writeroot');
    insertHere.parentNode.insertBefore(newFields,insertHere);

}

    window.onload = function () {
    
    /* Initialise example scripts on content pages in all browsers */
    
    if (self.init)
        init();


}



</script>
</div>
@stop
