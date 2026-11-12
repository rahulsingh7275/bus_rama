@extends('admin.auth-layouts.app')

@section('title') Contractors @endsection

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

      <h4 class="m-0">Contractors</h4>

      <div class="card">
          <!-- <div class="card-header">
            <a href="{{url('register')}}" class="btn btn-success" target="_blank" style="float: right;">Add New Contractor</a>
          </div> -->
          <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6 dashcode-data-table">
              <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden col-md-12">
                <table id="example1" class="" style="width:100%">
                <thead class=" bg-slate-200 dark:bg-slate-700">
                      <tr>
                        <td class="table-th">Sr No</th>
                        <td class="table-th">Name</th>
                        <td class="table-th">Email</th>
                        <td class="table-th">Email Verified</th>
                        <td class="table-th">Location</th>
                        <td class="table-th">Status</th>
                        <td class="table-th">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                  @foreach($contractors as $index=>$contractor)
                  <tr>
                    <td class="table-td">{{++$index}}</td>
                    <td class="table-td">{{$contractor->name}}</td>
                    {{--<td class="table-td">{{$contractor->mobile}}</td>--}}
                    <td class="table-td">{{$contractor->email}}</td>
                    <td class="table-td">@if($contractor->email_verified_at) {{date('d-m-Y',strtotime($contractor->email_verified_at))}} @endif</td>
                    {{--<td class="table-td">{{$contractor->contractor_id}}</td>
                    <td class="table-td">{{implode(', ',$contractor->services_names())}}</td>--}}
                    <td class="table-td">{{$contractor->location}}</td>
                    {{--<td class="table-td">
                      <a href="{{$contractor->photo}}" class="example-image-link" data-lightbox="example-{{$index}}">
                        <img src="{{$contractor->photo}}" style="width: 50px;">
                      </a>
                    </td>--}}
                    <td style="text-transform: capitalize;">{{$contractor->status}}</td>
                    <td class="table-td">
                    <div class="dropdown relative">
                        <button class="text-xl text-center block w-full" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <span class="text-lg inline-flex h-6 w-6 flex-col items-center justify-center border border-slate-200 dark:border-slate-700
                              rounded dark:text-slate-400">
                          <iconify-icon icon="heroicons-outline:dots-horizontal"></iconify-icon>
                          </span>
                        </button>
                        <ul class="dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none" style="">
                          @if(!$contractor->email_verified_at)
                          <li>
                            <a href="{{url('admin/contractor-approve/'.$contractor->id)}}?type=email-verified" onclick="return confirm('Are you sure?\nYou want to verify email?')" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                              Verify Email
                            </a>
                          </li>
                          @endif
                          @if($contractor->status=='inactive')
                          <li>
                            <a href="{{url('admin/contractor-approve/'.$contractor->id)}}?type=active" onclick="return confirm('Are you sure?\nYou want to approve this user?')" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                              Approve
                            </a>
                          </li>
                          <li>
                            <a href="{{url('admin/contractor-approve/'.$contractor->id)}}?type=rejected" onclick="return confirm('Are you sure?\nYou want to reject this user?')" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                              Reject
                            </a>
                          </li>
                          @elseif($contractor->status=='active')
                          <li>
                            <a href="{{url('admin/contractor-approve/'.$contractor->id)}}?type=disabled" onclick="return confirm('Are you sure?\nYou want to reject this user?')" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                              Disable
                            </a>
                          </li>
                          @endif
                          <!-- <li>
                            <a href="{{url('admin/contractor-edit/'.$contractor->id)}}" onclick="return confirm('Are you sure?\nYou want to edit this user?')" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                              Edit
                            </a>
                          </li> -->
                          <li>
                            <a href="{{url('admin/secret_login/'.$contractor->id)}}" target="_blank" onclick="return confirm('Are you sure?\nYou want to see the user dashboard?')" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                              Secret Login
                            </a>
                          </li>
                          <li>
                            <a href="{{url('admin/contractor-details/'.$contractor->id)}}" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                            Quick Dashboard
                            </a>
                          </li>
                        </ul>
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
      // layout: {
      //     topStart: {
      //         buttons: ['excel', 'pdf', 'print']
      //     }
      // }
  });
  });
</script>
@endsection
