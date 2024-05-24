@extends('layouts.master_owner')
@section('title','Meters')
@section('content')

<div class="content-page">
    <div class="content">
                
    <!-- start page title -->
    <div class="row">
        <div class="col-6">
        <div class="page-title-box ">
            <h4 class="page-title">Power Meter Monitoring System</h4>
        </div>
        </div>
    </div>
<!-- end page title -->
          
<div class="table-responsive-sm">
<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Users</th>
            <th>Battery ID</th>
            <th>Volt</th>
            <th>Ampere</th>
            <th>Watt</th>
        </tr>
    </thead>
    <tbody>
        @php $no=1; @endphp
        @foreach($meters as $data)
        <tr>                                                
            <td>{{$data->name}}</td>
            <td>{{$data->id_battery}}</td>
            <td>{{$data->m_volt}} V</td>
            <td>{{$data->m_ampere}} A</td>                        
            <td>
                <h5 class="my-0">{{$data->m_watt}} Watt</h5>                            
            </td>                        
        </tr>
        @endforeach

    </tbody>
</table>
</div>
                        
</div> <!-- End Content -->
</div> 
<!-- content-page -->

@endsection