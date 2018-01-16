<span class="icon-sidebar">
        <a href="#" id="icon-side"><img src="{{ url('sherpaassets/images/icons/sidebar-collapse-icon.svg') }}" class="svg" alt=""></a>
    </span>
<div class="sidebar-section">
    <div class="top-part">
        {!! Form::open( array( 'route' => 'dashboard.search', 'method' => 'get', 'role' => 'search', 'class' => 'search-form' ) ) !!}

            <div class="input-group">
                {!! Form::text( 'search', null, array(
                                                    'required',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Search packages',
                                                     'id'           => 'srch-term'
                                                    ) ) !!}
                {{--<input type="text" class="form-control" placeholder="Search Activities, Packages..." name="srch-term" id="srch-term">--}}
                <div class="input-group-btn">
                    {!! Form::button( '',
                                                array( 'type' => 'submit', 'class' => 'btn btn-default btn-transparent' )) !!}
                    {{--<button class="btn btn-default btn-transparent" type="submit">--}}
                        <img src="{{ url('sherpaassets/images/icons/search-icon.svg') }}" class="svg"/></button>
                </div>
            </div>

        {!! Form::close() !!}
        <!-- .search-form -->
    </div>
    <!-- .top-part -->

</div>