@extends('layouts.master_dashboard')
@section('title','Dashboard')
@section('content')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
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

        <div
        class="dropdown-menu dropdown-menu-animated dropdown-lg"
        id="search-dropdown"
        >
        <!-- item-->
        <div class="dropdown-header noti-title">
            <h5 class="text-overflow mb-2">
            Found <span class="text-danger">17</span> results
            </h5>
        </div>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="uil-notes font-16 me-1"></i>
            <span>Analytics Report</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="uil-life-ring font-16 me-1"></i>
            <span>How can I help you?</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="uil-cog font-16 me-1"></i>
            <span>User profile settings</span>
        </a>

        <!-- item-->
        <div class="dropdown-header noti-title">
            <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
        </div>

        <div class="notification-list">
            <!-- item-->
            <a
            href="javascript:void(0);"
            class="dropdown-item notify-item"
            >
            <div class="d-flex">
                <img
                class="d-flex me-2 rounded-circle"
                src="{{asset('assets/images/users/avatar-2.jpg')}}"
                alt="Generic placeholder image"
                height="32"
                />
                <div class="w-100">
                <h5 class="m-0 font-14">Erwin Brown</h5>
                <span class="font-12 mb-0">UI Designer</span>
                </div>
            </div>
            </a>

            <!-- item-->
            <a
            href="javascript:void(0);"
            class="dropdown-item notify-item"
            >
            <div class="d-flex">
                <img
                class="d-flex me-2 rounded-circle"
                src="{{asset('assets/images/users/avatar-5.jpg')}}"
                alt="Generic placeholder image"
                height="32"
                />
                <div class="w-100">
                <h5 class="m-0 font-14">Jacob Deo</h5>
                <span class="font-12 mb-0">Developer</span>
                </div>
            </div>
            </a>
        </div>
        </div>
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
    <!-- start page title -->
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

                <div dir="ltr" style="height: 50px">
                   <div
                    id="high-performing-product"
                    class="apex-charts"
                    data-colors="#727cf5,#e3eaef"></div> 
                    <canvas id="myChart"></canvas>
                </div>
              </div>
              <!-- end card-body-->
            </div>
            <!-- end card-->
          </div>
          <!-- end col -->
