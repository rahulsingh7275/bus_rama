@extends('admin.auth-layouts.app')

@section('title') Dashboard @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
            <div class="transition-all duration-150 container-fluid" id="page_layout">
              <div id="content_layout">

                <div>
                  <div class="flex justify-between flex-wrap items-center mb-6">
                    <h4 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-4 sm:mb-0 flex space-x-3 rtl:space-x-reverse">Dashboard</h4>
                  </div>
                  <div class="grid grid-cols-12 gap-5 mb-5">
                    <div class="2xl:col-span-3 lg:col-span-4 col-span-12">
                      <div class="bg-no-repeat bg-cover bg-center p-4 rounded-[6px] relative" style="background-image: url({{asset('auth_asset')}}/images/all-img/widget-bg-1.png)">
                        <div class="max-w-[180px]">
                          <div class="text-xl font-medium text-slate-900 mb-2">
                            HI, ADMIN
                          </div>
                          <p class="text-sm text-slate-800">
                            Welcome to admin dashboard
                          </p>
                        </div>
                        <div class="absolute top-1/2 -translate-y-1/2 ltr:right-6 rtl:left-6 mt-2 h-12 w-12 bg-white rounded-full text-xs font-medium
                            flex flex-col items-center justify-center">
                          Now
                        </div>
                      </div>
                    </div>
                    <div class="2xl:col-span-9 lg:col-span-8 col-span-12">
                      <div class="p-4 card">
                        <div class="grid md:grid-cols-3 col-span-1 gap-4">

                          <!-- BEGIN: Group Chart2 -->

                          
                          <div class="py-[18px] px-4 rounded-[6px] bg-[#E5F9FF] dark:bg-slate-900	 ">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                              <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                  Total Customers
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                  {{$customers->count()}}
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="py-[18px] px-4 rounded-[6px] bg-[#EAE5FF] dark:bg-slate-900	 ">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                              <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                  Total Tickets
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                {{$tickets->count()}}
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="py-[18px] px-4 rounded-[6px] dark:bg-slate-900" style="background-color: #b8c3f1;">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                              <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                  Total Leads
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                {{$total_leads->count()}}
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="py-[18px] px-4 rounded-[6px] dark:bg-slate-900" style="background-color: #a4ebf1;">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                              <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                  Pending Leads
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                {{$pending_leads->count()}}
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="py-[18px] px-4 rounded-[6px] dark:bg-slate-900" style="background-color: #9cf5ce;">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                              <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                  Approved Leads
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                {{$approved_leads->count()}}
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="py-[18px] px-4 rounded-[6px] dark:bg-slate-900" style="background-color: #b5d9c9;">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                              <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                  Completed Leads
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                {{$completed_leads->count()}}
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="py-[18px] px-4 rounded-[6px] dark:bg-slate-900" style="background-color: #f3babb;">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                              <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                  Rejected Leads
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                {{$rejected_leads->count()}}
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- END: Group Chart2 -->
                        </div>
                      </div>
                    </div>
                    
                    
                  </div>
                  
                </div>

              </div>
            </div>
          </div>



@endsection

