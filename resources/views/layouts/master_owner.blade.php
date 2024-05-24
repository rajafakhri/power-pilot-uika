<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from coderthemes.com/hyper/saas/layouts-detached.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:21:23 GMT -->
<head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/popi-01.png')}}" />

        <!-- third party css -->
        <link href="{{asset('assets/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    </head>

    <body class="loading" data-layout-color="light" data-layout="detached" data-rightbar-onstart="true">

        <div id="preloader">
            <div id="status">
                <div class="bouncing-loader"><div ></div><div ></div><div ></div></div>
            </div>
        </div>

        <!-- Topbar Start -->
        <div class="navbar-custom topnav-navbar topnav-navbar-dark">
            <div class="container-fluid">

                <!-- LOGO -->
                <a href="../index.html" class="topnav-logo">
                    <span class="topnav-logo-lg text-white">
                        <img src="{{asset('')}}assets/images/popi2-01.png" alt="" height="64" />
                        Power Pilot
                    </span>
                    <span class="topnav-logo-sm">
                        <img src="{{asset('')}}assets/images/popi3-01.png" alt="" height="64" />
                    </span>
                </a>

                <ul class="list-unstyled topbar-menu float-end mb-0">

                    <li class="dropdown notification-list d-xl-none ">
                        <a class="nav-link dropdown-toggle arrow-none " data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-search noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0" >
                            <form class="p-3 ">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>

                    <li class="notification-list">
                        <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                            <i class="dripicons-gear noti-icon"></i>
                        </a>
                    </li>
                    <li class="notification-list">
                    <form method="POST" action="{{route('logout')}}">
            @csrf
            <a
                href="{{route('logout')}}"
                class="nav-link"
                onclick="event.preventDefault();
                this.closest('form').submit();"
                >
                <i class="mdi mdi-logout noti-icon"></i>
                <span>Logout</span>
                </a>
            </form>
                    </li>
                </ul>
                <a class="button-menu-mobile disable-btn">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <div class="app-search">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." id="top-search">
                            <span class="mdi mdi-magnify search-icon"></span>
                            <button class="input-group-text btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end Topbar -->
        
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- Begin page -->
            <div class="wrapper">

                <!-- ========== Left Sidebar Start ========== -->
                <div class="leftside-menu leftside-menu-detached">

                    <div class="leftbar-user">
                        <a href="javascript: void(0);">
                            <h4 class="leftbar-user-name">Power Meter Monitoring System</h4>
                        </a>
                    </div>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Navigation</li>

                        <li class="side-nav-item">
                          <a
                            href="{{route('home')}}"
                            class="side-nav-link"
                          >
                            <i class="uil-home-alt"></i>
                            <span> Dashboard </span>
                          </a>
                        </li>

                        <li class="side-nav-item">
                          <a
                            href="{{route('owner.users')}}"
                            class="side-nav-link"
                          >
                            <i class="dripicons-user-group"></i>
                            <span> Users </span>
                          </a>
                        </li>
                      
                      <li class="side-nav-item">
                        <a
                          href="{{route('owner.meters')}}"
                          class="side-nav-link"
                        >
                          <i class="dripicons-meter"></i>
                          <span> Meters </span>
                        </a>
                      </li>

                      <li class="side-nav-item">
                          <a
                            href="{{route('owner.battery')}}"
                            class="side-nav-link"
                          >
                            <i class="dripicons-battery-full"></i>
                            <span> Battery </span>
                          </a>
                        </li>
                    </ul>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>
                    <!-- Sidebar -left -->

                </div>
                <!-- Left Sidebar End -->
                

        @yield('content')

        </div>
        <!-- end wrapper-->
        </div>
        <!-- END Container -->

        <!-- Right Sidebar -->
        <div class="end-bar">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="end-bar-toggle float-end">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0">Settings</h5>
            </div>

            <div class="rightbar-content h-100" data-simplebar>

                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <!-- Settings -->
                    <h5 class="mt-3">Color Scheme</h5>
                    <hr class="mt-1" />

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light" id="light-mode-check" checked>
                        <label class="form-check-label" for="light-mode-check">Light Mode</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check">
                        <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                    </div>
       

                    <!-- Width -->
                    <h5 class="mt-4">Width</h5>
                    <hr class="mt-1" />
                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check" checked>
                        <label class="form-check-label" for="fluid-check">Fluid</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
                        <label class="form-check-label" for="boxed-check">Boxed</label>
                    </div>
        

                    <!-- Left Sidebar-->
                    <h5 class="mt-4">Left Sidebar</h5>
                    <hr class="mt-1" />
                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
                        <label class="form-check-label" for="default-check">Default</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked>
                        <label class="form-check-label" for="light-check">Light</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
                        <label class="form-check-label" for="dark-check">Dark</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check" checked>
                        <label class="form-check-label" for="fixed-check">Fixed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
                        <label class="form-check-label" for="condensed-check">Condensed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
                        <label class="form-check-label" for="scrollable-check">Scrollable</label>
                    </div>

                    <div class="d-grid mt-4">
                        <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
            
                        <a href="{{asset('')}}https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/"
                            class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
                    </div>
                </div> <!-- end padding-->

            </div>
        </div>

        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->

<script>
const xValues = ["January", "February", "March", "April", "May", "June", "July" , "August", "September", "November", "October", "November", "Desember"];
const yValues = [91, 83, 97, 73, 55, 67, 49, 13, 30, 15, 7, 29, 73];
const barColors = "#727cf5";

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
  }
});
</script>

        <!-- bundle -->
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/js/app.min.js')}}"></script>

        <!-- third party js -->
        <script src="{{asset('assets/js/vendor/apexcharts.min.js')}}"></script>
        <script src="{{asset('assets/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('assets/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{asset('assets/js/pages/demo.dashboard.js')}}"></script>
        <!-- end demo js-->
        @include('sweetalert::alert')        
    </body>

<!-- Mirrored from coderthemes.com/hyper/saas/layouts-detached.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:21:23 GMT -->
</html>