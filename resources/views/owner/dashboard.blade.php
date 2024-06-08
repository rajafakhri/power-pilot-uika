
@extends('layouts.master_owner')
@section('title','Dashboard')
@section('content')
<div class="content-page">
          <div class="content">
            <!-- start page title -->
            <div class="row">
              <div class="col-12">
                <div class="page-title-box">
                  <div class="page-title-right"></div>
                  <h4 class="page-title">Power Meter Monitoring System</h4>
                </div>
              </div>
            </div>
            <!-- end page title -->

            <div class="row">    
              <div class="col-xl-4 col-lg-6">
                <div class="card card-h-100">
                  <div class="card-body">
                    <div
                      class="d-flex justify-content-between align-items-center mb-2"
                    >
                      <h4 class="header-title">
                        Total battery power usage history daily
                      </h4>
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
                    <div
                      class="d-flex justify-content-between align-items-center mb-2"
                    >
                      <h4 class="header-title">
                        Total battery power usage history monthly
                      </h4>
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
                    <div
                      class="d-flex justify-content-between align-items-center mb-2"
                    >
                      <h4 class="header-title">
                        Total battery power usage history yearly
                      </h4>
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
          <!-- End Content -->
</div>
<!-- content-page -->
 
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

