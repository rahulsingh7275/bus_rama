@extends('admin.auth-layouts.app')

@section('title') Subscription Plans @endsection

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

      <h4 class="m-0">Subscription Plans</h4>

      <div class="card">
      <div class="card-header">
            <!-- <a href="{{url('admin/add-subscription-plan')}}" class="btn btn-success" style="float: right;">Add New Subscription Plan</a> -->
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
                        <th class="table-th">Description</th>
                        <!-- <th class="table-th">Additional Description</th> -->
                        <th class="table-th">Duration</th>
                        <th class="table-th">Amount</th>
                        <!-- <th class="table-th">Amount Text</th> -->
                        <!-- <th class="table-th">Short Description</th> -->
                        <th class="table-th">Created On</th>
                        <th class="table-th">Status</th>
                        <th class="table-th">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                  @foreach($subscription_plans as $index=>$subscription_plan)
                  <tr>
                    <td class="table-td">{{++$index}}</td>
                    <td class="table-td">{{$subscription_plan->name}}</td>
                    <td class="table-td">{!!$subscription_plan->description!!}</td>
                    <!-- <td class="table-td">{!! $subscription_plan->additional_description !!}</td> -->
                    <td class="table-td">{{$subscription_plan->duration}}{{$subscription_plan->amount_text}}</td>
                    <td class="table-td">${{$subscription_plan->amount}}</td>
                    <!-- <td class="table-td">{{$subscription_plan->amount_text}}</td> -->
                    <!-- <td class="table-td">{{$subscription_plan->short_description}}</td> -->
                    <td class="table-td">@if($subscription_plan->created_at) {{date('d-m-Y',strtotime($subscription_plan->created_at))}} @endif</td>
                    <td class="table-td">
                      @if($subscription_plan->status == 'active')
                        <span class="text-success" style="border-radius: 20px;">Active</span>
                      @else
                        <span class="text-danger" style="border-radius: 20px;">Inactive</span>
                      @endif
                    </td>
                    <td class="table-td">
                    <a href="{{url('admin/edit-subscription-plan/'.$subscription_plan->id)}}" class="btn-success action-btn" onclick="return confirm('Are you sure?\nYou want to edit this customer?')">
                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                    </a>
                    <!-- <a href="{{url('admin/delete-subscription-plan/'.$subscription_plan->id)}}" class="btn-danger action-btn" onclick="return confirm('Are you sure?\nYou want to delete this customer?')">
                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                    </a> -->
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