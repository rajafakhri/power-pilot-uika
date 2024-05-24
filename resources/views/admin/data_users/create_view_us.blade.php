@extends('layouts.master_dashboard')
@section('title','Add Users')
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
                <h4 class="page-title">Add Users</h4>
            </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Add Users</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="input-types-preview">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form id="form add-user-f" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Name</label>
                                                <input type="text" id="simpleinput" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-email" class="form-label">Email</label>
                                                <input type="email" id="example-email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" name="email" value="{{old('email')}}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Password" name="password">
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Level</label>
                                                <select class="form-select" id="example-select" name="level">
                                                    <option value="1">Admin</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3">Users</option>
                                                </select>
                                            </div>

                                            <button type="submit" id="add-user-b" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row-->                      
                            </div> <!-- end preview-->

                        </div> <!-- end tab-content-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->
        

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

<script type="text/javascript">
$('#add-user-f').submit(function () {
    $('#add-user-b').attr('disabled',true);
});
</script>
@endsection