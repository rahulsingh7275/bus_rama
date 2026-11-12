@extends('admin.auth-layouts.app')

@section('title') Chat with contractors @endsection

@section('css')
<style>
.activeStatus {
    display: block;
    height: 20px;
    width: 20px;
    background: #2ce12c;
    position: relative;
    border-radius: 50%;
    text-align: center;
    font-weight: bold;
}
</style>
@endsection

@include('notifications.notification')

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- content area starts -->

      <h4 class="m-0">Chat with contractors</h4>

      <div class="card">
          <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6 dashcode-data-table">
              <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden col-md-12">
                <table id="example1" class="" style="width:100%">
                <thead class=" bg-slate-200 dark:bg-slate-700">
                      <tr>
                        <th class="table-th">Sr No</th>
                        <th class="table-th">Name</th>
                        <th class="table-th">Start Chatting</th>
                        <th class="table-th">Location</th>
                        <th class="table-th">Mobile</th>
                        <th class="table-th">Email</th>
                        <th class="table-th">Services</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                  @foreach($contractors as $index=>$contractor)
                  <tr>
                    <td class="table-td">
                      @if($contractor->active_status)
                      <span class="activeStatus">{{++$index}}</span>
                      @else
                      {{++$index}}
                      @endif
                    </td>
                    <td class="table-td">{{$contractor->name}}</td>
                    <td class="table-td">
                      <a href="{{url('admin/chatify_redirect')}}/{{$contractor->id}}" target="_blank" class="rounded-md bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xl px-4">
                        <iconify-icon icon="heroicons:users"></iconify-icon>
                      </a>
                    </td>
                    <td class="table-td">{{$contractor->location}}</td>
                    <td class="table-td">{{$contractor->mobile}}</td>
                    <td class="table-td">{{$contractor->email}}</td>
                    <td class="table-td">{{implode(', ',$contractor->services_names())}}</td>
                    <!-- <td class="table-td">@if($contractor->email_verified_at) {{date('d-m-Y',strtotime($contractor->email_verified_at))}} @endif</td>
                    <td class="table-td">{{$contractor->contractor_id}}</td>
                    <td class="table-td">
                      <a href="{{$contractor->photo}}" class="example-image-link" data-lightbox="example-{{$index}}">
                        <img src="{{$contractor->photo}}" style="width: 50px;">
                      </a>
                    </td>
                    <td style="text-transform: capitalize;">{{$contractor->status}}</td> -->
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
