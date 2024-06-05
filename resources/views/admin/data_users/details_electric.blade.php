@extends('layouts.master_dashboard')
@section('title','Record Details')
@section('content')
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
                    src="../../../assets/images/users/avatar-2.jpg"
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
                    src="../../../assets/images/users/avatar-5.jpg"
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
                <form class="d-flex">
                    <div class="input-group">
                    <input
                        type="text"
                        class="form-control form-control-light"
                        id="dash-daterange"
                    />
                    <span
                        class="input-group-text bg-primary border-primary text-white"
                    >
                        <i class="mdi mdi-calendar-range font-13"></i>
                    </span>
                    </div>
                    <a
                    href="javascript: void(0);"
                    class="btn btn-primary ms-2"
                    >
                    <i class="mdi mdi-autorenew"></i>
                    </a>
                    <a
                    href="javascript: void(0);"
                    class="btn btn-primary ms-1"
                    >
                    <i class="mdi mdi-filter-variant"></i>
                    </a>
                </form>
                </div>
                <h4 class="page-title">Electric Details</h4>
            </div>
            </div>
        </div>
        <br>
        <!-- end page title -->

        <?php
            $count_batt = DB::table('battery')->where('id_users',$id)->count();
            $get_batt = DB::table('battery')->where('id_users',$id)->get();   
            $battery_user_imp = DB::table('battery')->where('id_users',$id)->where('bat_watt','>',0)->first(); //Ambil listrik dari batrai yang punya listrik            
        ?>    
        <h4>Electrical Capacity <a href="{{route('users.details.random')}}/{{$id}}" class="btn btn-primary"><i class="mdi mdi-reload"></i></a></h4>         
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0">
                <thead>                        
                    <tr>                                
                        <th rowspan="2">No</th>
                        <th rowspan="2">User</th>
                        <th colspan="3">Generator</th>
                        <th colspan="{{$count_batt}}">Battery</th>
                        <th rowspan="2">Usage</th>
                        <th rowspan="2">Export</th>
                        <th rowspan="2">Import</th>
                        <th rowspan="2">Total</th>                        
                        <th rowspan="2">Record Date</th>                        
                    </tr>
                    <tr>
                        <td>G1</td>
                        <td>G2</td>
                        <td>G3</td>                                            
                        @foreach($get_batt as $battery)                        
                        <td>{{$battery->nm_battery}}</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody> 
                    @php $no=1; @endphp
                    @foreach($record_data as $record)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->gen_1}} Watt</td>
                        <td>{{$record->gen_2}} Watt</td>
                        <td>{{$record->gen_3}} Watt</td>
                        @if($count_batt == 3)
                            @foreach($get_batt as $battery)
                            <td>{{$battery->nm_battery}}</td>
                            @endforeach                        
                        @elseif($count_batt == 2)
                            @foreach($get_batt as $battery)
                            <td>{{$battery->nm_battery}}</td>
                            @endforeach  
                            <td>-</td>
                        @elseif($count_batt == 1)
                            @foreach($get_batt as $battery)
                            <td>{{$battery->nm_battery}}</td>
                            @endforeach  
                            <td>-</td>
                            <td>-</td>
                        @else
                            <td>Not Found</td>
                        @endif

                        <td>{{$record->elec_usage}} Watt</td>
                        <td>{{$record->elec_export}} Watt</td>
                        <td>{{$record->elec_import}} Watt</td>
                        <td>{{($record->gen_1 + $record->gen_2 + $record->gen_3 + $record->elec_import ) + ($record->elec_usage - $record->elec_export)}} Watt</td>
                        <td>{{$record->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            <table>
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
@endsection