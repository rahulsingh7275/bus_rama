@extends('admin.auth-layouts.app')

@section('title') Service List @endsection

@section('css')
<style>

</style>
@endsection

@include('notifications.notification')

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- content area starts -->

      <h4 class="m-0">Service List</h4>

      <div class="card">
          <div class="card-header">
            <a href="{{url('admin/add-service')}}" class="btn btn-success" style="float: right;">Add New Service</a>
          </div>
          <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6 dashcode-data-table">
              <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden col-md-12">
                <table id="example1" class="" style="width:100%">
                <thead class=" bg-slate-200 dark:bg-slate-700">
                      <tr>
                        <th class="table-th">Sr No</th>
                        <th class="table-th">Name</th>
                        <th class="table-th">Created On</th>
                        <th class="table-th">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                  @foreach($services as $index=>$service)
                  <tr>
                    <td class="table-td">{{++$index}}</td>
                    <td class="table-td">{{$service->name}}</td>
                    <td class="table-td">@if($service->created_at) {{date('d-m-Y',strtotime($service->created_at))}} @endif</td>
                    <td class="table-td ">
                      <div class="flex space-x-3 rtl:space-x-reverse">
                      <a href="{{url('admin/edit-service/'.$service->id)}}" onclick="return confirm('Are you sure?\nYou want to edit this service?')" class="btn-success action-btn">
                          <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                        </a>
                        <a href="{{url('admin/delete-service/'.$service->id)}}" onclick="return confirm('Are you sure?\nYou want to delete this service?')" class="btn-danger action-btn">
                          <iconify-icon icon="heroicons:trash"></iconify-icon>
                        </a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                </table>
                            
              </div>
            </div>
          </div>
        </div>
</div>
</div>
</div>
</div>

@endsection


@section('scripts')
<script>

$(function () {
  $("#example1").DataTable({
      layout: {
          topStart: {
              buttons: ['excel', 'pdf', 'print']
          }
      }
  });
  });
</script>
@endsection