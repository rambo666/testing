
    <script type="text/javascript">
        $(document).ready(function () {

            $('#notification').show().delay(4000).fadeOut(700);

            // publish settings
            $(".footerpublish").bind("click", function (e) {
                var id = $(this).attr('id');
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{!! url(getLang() . '/admin/footermenu/" + id + "/toggle-publish/') !!}",
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    },
                    success: function (response) {
                        if (response['result'] == 'success') {
                            var imagePath = (response['changed'] == 1) ? "{!! url('/') !!}/assets/images/publish_16x16.png" : "{!!url('/')!!}/assets/images/not_publish_16x16.png";
                            $("#publish-footerimage-" + id).attr('src', imagePath);
                        }
                    },
                    error: function () {
                        alert("error");
                    }
                });
            });


    });
    </script>


    
    <br>
    
        <a href="{!! langRoute('admin.footermenu.create') !!}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;New Footer Menu </a> <br>
                    <hr>
                      <table class=table table-striped>
                        <thead>
                            <tr>
                                
                                <th>Title</th>
                                <th><div class='ns-actions'>Actions</div></th>
                                
                            </tr>
                        </thead>
                    <tbody>
                    <div class="dd" id="nestable">
                        {!! $footermenus !!}
                    </div>
                    @if($footermenus === null)
                        <div class="alert alert-danger">No results found</div>
                    @endif
                    </tbody></table>


  
