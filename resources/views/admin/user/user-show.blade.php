@extends('admin.layouts.app')
@section('content')

@section('styles')

@endsection

<div class="content-wrapper" style="min-height: 113px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          
          @if(Request()->id==2)
          @php $role = 'Dealer'; @endphp
          @elseif(Request()->id==3)
          @php $role = 'RTO'; @endphp
          @else
          @php $role = 'Admin'; @endphp
          @endif

          <h1 class="m-0">{{$role}} List</h1>

          @include('notifications.notification')
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
      
      <!-- DataTable Code Here -->
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">{{$role}} List</h3>
              @if(Request()->id==2)
                  <a href="{{url('admin/user-add')}}" class="btn btn-success" style="float: right;">ADD {{$role}}</a>
              @endif
          </div>
          <div class="card-body">
              <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                      <tr>
                        <th>SN#</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Mobile</th>
                        <th>Admin Type</th>
                        <th>District</th>
                        <th>Status</th>
                        <th>Creation Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  @foreach($admins as $index=>$admin)
                  <tr>
                    <td>{{++$index}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->user_name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{strtoupper($admin->role_text)}}</td>
                    <td>{{$admin->mobile}}</td>
                    <td>{{$admin->admin_type}}</td>
                    <td>{{($admin->districtDetails)?$admin->districtDetails->rto_office_name:''}}</td>
                    <td>{{$admin->status}}</td>
                    <td>{{date('d-m-Y',strtotime($admin->created_at))}}</td>
                    <td>
                      <a href="{{url('admin/user-edit')}}/{{$admin->id}}" class="btn btn-info" onclick="return confirm('Are you sure?');"><i class="fa fa-edit"></i> Edit</a>
                      <!-- <a href="{{url('admin/user-delete')}}/{{$admin->id}}" class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i> Delete</a> -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>
      <!-- DataTable Code Here -->
      


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@section('scripts')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection

@endsection