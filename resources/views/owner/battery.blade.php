@extends('layouts.master_owner')
@section('title','Battery')
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
              <!-- <div class="col-6">
                <div class="float-end pt-2">
                  <a href="add.html" title="" class="btn btn-primary">Create New</a>
                </div>
              </div> -->
            </div>
            <!-- end page title -->
          
<div class="table-responsive-sm">
<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Battery ID</th>                        
            <th>Battery Name</th>
            <th>Battery Capacity</th>            
        </tr>
    </thead>
    <tbody>
        @php $no=1; @endphp
        @foreach($battery as $data)
        <tr>                                                
            <td>{{$data->id_battery}}</td>
            <td>{{$data->nm_battery}}</td>                        
            <td>
                <h5 class="my-0">{{$data->capacity}}</h5>                            
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