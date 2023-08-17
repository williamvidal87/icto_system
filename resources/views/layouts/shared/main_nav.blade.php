<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="image/logo/norsu.png" alt="Norsu" class="brand-image img-circle elevation-3" style="opacity: .8;max-height: 40px;margin-left: auto" >
      <span class="brand-text font-weight-light" style="font-size: 12pt">ICTO Support Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      
        <!-- for client nav -->
        @if(Auth::user()->rule_id==3)
          @include('layouts.shared.main_navs.client_nav')
        @endif
        
        <!-- for admin nav -->
        @if(Auth::user()->rule_id==1)
          @include('layouts.shared.main_navs.admin_nav')
        @endif
        
        <!-- for personnel nav -->
        @if(Auth::user()->rule_id==2)
          @include('layouts.shared.main_navs.personnel_nav')
        @endif
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>