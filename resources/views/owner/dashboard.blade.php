
@extends('layouts.master_owner')
@section('title','Dashboard')
@section('content')
<?php
  use Carbon\Carbon;
  $day = Carbon::now()->format('d');
  $month = Carbon::now()->format('m');
  $year = Carbon::now()->format('Y');    
?>
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
                      <canvas id="myChartM"></canvas>
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
        <?php for($i=1;$i <= 31;$i++){echo '"'.$i.'"',",";}?>
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
      const xValuesY = [
        <?php 
        for($y=$year-5;$y <= $year;$y++){
            echo $y.",";
        }
        ?>];
      const defaultBarColor = "#727cf5";
      const highlightColor = "#f5727c";

      const barColorsD = xValuesD.map((day) =>
        day === "<?php echo $day; ?>" ? highlightColor : defaultBarColor
      );
      new Chart("myChart1", {
        type: "bar",
        data: {
          labels: xValuesD,
          datasets: [
            {
              backgroundColor: barColorsD,
              data: [<?php 
                for($i=1;$i <= 31;$i++){                   
                  $usage_day = DB::table('record_elec_use')->whereDay('created_at', $i)->whereMonth('created_at',$month)->whereYear('created_at', $year)->sum('elec_usage');
                  echo $usage_day,",";
                }
                ?>],
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
        month === "<?php echo Carbon::now()->format('F') ?>" ? highlightColor : defaultBarColor
      );
      new Chart("myChartM", {
        type: "bar",
        data: {
          labels: xValuesM,
          datasets: [
            {
              backgroundColor: barColorsM,
              data: [<?php 
                for($v=1;$v <= 12;$v++){                   
                  $usage_month = DB::table('record_elec_use')->whereMonth('created_at',$v)->sum('elec_usage');
                  echo $usage_month,",";
                }

                ?>],
            },
          ],
        },
        options: {
          legend: { display: false },
        },
      });

      const barColorsY = xValuesY.map((year) =>
        year === <?php echo $year; ?> ? highlightColor : defaultBarColor
      );
      new Chart("myChart2", {
        type: "bar",
        data: {
          labels: xValuesY,
          datasets: [
            {
              backgroundColor: barColorsY,
              data: [
                <?php 

                for($y=$year-5;$y <= $year;$y++){
                  $data_years = DB::table('record_elec_use')->whereYear('created_at',$y)->sum('elec_usage');
                      echo $data_years.",";
                  }
                ?>],
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

