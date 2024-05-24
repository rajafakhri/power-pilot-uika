<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from coderthemes.com/hyper/saas/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:18:47 GMT -->
  <head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      content="A fully featured admin theme which can be used to build CRM, CMS, etc."
      name="description"
    />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/popi-01.png')}}" />

    <!-- third party css -->
    <link
      href="{{asset('assets/css/vendor/jquery-jvectormap-1.2.2.css')}}"
      rel="stylesheet"
      type="text/css"
    />
    <!-- third party css end -->

    <!-- App css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link
      href="{{asset('assets/css/app.min.css')}}"
      rel="stylesheet"
      type="text/css"
      id="app-style"
    />
    <link href="{{asset('assets/select2/css/select2.min.css')}}" rel="stylesheet" />

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/select2/js/select2.min.js')}}"></script>

    <!-- <style type="text/css">*{transition: 0.5s ease; scroll-behavior: smooth;}</style> -->
  </head>

  <body
    class="loading"
    data-layout-color="light"
    data-leftbar-theme="dark"
    data-layout-mode="fluid"
    data-rightbar-onstart="true"
  >

    <!-- Pre-loader -->
      <!-- <div id="preloader">
          <div id="status">
              <div class="bouncing-loader"><div ></div><div ></div><div ></div></div>
          </div>
      </div> -->
    <!-- End Preloader-->

    <!-- Begin page -->
    <div class="wrapper">
      <!-- ========== Left Sidebar Start ========== -->
      <div class="leftside-menu">
        <!-- LOGO -->
        <a href="#" class="logo text-center logo-light">
          <span class="logo-lg text-white">
            <img src="{{asset('assets/images/popi3-01.png')}}" alt="" height="64" />
            Power Pilot
          </span>
          <span class="logo-sm">
            <img src="{{asset('assets/images/popi2-01.png')}}" alt="" height="64" />
          </span>
        </a>

        <!-- LOGO -->
        <a href="/" class="logo text-center logo-dark">
          <span class="logo-lg text-white">
            <img src="{{asset('assets/images/popi3-01.png')}}" alt="" height="64" />
            Power Pilot
          </span>
          <span class="logo-sm">
            <img src="{{asset('assets/images/popi2-01.png')}}" alt="" height="64" />
          </span>
        </a>

        <div class="h-100" id="leftside-menu-container" data-simplebar>
          <!--- Sidemenu -->
          <ul class="side-nav">
            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
              <a
                href="{{route('home')}}"
                class="side-nav-link"
              >
                <i class="uil-home-alt"></i>
                <span> Dashboards </span>
              </a>
            </li>
            <li class="side-nav-item">
              <a
                href="{{route('users.index')}}"
                class="side-nav-link"
              >
                <i class="dripicons-user-group"></i>
                <span> Users </span>
              </a>
            </li>
            <li class="side-nav-item">
              <a
                href="{{route('meters.index')}}"
                class="side-nav-link"
              >
                <i class="dripicons-meter"></i>
                <span> Meters </span>
              </a>
            </li>
            <li class="side-nav-item">
              <a
                href="{{route('battery.index')}}"
                class="side-nav-link"
              >
                <i class="dripicons-battery-full"></i>
                <span> Battery </span>
              </a>
            </li>
          <!-- End Sidebar -->

          <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
      </div>
      <!-- Left Sidebar End -->
      @yield('content')

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
            <strong>Customize </strong> the overall color scheme, sidebar menu,
            etc.
          </div>

          <!-- Settings -->
          <h5 class="mt-3">Color Scheme</h5>
          <hr class="mt-1" />

          <div class="form-check form-switch mb-1">
            <input
              class="form-check-input"
              type="checkbox"
              name="color-scheme-mode"
              value="light"
              id="light-mode-check"
              checked
            />
            <label class="form-check-label" for="light-mode-check"
              >Light Mode</label
            >
          </div>

          <div class="form-check form-switch mb-1">
            <input
              class="form-check-input"
              type="checkbox"
              name="color-scheme-mode"
              value="dark"
              id="dark-mode-check"
            />
            <label class="form-check-label" for="dark-mode-check"
              >Dark Mode</label
            >
          </div>

          <!-- Width -->
          <h5 class="mt-4">Width</h5>
          <hr class="mt-1" />
          <div class="form-check form-switch mb-1">
            <input
              class="form-check-input"
              type="checkbox"
              name="width"
              value="fluid"
              id="fluid-check"
              checked
            />
            <label class="form-check-label" for="fluid-check">Fluid</label>
          </div>

          <div class="form-check form-switch mb-1">
            <input
              class="form-check-input"
              type="checkbox"
              name="width"
              value="boxed"
              id="boxed-check"
            />
            <label class="form-check-label" for="boxed-check">Boxed</label>
          </div>

          <!-- Left Sidebar-->
          <h5 class="mt-4">Left Sidebar</h5>
          <hr class="mt-1" />
          <div class="form-check form-switch mb-1">
            <input
              class="form-check-input"
              type="checkbox"
              name="theme"
              value="default"
              id="default-check"
            />
            <label class="form-check-label" for="default-check">Default</label>
          </div>

          <div class="form-check form-switch mb-1">
            <input
              class="form-check-input"
              type="checkbox"
              name="theme"
              value="light"
              id="light-check"
              checked
            />
            <label class="form-check-label" for="light-check">Light</label>
          </div>

          <div class="form-check form-switch mb-3">
            <input
              class="form-check-input"
              type="checkbox"
              name="theme"
              value="dark"
              id="dark-check"
            />
            <label class="form-check-label" for="dark-check">Dark</label>
          </div>

          <div class="form-check form-switch mb-1">
            <input
              class="form-check-input"
              type="checkbox"
              name="compact"
              value="fixed"
              id="fixed-check"
              checked
            />
            <label class="form-check-label" for="fixed-check">Fixed</label>
          </div>

          <div class="form-check form-switch mb-1">
            <input
              class="form-check-input"
              type="checkbox"
              name="compact"
              value="condensed"
              id="condensed-check"
            />
            <label class="form-check-label" for="condensed-check"
              >Condensed</label
            >
          </div>

          <div class="form-check form-switch mb-1">
            <input
              class="form-check-input"
              type="checkbox"
              name="compact"
              value="scrollable"
              id="scrollable-check"
            />
            <label class="form-check-label" for="scrollable-check"
              >Scrollable</label
            >
          </div>

          <div class="d-grid mt-4">
            <button class="btn btn-primary" id="resetBtn">
              Reset to Default
            </button>
          </div>
        </div>
        <!-- end padding-->
      </div>
    </div>

    <div class="rightbar-overlay"></div>
    <!-- /End-bar -->

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

  <!-- Mirrored from coderthemes.com/hyper/saas/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:20:07 GMT -->
</html>
