@extends('layouts.master_login')
@section('title','Konfirmasi Password')
@section('content')
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-12 col-lg-8">
                <div class="card ">
                    <div class="row g-0">
                    
                    <!-- Logo -->
                    <div class="col-md-6 p-md-4 bg-primary">
                        <div class="position-relative top-50 start-50 translate-middle p-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="#">
                                        <span><img src="{{asset('assets/images/popi2-01.png')}}" alt="" height="100"></span>
                                    </a>            
                                </div>
                                <div class="col-md-8">
                                    <h3 class="card-text text-white fw-semibold text-uppercase">Hi ! <br> Welcome to <br> Power Pilot </h3>
                                </div>    
                            </div>
                        </div>
                    </div>

                    <div class="col">     
                    <div class="card-body">
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center pb-0 fw-bold text-uppercase">Harap konfirmasi kata sandi Anda sebelum melanjutkan.</h4>                            
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <p class="text-muted">It must be a combination of minimun 8 letters, numbers, and symbols</p>
                            </div>

                            <div class="mb-2 mb-0 text-center">
                                <button class="btn btn-primary w-100" type="submit"> Confirm </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                    </div>

                    </div>
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->
@endsection
