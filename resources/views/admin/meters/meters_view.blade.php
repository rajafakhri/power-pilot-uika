@extends('layouts.master_dashboard')
@section('title','Maters')
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
                <h4 class="page-title">Meters</h4>
            </div>
            </div>
        </div>

        <div class="col-auto">
            <a href="{{route('meters.create')}}" class="btn btn-primary">Create New</a>      
        </div>
        <br>
        <!-- end page title -->


        <!-- KAMUS -->
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Users</th>
                        <th>Battery ID</th>
                        <th>Volt</th>
                        <th>Ampere</th>
                        <th>Watt</th>
                        <th style="width: 125px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($meters as $data)
                    <tr>                                                
                        <td>{{$data->name}}</td>
                        <td>{{$data->id_battery}}</td>
                        <td>{{$data->m_volt}}</td>
                        <td>{{$data->m_ampere}}</td>                        
                        <td>
                            <h5 class="my-0">{{$data->m_watt}}</h5>                            
                        </td>                        
                        <td>
                            <form onsubmit="return confirm('Are you sure ?');" action="{{ route('meters.destroy', $data->id_meters) }}" method="POST">
                                <a class="btn btn-primary" href="{{route('meters.edit', $data->id_meters)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>                                                        
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" class=""> <i class="mdi mdi-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

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
@endsection