<style>
   .right-bar-style{
      margin: 0px;
      padding: 0px;
      list-style-type: none;
   }
   .right-bar-style li:not(:last-child){
      border-bottom: 1px solid #ffffff;
   }
   .right-bar-style li a{
      color: #ffffff;
      display: block;
      padding: 5px;
   }
</style>
<aside class="control-sidebar control-sidebar-dark" style="display: none; top: 0px; height: 210px;">
   <!-- Control sidebar content goes here -->
   <div class="p-3 control-sidebar-content os-host os-theme-light os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden os-host-transition" style="height: 210px;">
      
      <ul class="right-bar-style">
         <li><a href="{{ route('password.change') }}">Change Password</a></li>
         <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
            </form>
         </li>
      </ul>
      

   </div>
</aside>