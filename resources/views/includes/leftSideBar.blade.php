<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::asset('public/'.$user->profile_picture_path) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$user->user_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        
        <!-- <form role="form"  class="sidebar-form">
           
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button  name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> -->
        <form role="form" method="get" id="libraryPostForm" action="{{ url('/search') }}" class="sidebar-form">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." value="<?php if( isset($_GET['q']) ) { echo $_GET['q']; } ?>"">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form 
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{ url('/user_profile') }}"><i class="fa fa-star"></i> <span>Manage Profile</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-globe"></i> <span>Q&A</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/questions/index') }}"><i class="fa fa-odnoklassniki"></i>All </a></li>
                            <li><a href="{{ url('/questions/create') }}"><i class="fa fa-external-link "></i>Create Q&A</a></li>
                        </ul>
                    </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Library</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/libraries/index') }}"><i class="fa fa-book "></i>All</a></li>
                            <li><a href="{{ url('/libraries/create') }}"><i class="fa fa-newspaper-o"></i>Add To Libraries</a></li>
                        </ul>
                    </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar"></i> <span>Event Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/events') }}"><i class="fa fa-calendar"></i>All</a></li>
                            <li><a href="{{ url('/events?mine=true') }}"><i class="fa fa-calendar-plus-o "></i>My Events</a></li>
                        </ul>
                    </li>

             <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar"></i> <span>Event Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/user/event/bookings') }}"><i class="fa fa-credit-card"></i>All</a></li>
                            <li><a href=""><i class="fa fa-credit-card "></i>Invoice</a></li>
                        </ul>
                    </li>

            <li><a href="{{ url('/user/messages') }}"><i class="fa fa-comments-o"></i> <span>Chats</span></a></li>
            @if($user->user_type== Illuminate\Support\Facades\Config::get('constants.User_Type_Admin'))
            <li><a href=""><i class="fa fa-comments-o"></i> <span>Chats Manager</span></a></li>
            <li>
                <a href="#"><i class="fa fa-share"></i>University Page
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/university/basicInfo') }}"><i class="fa fa-external-link"> Add Basic Info</i></a></li>
                    <li><a href="{{ url('/admin/university/newsForm') }}"><i class="fa fa-external-link"> Add News</i></a></li>

                </ul>
            </li>
            <li><a href="{{ url('/admin/management') }}"><i class="fa fa-paper-plane"></i> <span>User Management</span></a></li>
            <li><a href="{{ url('/admin/notice/form') }}"><i class="fa fa-paper-plane"></i> <span>Generate Notice</span></a></li>
            <li><a href="{{ url('/admin/feedback') }}"><i class="fa fa-paper-plane"></i> <span>View Feedbacks</span></a></li>
            @endif

            <li><a href="{{ url('/user/notice/board') }}"><i class="fa fa-newspaper-o"></i> <span>Notice Board</span></a></li>
            <li><a href="{{ url('/user/feedback/form') }}"><i class="fa fa-paper-plane"></i> <span>Feedback</span></a></li>
            <li><a href="{{ url('/user/setting') }}"><i class="fa fa-gears"></i> <span>Setting</span></a></li>
            <li>
                <a href="#"><i class="fa fa-share"></i>Help Center
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/user/helpcenter/Welcome') }}"><i class="fa fa-external-link"> Welcome - Getting started</i></a></li>
                    <li><a href="{{ url('/user/helpcenter/AccountManagement') }}"><i class="fa fa-external-link"> Account Management</i></a></li>
                    <li><a href="{{ url('/user/helpcenter/KnowledgeCenter') }}"><i class="fa fa-external-link"> Knowledge Center</i></a></li>
                    <li><a href="{{ url('/user/helpcenter/EventManagement') }}"><i class="fa fa-external-link"> Event Management</i></a></li>
                    <li><a href="{{ url('/user/helpcenter/MessagingChatting') }}"><i class="fa fa-external-link"> Chats</i></a></li>
                    <li><a href="{{ url('/user/helpcenter/TermsConditions') }}"><i class="fa fa-external-link"> Terms and Conditions</i></a></li>
                    <li><a href="{{ url('/user/helpcenter/Privacy') }}"><i class="fa fa-external-link"> Privacy</i></a></li>
                    <li><a href="{{ url('/user/helpcenter/CookiePolicy') }}"><i class="fa fa-external-link"> Cookie Policy</i></a></li>
                    <li><a href="{{ url('/user/helpcenter/Faq') }}"><i class="fa fa-external-link"> FAQ</i></a></li>
                    <li><a href="{{ url('/user/helpcenter/ContactUs') }}"><i class="fa fa-external-link"> Contact Us</i></a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>