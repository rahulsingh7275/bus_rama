@php $segment = Request::segment(2); @endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin/dashboard')}}" class="brand-link" style="text-align: center;font-size: 25px;">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text text-center">WELCOME</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 169px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="{{url('admin/dashboard')}}" class="d-block" style="text-wrap: wrap;">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>


      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{url('admin/dashboard')}}" class="nav-link @if($segment=='dashboard') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/contractors')}}" class="nav-link @if($segment=='contractors') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Contractors</p>
              </a>  
            </li>
            <li class="nav-item">
              <a href="{{url('admin/services')}}" class="nav-link @if($segment=='services') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Services</p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="{{url('admin/subscription-plans')}}" class="nav-link @if($segment=='subscription-plans') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Subscription Plans</p>
              </a>
            </li>
          
            <li class="nav-item">
              <a href="{{url('admin/customers')}}" class="nav-link @if($segment=='customers') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Customers</p>
              </a>
            </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 12.5092%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>