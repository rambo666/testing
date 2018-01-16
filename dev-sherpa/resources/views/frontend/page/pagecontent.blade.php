<main id="content" role="main" class="inner">
    <div class="container">
        <div class="top-section clearfix">
            <section class="col-sm-6">
                 @if(isset($content))
                 <div class="title">{!! $content['title'] !!}</div>
               
                <div>{!! $content['intro'] !!}</div>
                @endif
            </section>
            <section class="col-sm-6">
                @if(isset($whysherpa))
                    <div class="title">{{ $whysherpa['title'] }}</div>
                    <div>{!! $whysherpa['intro'] !!}</div>
                @endif
            </section>
        </div>
        <!-- .top-section -->
    </div>
    <section class="work-flow">
        <div class="container">
            {{--WORK--}}
            @if(isset($work))
                <section class="intro center-align">
                    <div class="title">{{ $work['title'] }}</div>
                    <h2 class="sub-title">{!! $work['intro'] !!}</h2>
                </section>
                <div class="row bs-wizard" style="border-bottom:0;">

                    @foreach($work['content'] as $data)
                    <div class="col-xs-3 bs-wizard-step complete">
                        <div class="text-center bs-wizard-stepnum">Step 1</div>
                        <div class="progress"><img src="{!! url('/sherpaassets/images/icons/arrow-step.svg') !!}" class="svg"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"><img src="{!! url('/uploads/content/' . $data['content_image'] ) !!}" class="svg"></a>
                        <div class="bs-wizard-info text-center">
                            <h4>{{ $data['content_name'] }}</h4>
                            <p>{{ $data['content_desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- .work-flow -->
    <section class="team-section" id="team">
        <div class="container">
            {{--TEAM--}}
            @if(isset($team))
                <section class="intro center-align">
                    <div class="title">{{ $team['title'] }}</div>
                    <h2 class="sub-title">{!! $team['intro'] !!}</h2>
                </section>
                <div class="row">

                    <div class="col-sm-offset-2">
                        @foreach($team['content'] as $data)
                        <div class="col-sm-3 col-xs-6">
                            <section class="team-profile">
                                <img src="{!! url('/uploads/content/' . $data['content_image'] ) !!}" class="svg">
                                <h4>{{ $data['content_name'] }}</h4>
                                <p>{{ $data['content_desc'] }}</p>
                            </section>
                            <!-- .team-profile -->
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- .team-section -->
</main>