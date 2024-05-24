@extends('layouts.master_login')
@section('title','Verifikasi Email')
@section('content')

<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">
                    <!-- Logo -->
                    <div class="card-header pt-2 pb-2 text-center bg-primary">
                        <a href="index.html">
                            <span><img src="{{asset('assets/images/popi2-01.png')}}" alt="" height="72"></span>
                        </a>
                    </div>
                    
                    <div class="card-body p-4">
                        
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center mt-0 fw-bold">Verification Account</h4>
                            <p class="text-muted mb-4">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div>
                                <button class="btn btn-primary" type="submit">Resend Verification Email</button>                                                                    
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button class="btn btn-primary" type="submit" >Log Out</button>
                        </form>
                    </div> <!-- end card-body-->
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