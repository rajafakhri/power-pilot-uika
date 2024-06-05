@extends('layouts.master_dashboard')
@section('title','Dashboard')
@section('content')

<div class="content-page 100vh">
        <div class="content">
          <!-- Topbar Start -->
          <div class="navbar-custom">
            <ul class="list-unstyled topbar-menu float-end mb-0">
              <li class="dropdown notification-list d-lg-none">
                <a
                  class="nav-link dropdown-toggle arrow-none"
                  data-bs-toggle="dropdown"
                  href="#"
                  role="button"
                  aria-haspopup="false"
                  aria-expanded="false"
                >
                  <i class="dripicons-search noti-icon"></i>
                </a>
                <div
                  class="dropdown-menu dropdown-menu-animated dropdown-lg p-0"
                >
                  <form class="p-3">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Search ..."
                      aria-label="Recipient's username"
                    />
                  </form>
                </div>
              </li>

              <li class="notification-list">
                <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                  <i class="dripicons-gear noti-icon"></i>
                </a>
              </li>

              <li class="notification-list">
                <a
                    href="../login/pages-login.html"
                    class="nav-link"
                  >
                    <i class="mdi mdi-logout noti-icon"></i>
                    <span>Logout</span>
                  </a>
              </li>
            </ul>
            <button class="button-menu-mobile open-left">
              <i class="mdi mdi-menu"></i>
            </button>
            <div class="app-search dropdown d-none d-lg-block">
              <form>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control dropdown-toggle"
                    placeholder="Search..."
                    id="top-search"
                  />
                  <span class="mdi mdi-magnify search-icon"></span>
                  <button class="input-group-text btn-primary" type="submit">
                    Search
                  </button>
                </div>
              </form>
            </div>
          </div>
          <!-- end Topbar -->

          <!-- Start Content-->
          <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
              <div class="col-12">
                <div class="page-title-box">
                  <div class="page-title-right">
                  </div>
                  <h4 class="page-title">Power Meter Monitoring System</h4>
                </div>
              </div>
            </div>
            <!-- end page title -->

            <div class="row">
              <!-- <div class="col-xl-5 col-lg-6">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="card widget-flat">
                      <div class="card-body">
                        <h5
                          class="text-muted fw-normal mt-0"
                          title="Number of Customers">
                          Today Energy
                        </h5>
                        <h3 class="mt-3 mb-3">36 kWh</h3>
                        <p class="mb-0 text-muted">
                          <span class="text-success me-2"
                            ><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span
                          >
                          <span class="text-nowrap">Since last day</span>
                        </p>
                      </div>
                       end card-body
                     </div> 
                     end card-->
                  <!-- </div> -->
                  <!-- end col-->

                  <!-- <div class="col-sm-6">
                    <div class="card widget-flat">
                      <div class="card-body">
                        <h5
                          class="text-muted fw-normal mt-0"
                          title="Number of Orders">
                          Week Energy
                        </h5>
                        <h3 class="mt-3 mb-3">80 kWh</h3>
                        <p class="mb-0 text-muted">
                          <span class="text-danger me-2"
                            ><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span
                          >
                          <span class="text-nowrap">Since last week</span>
                        </p>
                      </div> -->
                      <!-- end card-body-->
                    <!-- </div> -->
                    <!-- end card-->
                  <!-- </div> -->
                  <!-- end col-->
                <!-- </div> -->
                <!-- end row -->

                <!-- <div class="row">
                  <div class="col-sm-6">
                    <div class="card widget-flat">
                      <div class="card-body">
                        <h5
                          class="text-muted fw-normal mt-0"
                          title="Average Revenue">
                          Month Energy
                        </h5>
                        <h3 class="mt-3 mb-3">60 kWh</h3>
                        <p class="mb-0 text-muted">
                          <span class="text-danger me-2"
                            ><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span
                          >
                          <span class="text-nowrap">Since last month</span>
                        </p>
                      </div> -->
                      <!-- end card-body-->
                    <!-- </div> -->
                    <!-- end card-->
                  <!-- </div> -->
                  <!-- end col-->

                  <!-- <div class="col-sm-6">
                    <div class="card widget-flat">
                      <div class="card-body">
                        <h5 class="text-muted fw-normal mt-0" title="Growth">
                          Total Energy
                        </h5>
                        <h3 class="mt-3 mb-3">30 kWh</h3>
                        <p class="mb-0 text-muted">
                          <span class="text-success me-2"
                            ><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span
                          >
                          <span class="text-nowrap">Since last month</span>
                        </p>
                      </div> -->
                      <!-- end card-body-->
                    <!-- </div> -->
                    <!-- end card-->
                  <!-- </div> -->
                  <!-- end col-->
                <!-- </div> -->
                <!-- end row -->
              <!-- </div> --> 
              <!-- end col -->

              <div class="col-xl-4 col-lg-6">
                <div class="card card-h-100">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <h4 class="header-title">Total battery power usage history daily</h4>
                    </div>
                                     
  
                    <div dir="ltr">
                      <!-- <div
                        id="ischart"
                        class="apex-charts"
                        data-colors="#727cf5,#e3eaef"></div> -->
                        <canvas id="myChart1"></canvas>
                    </div>
                  
                  </div>
                  <!-- end card-body-->
                </div>
                <!-- end card-->
              </div>
              
                <div class="col-xl-4 col-lg-6">
                  <div class="card card-h-100">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="header-title">Total battery power usage history monthly</h4>
                      </div>


  
                      <div dir="ltr">
                        <!-- <div
                          id="ischart"
                          class="apex-charts"
                          data-colors="#727cf5,#e3eaef"></div> -->
                          <canvas id="myChart"></canvas>
                      </div>
                    
                    </div>
                    <!-- end card-body-->
                  </div>
                  <!-- end card-->
                </div>
  
  
                <div class="col-xl-4 col-lg-6">
                  <div class="card card-h-100">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="header-title">Total battery power usage history yearly</h4>
                      </div>
  
                      <div dir="ltr">
                        <!-- <div
                          id="ischart"
                          class="apex-charts"
                          data-colors="#727cf5,#e3eaef"></div> -->
                          <canvas id="myChart2"></canvas>
                      </div>
                  
                  </div>
                  <!-- end card-body-->
                </div>
                <!-- end card-->
              </div>
              
          
              <!-- end col -->
            </div>
            <!-- end row -->

          </div>
          <!-- container -->
        </div>
        <!-- content -->
      </div>

      <script>
      const xValuesD = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
      ];
      const xValuesM = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "Desember",
      ];
      const xValuesY = [2022, 2023, 2024];
      const defaultBarColor = "#727cf5";
      const highlightColor = "#f5727c";

      const barColorsD = xValuesD.map((day) =>
        day === "Saturday" ? highlightColor : defaultBarColor
      );
      new Chart("myChart1", {
        type: "bar",
        data: {
          labels: xValuesD,
          datasets: [
            {
              backgroundColor: barColorsD,
              data: [91, 83, 97, 73, 55, 67, 49, 0],
            },
          ],
        },
        options: {
          legend: { display: false },
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });

      const barColorsM = xValuesM.map((month) =>
        month === "June" ? highlightColor : defaultBarColor
      );
      new Chart("myChart", {
        type: "bar",
        data: {
          labels: xValuesM,
          datasets: [
            {
              backgroundColor: barColorsM,
              data: [91, 83, 97, 73, 55, 67, 49, 13, 30, 7, 29, 73, 0],
            },
          ],
        },
        options: {
          legend: { display: false },
        },
      });

      const barColorsY = xValuesY.map((year) =>
        year === 2024 ? highlightColor : defaultBarColor
      );
      new Chart("myChart2", {
        type: "bar",
        data: {
          labels: xValuesY,
          datasets: [
            {
              backgroundColor: barColorsY,
              data: [91, 83, 97, 0],
            },
          ],
        },
        options: {
          legend: { display: false },
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    </script>

@endsection