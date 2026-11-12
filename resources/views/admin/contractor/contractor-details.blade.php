@extends('admin.auth-layouts.app')

@section('title') Contractor Details @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
    <div class="transition-all duration-150 container-fluid" id="page_layout">
        <div id="content_layout">


<div class="row mb-3">
    <div class="col-md-6 pt-3">
    <h6>PROFILE DETAILS</h6>
    </div>
</div>

        <!-- start content area -->
<div class="row">
    <div class="col-md-8">
        @if($contractor->getMedia('workphotos')->count() > 0)
            <div class="card">
                <div class="card-body flex flex-col p-6">
                    <div class="card-text h-full ">
                        <div class="space-y-5">
                            <div class="slider basic-carousel width-caption owl-carousel">
                                @foreach($contractor->getMedia('workphotos') as $index=>$image)
                                <div class="relative">
                                    <img class="w-full" src="{{ $image->getUrl() }}" alt="image">
                                    <!-- <div class="absolute w-full bottom-14 text-center">
                                    <h3 class="text-white font-Inter text-lg">Title</h3>
                                    <p class="text-white font-Inter text-sm">Lorem ipsum dolor sit amet.</p>
                                    </div> -->
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <header class="flex items-center border-b border-slate-100 dark:border-slate-700">
                    <div class="flex-1 p-6" style="padding-top: 0px;padding-bottom: 0px;">
                        <div class="card-title text-slate-900 dark:text-white">Work Pictures</div>
                    </div>
                </header>
            </div>
            @else
            <div class="card p-6">
                <h6 class="mb-3">Work Pictures are not available</h6>
            </div>
            @endif

        <div class="card p-6 mt-3">
            <h6 class="mb-3">About {{$contractor->name}}</h6>
            <p>{{$contractor->about}}</p>
        </div>
        @if($contractor->role=='Contractor')
        <div class="card p-6 mt-3">
            <h6 class="mb-3">Services</h6>
            @foreach($contractor->contractor_services() as $service)
            <p>➤ {{$service->name}}</p>
            @endforeach
        </div>
        @endif
        @if(Request()->service_id)
        <div class="row mt-3">
            <div class="col-md-6">
                <a href="{{url('chatify')}}/{{$contractor->id}}" target="_blank" class="btn btn-dark">Start Chatting</a>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{url('add-customer-requests')}}?contractor_id={{$contractor->id}}&&service_id={{Request()->service_id}}" class="btn btn-primary">Service Request</a>
            </div>
        </div>
        @endif
        @if(Auth::guard('admin')->check()==true)
        <div class="row mt-3">
            <div class="col-md-6">
                <a href="{{url('chatify')}}/{{$contractor->id}}" target="_blank" class="btn btn-dark">Start Chatting</a>
            </div>
        </div>
        @endif
        @if($contractor->role=='Customer')
            <!-- <h6 class="mt-3 mb-3">Location</h6>
            <div id="googleMap" style="width:100%;height:300px;"></div> -->
        @endif
        <!-- <h6 class="mt-3 mb-3">Reviews</h6> -->


    </div>

    <div class="col-md-4">
        @if($contractor->photo)
        <div class="card p-6">
            <img src="{{$contractor->photo}}" alt="" style="width:100%">
        </div>
        @endif
        <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 mt-3">
            <thead class="bg-slate-200 dark:bg-slate-700">
            <tr>

                <th scope="col" class=" table-th ">
                <h6>Profile Details</h6>
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">

            <tr class="hover:bg-slate-200 dark:hover:bg-slate-700">
                <td class="table-td"><strong>Name :</strong> {{$contractor->name}}</td>
            </tr>
            <tr class="hover:bg-slate-200 dark:hover:bg-slate-700">
                <td class="table-td"><strong>Email :</strong> {{$contractor->email}}</td>
            </tr>
            <tr class="hover:bg-slate-200 dark:hover:bg-slate-700">
                <td class="table-td"><strong>Mobile :</strong> {{$contractor->mobile}}</td>
            </tr>
            <tr class="hover:bg-slate-200 dark:hover:bg-slate-700">
                <td class="table-td"><strong>Address :</strong> {{$contractor->location}}</td>
            </tr>
            @if($contractor->role=='Contractor')
            <tr class="hover:bg-slate-200 dark:hover:bg-slate-700">
                <td class="table-td"><strong>Contractor State License Number :</strong> {{$contractor->contractor_id}}</td>
            </tr>
            @endif

            </tbody>
        </table>
        @if($contractor->role=='Contractor')
        <div class="card mt-3 p-6">
            <h6 class="mb-3">Opening Hours</h6>
            <p>{{$contractor->opening_timing}}</p>
        </div>
        @endif
        @if($contractor->role=='Contractor')
        <!-- <h6 class="mt-3 mb-3">Location</h6>
        <div id="googleMap" style="width:100%;height:300px;"></div> -->
        @endif
    </div>
</div>
        <!-- end content area -->
        
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>

@endsection