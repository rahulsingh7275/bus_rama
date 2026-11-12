@extends('admin.auth-layouts.app')

@section('title') Registered Customers @endsection

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

      <h4 class="m-0">Registered Customers</h4>

      <div class="card">
          
          <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6 dashcode-data-table">
              <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden col-md-12">
                <table id="example1" class="" style="width:100%">
                <thead class=" bg-slate-200 dark:bg-slate-700">
                      <tr>
                        <td class="table-th">Sr No</th>
                        <td class="table-th">Name</th>
                        <td class="table-th">Location</th>
                        <td class="table-th">Mobile</th>
                        <td class="table-th">Email</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                  @foreach($contractors as $index=>$contractor)
                  <tr>
                    <td class="table-td">{{++$index}}</td>
                    <td class="table-td">{{$contractor->name}}</td>
                    <td class="table-td">{{$contractor->location}}</td>
                    <td class="table-td">{{$contractor->mobile}}</td>
                    <td class="table-td">{{$contractor->email}}</td>
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
