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
          <h1 class="m-0">Applications Users List</h1>

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
              <h3 class="card-title">Applications Users List</h3>
          </div>
          <div class="card-body">
              <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                      <tr>
                        <th>SN#</th>
                        <th>Full Name</th>
                        <th>Mobile</th>
                        <th>Vehicle Number</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  @foreach($users as $index=>$user)
                  <tr>
                    <td>{{++$index}}</td>
                    <td>{{$user->full_name}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->vehicle_number}}</td>
                    <td>
                      <a href="{{url('admin/application-user-password-reset')}}/{{$user->id}}" class="btn btn-info" onclick="return confirm('Are you sure?');"><i class="fa fa-edit"></i> Reset Password</a>
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