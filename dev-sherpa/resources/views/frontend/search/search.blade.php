 <div class="header-cta alignright col-md-3">
                    <a href="#" class="btn" data-toggle="modal" data-target="#request">get a free quote</a>
                    <a href="#" class="search-icon" id="SearchIcon"> Search</a>
                </div>
            <!-- header-right -->
        </div>
    </div>
   
   <!-- Search function -->
    <div id="search">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <form action="#" id="search-form">
                    <input type="text" placeholder="Search Packages" class="form-text search-input" id="searches">
                   
                </form>
            </div>
        </div>
        <div class="popular-packages">
            <div class="row" id="search-cards">
                <div class="col-xs-12">
                    <div class="title">Our Suggested Packages</div>
                </div>
                <div id="suggested"></div>
            </div>   
           </div>            
        </div>
    </div>
</div>




<script type="text/javascript">
    $('#searches').on('keydown', function (e) {
         console.log(this.value);
            if (e.which === 32 &&  e.target.selectionStart === 0) 
            {
              return false;
            } 
  
    });

   
  $('#searches').on('keyup', function (e) {
                        $value=$(this).val();
                        console.log($value);
                        if ($value == "") 
                        {
                         
                                $value=$(this).val();
                                        $.ajax({
                                            type    : 'get',
                                            url     : '{{URL::to('en/search/displaySuggested')}}',
                                            data    : {'search':$value},
                                            success:function(data){
                                                    console.log(data);
                                                    $('#suggested').html(data);
                                            }
                                        });
                                
                         $('#search-cards').html('<div class="col-xs-12"><div class="title">Our Suggested Packages</div><div id="suggested"></div></div>');
                          
                        } 

                        else
                        {
                            $.ajax({
                                type    : 'get',
                                url     : '{{URL::to('en/search/searches')}}',
                                data    : {'search':$value},
                                success:function(data){
                                        console.log(data);
                                        $('#search-cards').html(data);
                                        $("#searchText").text("Search Results");
                                }
                            });
                        }

                });

$('a#SearchIcon').click(function(){
$value=$(this).val();
        $.ajax({
            type    : 'get',
            url     : '{{URL::to('en/search/displaySuggested')}}',
            data    : {'search':$value},
            success:function(data){
                    console.log(data);
                    $('#suggested').html(data);
            }
        });
})

</script>