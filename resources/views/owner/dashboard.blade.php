
@extends('layouts.master_owner')
@section('title','Dashboard')
@section('content')
<div class="content-page">
    <div class="content">
        
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
<div class="col-xl-5 col-lg-6">
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
        <!-- end card-body-->
    </div>
    <!-- end card-->
    </div>
    <!-- end col-->

    <div class="col-sm-6">
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
        </div>
        <!-- end card-body-->
    </div>
    <!-- end card-->
    </div>
    <!-- end col-->
</div>
<!-- end row -->

<div class="row">
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
        </div>
        <!-- end card-body-->
    </div>
    <!-- end card-->
    </div>
    <!-- end col-->

    <div class="col-sm-6">
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
        </div>
        <!-- end card-body-->
    </div>
    <!-- end card-->
    </div>
    <!-- end col-->
</div>
<!-- end row -->
</div>
<!-- end col -->

<div class="col-xl-7 col-lg-6">
<div class="card card-h-100">
    <div class="card-body">
    <div
        class="d-flex justify-content-between align-items-center mb-2"
    >
        <h4 class="header-title">Total battery power usage history per month</h4>
    </div>

    <div dir="ltr">
        <!-- <div
        id="high-performing-product"
        class="apex-charts"
        data-colors="#727cf5,#e3eaef"></div> -->
        <canvas id="myChart"></canvas>
    </div>
    </div>
    <!-- end card-body-->
</div>
<!-- end card-->
</div>
<!-- end col -->
</div>
<!-- end row -->

</div> <!-- End Content -->
@endsection

