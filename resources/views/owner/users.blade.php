@extends('layouts.master_owner')
@section('title','Users')
@section('content')
<div class="content-page">
    <div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-6">
        <div class="page-title-box">
            <h4 class="page-title">Power Meter Monitoring System</h4>
        </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="table-responsive-sm">
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>                        
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach($users as $user)
            <tr>                        
                <td>{{$no++}}</td>
                <td>{{$user->name}}</td>
                <td>
                    <h5 class="my-0">{{$user->email}}</h5>                            
                </td>                        
            </tr>
            @endforeach

        </tbody>
    </table>
    </div>
    </div>
    <!-- End Content -->
</div>
<!-- content-page -->

@endsection