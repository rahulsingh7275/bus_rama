@extends('admin.auth-layouts.app')

@section('title') Tickets @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Tickets</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">
              <table id="example1" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" aria-describedby="example1_info">
              <thead class="bg-slate-200 dark:bg-slate-700">
                <tr>
                    <th class="table-th">SN#</th>
                    <th class="table-th">Contractor Name</th>
                    <th class="table-th">Compalin No</th>
                    <th class="table-th">Status</th>
                    <th class="table-th">Created Date</th>
                    <th class="table-th">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
            <tr>
                    <th class="table-th">SN#</th>
                    <th class="table-th">Contractor Name</th>
                    <th class="table-th">Compalin No</th>
                    <th class="table-th">Status</th>
                    <th class="table-th">Created Date</th>
                    <th class="table-th">Action</th>
                </tr>
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