</div>
        <br>
        <br>

        <!-- TABEL -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-xl-8">
                                <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
                                    <div class="col-auto">
                                        <label for="inputPassword2" class="visually-hidden">Search</label>
                                        <input type="search" class="form-control" id="inputPassword2" placeholder="Search ID...">
                                    </div>
                                    <div class="col-auto">
                                      <label for="inputPassword2" class="visually-hidden">Search</label>
                                        <input type="search" class="form-control" id="inputPassword2" placeholder="Search Nama...">


                                        <!-- <button class="button-menu-mobile open-left">
                                          <i class="mdi mdi-menu"></i>
                                        </button> -->

                                        
                                        <!-- <div class="d-flex align-items-center">
                                            <label for="status-select" class="me-2"></label>
                                            <select class="form-select" id="status-select">
                                                <option selected>Choose...</option> -->
                                                <!-- <option value="1">Paid</option>
                                                <option value="2">Awaiting Authorization</option>
                                                <option value="3">Payment failed</option>
                                                <option value="4">Cash On Delivery</option>
                                                <option value="5">Fulfilled</option>
                                                <option value="6">Unfulfilled</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </form>                            
                            </div>
                            <!-- <div class="col-xl-4">
                                <div class="text-xl-end mt-xl-0 mt-2">
                                    <button type="button" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add New Order</button>
                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                </div>
                            </div>   end col -->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <!-- <div class="form-check"> -->
                                                <!-- <input type="checkbox" class="form-check-input" id="customCheck1"> -->
                                                <!-- <label class="form-check-label" for="customCheck1">&nbsp;</label> -->
                                            <!-- </div> -->
                                        </th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Export</th>
                                        <th>Import</th>
                                        <!-- <th>Order Status</th> -->
                                        <!-- <th style="width: 125px;">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <!-- <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div> -->
                                        </td>
                                        <!-- KIPAS -->
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9708</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                         <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div>  -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0">Muhammad Jamal</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">1.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Meadow Lane Oakland</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-info-lighten">In Progress</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>

                                    <tr>
                                      <td>
                                          <!-- <div class="form-check">
                                              <input type="checkbox" class="form-check-input" id="customCheck2">
                                              <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                          </div> -->
                                      </td>
                                      <!-- KIPAS -->
                                      <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9708</a> </td>
                                      <td>
                                          <div class="d-flex">
                                              <div class="d-flex align-items-center">
                                                  <!-- <div class="flex-shrink-0">
                                                       <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                  </div>  -->
                                                  <div class="flex-grow-1 ms-2"><h5 class="my-0">Muhammad Jamal</h5></div>
                                              </div>
                                          </div>
                                      </td>
                                      <td>Generator 2</td>
                                      <td>
                                          <h5 class="my-0">1.8 kWh</h5>
                                          <!-- <p class="mb-0 txt-muted">Meadow Lane Oakland</p> -->
                                      </td>
                                      <td>0.1 kWh</td>
                                      <!-- <td><h5 class="my-0"><span class="badge badge-info-lighten">In Progress</span></h5></td> -->
                                      <!-- <td>
                                          <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                          <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                      </td> -->
                                  </tr>
                                    
                                    <tr>
                                        <td> 
                                          
                                            <!-- <div class="form-check"> -->
                                                <!-- <input type="checkbox" class="form-check-input" id="customCheck3">
                                                <label class="form-check-label" for="customCheck3">&nbsp;</label>
                                            </div> --> 
                                        </td>
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9707</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div> -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0">Muhammad Angga</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">0.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Bagwell Avenue Ocala</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-success-lighten">Complete</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck4">
                                                <label class="form-check-label" for="customCheck4">&nbsp;</label>
                                            </div> -->
                                        </td>
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9706</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div> -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0"> Siti Sarah</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">0.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Washburn Baton Rouge</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-warning-lighten">Pending</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck5">
                                                <label class="form-check-label" for="customCheck5">&nbsp;</label>
                                            </div> -->
                                        </td>
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9705</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div> -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0"> Siti Aisyah</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">0.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Nest Lane Olivette</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-primary-lighten">Delivered</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>

                                    <tr>
                                      <td>
                                          <!-- <div class="form-check">
                                              <input type="checkbox" class="form-check-input" id="customCheck9">
                                              <label class="form-check-label" for="customCheck9">&nbsp;</label>
                                          </div> -->
                                      </td>
                                      <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9701</a> </td>
                                      <td>
                                          <div class="d-flex">
                                              <div class="d-flex align-items-center">
                                                  <!-- <div class="flex-shrink-0">
                                                      <img src="assets/images/users/avatar-8.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                  </div> -->
                                                  <div class="flex-grow-1 ms-2"><h5 class="my-0">Siti Aisyah</h5></div>
                                              </div>
                                          </div>
                                      </td>
                                      <td>Generator 2</td>
                                      <td>
                                          <h5 class="my-0">0.8 kWh</h5>
                                          <!-- <p class="mb-0 txt-muted">Lane New Market</p> -->
                                      </td>
                                      <td>0.1 kWh</td>
                                      <!-- <td><h5 class="my-0"><span class="badge badge-warning-lighten">Pending</span></h5></td> -->
                                      <!-- <td>
                                          <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                          <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                      </td> -->
                                  </tr>

                                    <tr>
                                        <td>
                                            <!-- <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck6">
                                                <label class="form-check-label" for="customCheck6">&nbsp;</label>
                                            </div> -->
                                        </td>
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9704</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-5.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div> -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0">Muhammad Firdaus</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">0.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Larry San Francisco</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-info-lighten">In Progress</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck7">
                                                <label class="form-check-label" for="customCheck7">&nbsp;</label>
                                            </div> -->
                                        </td>
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9703</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-6.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div> -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0">Muhammad Lutfhi</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">0.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Oak Drive Mobile</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-success-lighten">Complete</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>

                                    <tr>
                                        <td>
                                            <!-- <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck8">
                                                <label class="form-check-label" for="customCheck8">&nbsp;</label>
                                            </div> -->
                                        </td>
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9702</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-7.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div> -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0">Siti Annisa</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">0.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Oxford Court Amory</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-primary-lighten">Delivered</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <!-- <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck9">
                                                <label class="form-check-label" for="customCheck9">&nbsp;</label>
                                            </div> -->
                                        </td>
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9701</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-8.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div> -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0">Maya Azahra</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">0.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Lane New Market</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-warning-lighten">Pending</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>

                                    <tr>
                                      <td>
                                          <!-- <div class="form-check">
                                              <input type="checkbox" class="form-check-input" id="customCheck9">
                                              <label class="form-check-label" for="customCheck9">&nbsp;</label>
                                          </div> -->
                                      </td>
                                      <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9701</a> </td>
                                      <td>
                                          <div class="d-flex">
                                              <div class="d-flex align-items-center">
                                                  <!-- <div class="flex-shrink-0">
                                                      <img src="assets/images/users/avatar-8.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                  </div> -->
                                                  <div class="flex-grow-1 ms-2"><h5 class="my-0">Maya Azahra</h5></div>
                                              </div>
                                          </div>
                                      </td>
                                      <td>Generator 2</td>
                                      <td>
                                          <h5 class="my-0">0.8 kWh</h5>
                                          <!-- <p class="mb-0 txt-muted">Lane New Market</p> -->
                                      </td>
                                      <td>0.1 kWh</td>
                                      <!-- <td><h5 class="my-0"><span class="badge badge-warning-lighten">Pending</span></h5></td> -->
                                      <!-- <td>
                                          <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                          <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                      </td> -->
                                  </tr>


                                  <tr>
                                    <td>
                                        <!-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck9">
                                            <label class="form-check-label" for="customCheck9">&nbsp;</label>
                                        </div> -->
                                    </td>
                                    <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9701</a> </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex align-items-center">
                                                <!-- <div class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-8.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                </div> -->
                                                <div class="flex-grow-1 ms-2"><h5 class="my-0">Maya Azahra</h5></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Generator 3</td>
                                    <td>
                                        <h5 class="my-0">0.8 kWh</h5>
                                        <!-- <p class="mb-0 txt-muted">Lane New Market</p> -->
                                    </td>
                                    <td>0.1 kWh</td>
                                    <!-- <td><h5 class="my-0"><span class="badge badge-warning-lighten">Pending</span></h5></td> -->
                                    <!-- <td>
                                        <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    </td> -->
                                </tr>


                                    <tr>
                                        <td>
                                            <!-- <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck10">
                                                <label class="form-check-label" for="customCheck10">&nbsp;</label>
                                            </div> -->
                                        </td>
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9700</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-9.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div> -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0">Muhammad rizki</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">1.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Wilson Avenue Dallas</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-primary-lighten">Delivered</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck11">
                                                <label class="form-check-label" for="customCheck11">&nbsp;</label>
                                            </div> -->
                                        </td>
                                        <td><a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#CM9699</a> </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-10.jpg" class="rounded-circle avatar-xs" alt="friend">
                                                    </div> -->
                                                    <div class="flex-grow-1 ms-2"><h5 class="my-0">Vara Setyasih</h5></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Generator 1</td>
                                        <td>
                                            <h5 class="my-0">1.8 kWh</h5>
                                            <!-- <p class="mb-0 txt-muted">Avenue Johnson City</p> -->
                                        </td>
                                        <td>0.1 kWh</td>
                                        <!-- <td><h5 class="my-0"><span class="badge badge-success-lighten">Complete</span></h5></td> -->
                                        <!-- <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div> <!-- end row --> 
        <!-- end row -->
    </div>
    <!-- container -->
</div>
<!-- content -->
</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->

@endsection