<div class="sidebar-wrapper group">
      <div id="bodyOverlay" class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden"></div>
      <div class="logo-segment">
        <a class="flex items-center" href="{{url('/')}}">
          <img src="{{ asset('storage/' . website_setting('logo')) }}" class="black_logo" alt="Logo" style="width: 180px;">
          <img src="{{ asset('storage/' . website_setting('logo')) }}" class="white_logo" alt="logo" style="width: 180px;">
        </a>
        <!-- Sidebar Type Button -->
        <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
          <span class="sidebarDotIcon extend-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
        <div class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150 ring-2 ring-inset ring-offset-4 ring-black-900 dark:ring-slate-400 bg-slate-900 dark:bg-slate-400 dark:ring-offset-slate-700"></div>
      </span>
          <span class="sidebarDotIcon collapsed-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
        <div class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150"></div>
      </span>
        </div>
        <button class="sidebarCloseIcon text-2xl">
          <iconify-icon class="text-slate-900 dark:text-slate-200" icon="clarity:window-close-line"></iconify-icon>
        </button>
      </div>
      <div id="nav_shadow" class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none
      opacity-0"></div>
      <div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] overflow-y-auto z-50" id="sidebar_menus">
        <ul class="sidebar-menu">

        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{url('admin/dashboard')}}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:home"></iconify-icon>
            <span>Dashboard</span>
              </span>
            </a>
          </li>

          @if(Auth::user()->role=='admin')

          <li class="{{ Request::is('buses') ? 'active' : '' }}">
            <a href="{{url('buses')}}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:user-group"></iconify-icon>
            <span>Buses</span>
              </span>
            </a>
          </li>

          <li class="{{ Request::is('bus-off-days') ? 'active' : '' }}">
            <a href="{{url('bus-off-days')}}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:user-group"></iconify-icon>
            <span>Bus Off Days</span>
              </span>
            </a>
          </li>

          <li class="{{ Request::is('bus_stations') ? 'active' : '' }}">
            <a href="{{url('bus_stations')}}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:user-group"></iconify-icon>
            <span>Bus Stations</span>
              </span>
            </a>
          </li>
          <li class="{{ Request::is('bus_pickup_drop_points*') ? 'active' : '' }}">
            <a href="{{ route('bus_pickup_drop_points.index') }}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:map-pin"></iconify-icon>
            <span>Pickup/Drop Points</span>
              </span>
            </a>
          </li>
          <li class="{{ Request::is('bus_stopages') ? 'active' : '' }}">
            <a href="{{url('bus_stopages')}}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:user-group"></iconify-icon>
            <span>Bus Stopages</span>
              </span>
            </a>
          </li>
          <li class="{{ Request::is('passengers*') ? 'active' : '' }}">
            <a href="{{ route('admin.passengers.index') }}" class="navItem">
              <span class="flex items-center">
                <iconify-icon class="nav-icon" icon="heroicons-outline:users"></iconify-icon>
                <span>Passengers</span>
              </span>
            </a>
          </li>
 
          <!-- <li class="{{ Request::is('conductors') ? 'active' : '' }}">
            <a href="{{url('conductors')}}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:user-group"></iconify-icon>
            <span>Conductors</span>
              </span>
            </a>
          </li> -->
          @endif

          <li class="{{ Request::is('tickets') ? 'active' : '' }}">
            <a href="{{url('tickets')}}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:arrow-path"></iconify-icon>
            <span>Tickets</span>
              </span>
            </a>
          </li>

          <li class="{{ Request::is('payment-settings') ? 'active' : '' }}">
            <a href="{{url('payment-settings')}}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:arrow-path"></iconify-icon>
            <span>Payment Settings</span>
              </span>
            </a>
          </li>

          <li class="{{ Request::is('change-password') ? 'active' : '' }}">
            <a href="{{ route('password.change') }}" class="navItem">
              <span class="flex items-center">
                <iconify-icon class="nav-icon" icon="heroicons-outline:lock-closed"></iconify-icon>
                <span>Change Password</span>
              </span>
            </a>
          </li>

          <!-- <li class="{{ Request::is('conductor/tickets') ? 'active' : '' }}">
            <a href="{{url('conductor/tickets')}}" class="navItem">
              <span class="flex items-center">
              <iconify-icon class=" nav-icon" icon="heroicons-outline:user-group"></iconify-icon>
            <span>Conductor Tickets</span>
              </span>
            </a>
          </li>

          <li class="{{ Request::is('passenger/tickets') ? 'active' : '' }}">
            <a href="{{url('passenger/tickets')}}" class="navItem">
              <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="heroicons-outline:arrow-path"></iconify-icon>
            <span>Passenger Tickets</span>
              </span>
            </a>
          </li> -->


        </ul>
      </div>
    </div>