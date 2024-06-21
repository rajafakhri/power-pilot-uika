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
                <th>User</th>
                <th colspan="3">Generator</th>                
                <th>Usage</th>
                <th>Export</th>
                <th>Import</th>                
                </tr>
            </thead>
            <tbody>
                @php $no=1; @endphp
                @foreach($users as $user)
                <?php
                    $check_record = DB::table('record_elec_use')->where('id_users',$user->id)->orderBy('id_rec_elec_use','DESC')->first();
                    $get_battery = DB::table('battery')->where('id_users',$user->id)->get();
                    $count_battery = DB::table('battery')->where('id_users',$user->id)->count();
                    $sum_batt = DB::table('battery')->where('id_users',$user->id)->sum('bat_watt');
                    $data_usage = DB::table('record_elec_use')->where('id_users',$user->id)->sum('elec_usage');
                    $data_export = DB::table('record_elec_use')->where('id_users',$user->id)->sum('elec_export');
                    $data_import = DB::table('record_elec_use')->where('id_users',$user->id)->sum('elec_import');

                    $sum_gen1 = DB::table('record_elec_use')->where('id_users',$user->id)->sum('gen_1');
                    $sum_gen2 = DB::table('record_elec_use')->where('id_users',$user->id)->sum('gen_2');
                    $sum_gen3 = DB::table('record_elec_use')->where('id_users',$user->id)->sum('gen_3');

                ?>                    
                <tr>                        
                    <td>{{$no++}}</td>
                    <td>{{$user->name}}</td>
                    @if($check_record == TRUE)
                    <td>{{$sum_gen1}} Watt</td>
                    <td>{{$sum_gen2}} Watt</td>
                    <td>{{$sum_gen3}} Watt</td>
                    @else
                    <td colspan="3">Not Found</td>
                    @endif                                              
                    <td>{{$data_usage}} Watt</td>
                    <td>{{$data_export}} Watt</td>
                    <td>{{$data_import}} Watt</td>                    
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