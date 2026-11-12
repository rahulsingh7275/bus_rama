@extends('admin.auth-layouts.app')

@section('title') Customer List @endsection

@section('css')
<style>

</style>
@endsection

@include('notifications.notification')

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
  <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <div class="row" style="width: 100% !important">
          <div class="col-6">
          <h5>Customer List</h5>
          </div>
          <!-- <div class="col-6">
            <a href="{{url('add-customer')}}" class="btn btn-success" style="float: right;">Add New Customer</a>
          </div> -->
        </div>
        <br/>
          <div class="card">
                    <!-- <header class=" card-header noborder">
                      
                    </header> -->
                    <div class="card-body px-6 pb-6">
                      <div class="overflow-x-auto -mx-6 dashcode-data-table">
                        <div class="inline-block min-w-full align-middle">
                          <div class="overflow-hidden col-md-12">
                          <table id="example1" class="" style="width:100%">
                              <thead class=" bg-slate-200 dark:bg-slate-700">
                                <tr>

                                  <th scope="col" class=" table-th ">Sr No</th>
                                  <th scope="col" class=" table-th ">Contractor Name</th>
                                  <th scope="col" class=" table-th ">Customer Name</th>
                                  <th scope="col" class=" table-th ">Service</th>
                                  <th scope="col" class=" table-th ">Location</th>
                                  <!-- <th scope="col" class=" table-th ">Behaviour</th> -->
                                  <!-- <th scope="col" class=" table-th ">Price</th> -->
                                  <th scope="col" class=" table-th ">Phone Number</th>
                                  <th scope="col" class=" table-th ">Reviews</th>
                                  <!-- <th scope="col" class=" table-th ">Photo</th> -->
                                  <!-- <th scope="col" class=" table-th ">Work Photos</th> -->
                                  <!-- <th scope="col" class=" table-th ">Created On</th> -->
                                  @if(Request()->type!='Others')
                                    <th scope="col" class=" table-th ">Action</th>
                                  @endif
                                </tr>
                              </thead>
                              <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                @foreach($customers as $index=>$customer)
                                  <tr>
                                    <td class="table-td">{{++$index}}</td>
                                    <td class="table-td">{{$customer->user->name}}</td>
                                    <td class="table-td">{{$customer->name}}</td>
                                    <td class="table-td">{{$customer->service->name}}</td>
                                    <td class="table-td">{{$customer->location}}</td>
                                    <!-- <td class="table-td">{{$customer->behaviour}}</td> -->
                                    <!-- <td class="table-td">{{$customer->price}}</td> -->
                                    <td class="table-td">{{$customer->phone}}</td>
                                    <td class="table-td">{{$customer->reviews}}</td>
                                    <!-- <td class="table-td ">
                                      <a href="{{$customer->photo}}" class="example-image-link" data-lightbox="example-{{$index}}">
                                        <img src="{{$customer->photo}}" style="width: 50px;" class="rounded">
                                      </a>
                                    </td> -->
                                    <!-- <td class="table-td">
                                    @foreach($customer->getMedia('workphotos') as $index=>$image)
                                        <a class="example-image-link" href="{{ $image->getUrl() }}" data-lightbox="example-{{$index}}">
                                          <img src="{{ $image->getUrl() }}" alt="Image" style="height: 50px;width: 50px;border: 5px solid transparent;float: left;border-radius: 20px;">
                                        </a>
                                    @endforeach
                                    </td> -->
                                    <!-- <td style="width: 100px;">@if($customer->created_at) {{date('d-m-Y',strtotime($customer->created_at))}} @endif</td> -->
                                    @if(Request()->type!='Others')
                                      <td class="table-td ">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                          <a href="{{url('admin/edit-customer/'.$customer->id)}}" class="btn-success action-btn" onclick="return confirm('Are you sure?\nYou want to edit this customer?')">
                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                          </a>
                                          <a href="{{url('admin/delete-customer/'.$customer->id)}}" class="btn-danger action-btn" onclick="return confirm('Are you sure?\nYou want to delete this customer?')">
                                            <iconify-icon icon="heroicons:trash"></iconify-icon>
                                          </a>
                                        </div>
                                      </td>
                                    @endif                                 
                                  </tr>
                                @endforeach
                              </tbody>
                              </table>
                            
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
      <!-- DataTable Code Here -->

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

