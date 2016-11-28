<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UneLeap | Need Help ?</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue fixed" data-spy="scroll" data-target="#scrollspy">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <!-- Logo -->
        <a href="/login" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>E</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>UneLeap</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <div class="sidebar" id="scrollspy">

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="nav sidebar-menu">
            <li class="header">TABLE OF CONTENTS</li>
            <li class="active"><a href="#introduction"><i class="fa fa-circle-o"></i> Introduction</a></li>
            <li><a href="#dependencies"><i class="fa fa-circle-o"></i> Dependencies</a></li>
            <li><a href="#license"><i class="fa fa-circle-o"></i> License</a></li>
            
          </ul>
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <h1>
            AdminLTE Documentation
            <small>Current version 2.3.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Need Help?</li>
          </ol>
        </div>

        <!-- Main content -->
        <div class="content body">

<section id="introduction">
  <h2 class="page-header"><a href="#introduction">Introduction</a></h2>
  <p class="lead">
    <b>AdminLTE</b> is a popular open source WebApp template for admin dashboards and control panels.
    It is a responsive HTML template that is based on the CSS framework Bootstrap 3.
    It utilizes all of the Bootstrap components in its design and re-styles many
    commonly used plugins to create a consistent design that can be used as a user
    interface for backend applications. AdminLTE is based on a modular design, which
    allows it to be easily customized and built upon. This documentation will guide you through
    installing the template and exploring the various components that are bundled with the template.
  </p>
</section><!-- /#introduction -->




<!-- ============================================================= -->

<section id="dependencies">
  <h2 class="page-header"><a href="#dependencies">Dependencies</a></h2>
  <p class="lead">AdminLTE depends on two main frameworks.
    The downloadable package contains both of these libraries, so you don't have to manually download them.</p>
  <ul class="bring-up">
    <li><a href="http://getbootstrap.com" target="_blank">Bootstrap 3</a></li>
    <li><a href="http://jquery.com/" target="_blank">jQuery 1.11+</a></li>
    <li><a href="#plugins">All other plugins are listed below</a></li>
  </ul>
</section>



<!-- ============================================================= -->



<!-- ============================================================= -->

<section id="components" data-spy="scroll" data-target="#scrollspy-components">
  <h2 class="page-header"><a href="#components">Components</a></h2>
  <div class="callout callout-info lead">
    <h4>Reminder!</h4>
    <p>
      AdminLTE uses all of Bootstrap 3 components. It's a good start to review
      the <a href="http://getbootstrap.com">Bootstrap documentation</a> to get an idea of the various components
      that this documentation <b>does not</b> cover.
    </p>
  </div>
  <div class="callout callout-danger lead">
    <h4>Tip!</h4>
    <p>
      If you go through the example pages and would like to copy a component, right-click on
      the component and choose "inspect element" to get to the HTML quicker than scanning
      the HTML page.
    </p>
  </div>
  <h3 id="component-main-header">Main Header</h3>
  <p class="lead">The main header contains the logo and navbar. Construction of the
    navbar differs slightly from Bootstrap because it has components that Bootstrap doesn't provide.
    The navbar can be constructed in two way. This an example for the normal navbar and next we will provide an example for
    the top nav layout.</p>
  <div class="box box-solid">
    <div class="box-body" style="position: relative;">
      <span class="eg">Main Header Example</span>
      <header class="main-header" style="position: relative;">
        <!-- Logo -->
        <a href="index2.html" class="logo" style="position: relative;"><b>Admin</b>LTE</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar" role="navigation" style="border: 0;max-height: 50px;">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    </div>
  </div>
  
 
  <!-- ===================================================================== -->


<!-- ============================================================= -->

<section id="license">
  <h2 class="page-header"><a href="#license">License</a></h2>
  <h3>AdminLTE</h3>
  <p class="lead">
    AdminLTE is an open source project that is licensed under the <a href="http://opensource.org/licenses/MIT">MIT license</a>.
    This allows you to do pretty much anything you want as long as you include
    the copyright in "all copies or substantial portions of the Software."
    Attribution is not required (though very much appreciated).
  </p>
</section>


        </div><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.6
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="/">UneLeap</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <div class="pad">
          This is an example of the control sidebar.
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    <script src="docs.js"></script>
  </body>
</html>
