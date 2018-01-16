<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! gravatarUrl(Sentinel::getUser()->email) !!}" class="img-circle" alt="User Image" />

            </div>
            <div class="pull-left info">
                <p>{{ Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name }}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="Search..."/>--}}
              {{--<span class="input-group-btn">--}}
                {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
              {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ setActive('admin') }}"><a href="{{ url(getLang() . '/admin') }}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a></li>

            <li class="{{ setActive('admin/menu*') }}">
                <a href="{{ url(getLang() . '/admin/menu') }}"> <i class="fa fa-bars"></i> <span>Menu</span> </a>
            </li>
            <!--  <li class="{{ setActive('admin/footermenu*') }}">
                <a href="{{ url(getLang() . '/admin/footermenu') }}"> <i class="fa fa-bars"></i> <span>Footer Menu</span> </a>
            </li>
 -->
           

            

            {{--DESTINATIONS--}}
            <li>
                <a href="{{ route(getLang() . '.admin.destination.index') }}">
                    <i class="fa fa-bus"></i>
                    <span>Manage Destinations</span>
                </a>
                <ul>
                    <li><a href="{{ route(getLang() . '.admin.destination.create') }}">Add Destination</a></li>
                </ul>
            </li>

            {{--ACTIVITIES--}}
            <li>
                <a href="{{ route(getLang() . '.admin.activity.index') }}">
                    <i class="fa fa-bus"></i>
                    <span>Manage Activities</span>
                </a>
                <ul>
                    <li><a href="{{ route(getLang() . '.admin.activity.create') }}">Add Activity</a></li>
                </ul>
            </li>

            {{--Region--}}
            <li class="treeview {{ setActive('admin/Region*') }}"><a href="{{ url(getLang() . '/admin/region') }}"> <i class="fa fa-money packagelink"></i> <span>Manage Regions</span></a>
                <ul class="">
                    <li><a href="{{ url(getLang() . '/admin/region') }}"><i class="fa fa-calendar"></i> View all region</a></li>
                    <li><a href="{{ url(getLang() . '/admin/region/create') }}"><i class="fa fa-plus-square"></i> Add new region</a></li>    
                    
                </ul>
            </li>

             {{--PACKAGES--}}
            <li class="treeview {{ setActive('admin/package*') }}"><a href="{{ url(getLang() . '/admin/package') }}"> <i class="fa fa-money packagelink"></i> <span>Manage Packages</span></a>
                <ul class="">
                    <li><a href="{{ url(getLang() . '/admin/package') }}"><i class="fa fa-calendar"></i> View all packages</a></li>
                    <li><a href="{{ url(getLang() . '/admin/package/create') }}"><i class="fa fa-plus-square"></i> Add new package</a></li>    
                    {{--<li><a href="{{ url(getLang() . '/admin/packagecategory') }}"><i class="fa fa-archive"></i> Category</a></li>--}}
                </ul>
            </li>

            {{--TESTIMONIAL--}}
            <li>
                <a href="{{ route(getLang() . '.admin.testimonial.index') }}">
                    <i class="fa fa-bus"></i>
                    <span>Manage Testimonial</span>
                </a>
                <ul>
                    <li><a href="{{ route(getLang() . '.admin.testimonial.create') }}">Add Testimonial</a></li>
                </ul>
            </li>



            {{--Articles--}}
            {{--<li class="treeview {{ setActive('admin/article*') }}"><a href="{{ url(getLang() . '/admin/article') }}"> <i class="fa fa-book"></i> <span>Articles</span> </a>--}}
                {{--<ul class="">--}}
                    {{--<li><a href="{{ url(getLang() . '/admin/article') }}"><i class="fa fa-archive"></i> All Articles</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ url(getLang() . '/admin/article/create') }}"><i class="fa fa-plus-square"></i> Add Article</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ url(getLang() . '/admin/category') }}"><i class="fa fa-archive"></i> Category</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            <!-- News -->
            {{--<li class="treeview {{ setActive('admin/news*') }}"><a href="{{ url(getLang() . '/admin/news') }}"> <i class="fa fa-th"></i> <span>News</span> </a>--}}
                {{--<ul class="">--}}
                    {{--<li><a href="{{ url(getLang() . '/admin/news') }}"><i class="fa fa-calendar"></i> All News</a>--}}
                    {{--</li>--}}
                    {{--<li><a href="{{ url(getLang() . '/admin/news/create') }}"><i class="fa fa-plus-square"></i> Add News</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            <!-- {{--PAGES--}}
            <li class="treeview {{ setActive('admin/page*') }}"><a href="{{ url(getLang() . '/admin/page') }}"> <i class="fa fa-bookmark"></i> <span>Pages</span> </a>
                <ul class="">
                    <li><a href="{{ url(getLang() . '/admin/page') }}"><i class="fa fa-folder"></i> All Pages</a>
                    </li>
                    <li><a href="{{ url(getLang() . '/admin/page/create') }}"><i class="fa fa-plus-square"></i> Add Page</a>
                    </li>
                </ul>
            </li> -->

            {{--CONTENTS--}}
            <li class="treeview {{ setActive('admin/content*') }}"><a href="{{ url(getLang() . '/admin/content') }}"> <i class="fa fa-bookmark"></i> <span>About Us Page</span> </a>
               <!--  <ul class="">
                    <li><a href="{{ url(getLang() . '/admin/content') }}"><i class="fa fa-folder"></i> All Contents</a>
                    </li>
                    <li><a href="{{ url(getLang() . '/admin/content/create') }}"><i class="fa fa-plus-square"></i> Add Content</a>
                    </li>
                </ul> -->
            </li>
<!-- 
            {{--Galleries--}}
            <li class="treeview {{ setActive(['admin/photo-gallery*', 'admin/video*']) }}"><a href="#"> <i class="fa fa-picture-o"></i> <span>Galleries</span>
                    <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="">
                    <li>
                        <a href="{{ url(getLang() . '/admin/photo-gallery') }}"><i class="fa fa-camera"></i> Photo Galleries</a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="{{ url(getLang() . '/admin/video') }}"><i class="fa fa-play-circle-o"></i> Video Galleries</a>--}}
                    {{--</li>--}}

                </ul>
            </li> -->

            {{--Plugins--}}
            {{--<li class="treeview {{ setActive('admin/slider*') }}"><a href="#"> <i class="fa fa-tint"></i> <span>Plugins</span>--}}
                    {{--<i class="fa fa-angle-left pull-right"></i> </a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{ url(getLang() . '/admin/slider') }}"><i class="fa fa-toggle-up"></i> Sliders</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            <li><a href="{{ url(getLang() . '/admin/slider') }}"><i class="fa fa-toggle-up"></i> Sliders</a></li>

            {{--Projects--}}
            {{--<li class="treeview {{ setActive('admin/project*') }}"><a href="#"> <i class="fa fa-gears"></i> <span>Projects</span>--}}
                    {{--<i class="fa fa-angle-left pull-right"></i> </a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{ url(getLang() . '/admin/project') }}"><i class="fa fa-gear"></i> All Projects</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ url(getLang() . '/admin/project/create') }}"><i class="fa fa-plus-square"></i> Add Project</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--Faqs--}}
            {{--<li class="treeview {{ setActive('admin/faq*') }}"><a href="#"> <i class="fa fa-question"></i> <span>Faqs</span>--}}
                    {{--<i class="fa fa-angle-left pull-right"></i> </a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{ url(getLang() . '/admin/faq') }}"><i class="fa fa-question-circle"></i> All Faq</a></li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ url(getLang() . '/admin/faq/create') }}"><i class="fa fa-plus-square"></i> Add Faq</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--Users--}}
            <li class="treeview {{ setActive(['admin/user*', 'admin/group*']) }}"><a href="#"> <i class="fa fa-user"></i> <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url(getLang() . '/admin/user') }}"><i class="fa fa-user"></i> All Users</a>
                    </li>
                    <li><a href="{{ url(getLang() . '/admin/role') }}"><i class="fa fa-group"></i> Add Role</a>
                    </li>
                </ul>
            </li>

            {{--Records--}}
       

            {{--Settings--}}
            <li class="{{ setActive('admin/settings*') }}">
                <a href="{{ url(getLang() . '/admin/settings') }}"> <i class="fa fa-gear"></i> <span>Settings</span> </a>
            </li>

            {{--Logout--}}
            <li class="{{ setActive('admin/logout*') }}">
                <a href="{{ url('/admin/logout') }}"> <i class="fa fa-sign-out"></i> <span>Logout</span> </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>