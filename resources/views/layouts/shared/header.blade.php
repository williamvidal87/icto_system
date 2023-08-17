
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                  </li>
                  <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashboard" class="nav-link">Home</a>
                  </li>
                </ul>
            
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropdown">
                    <h2 class="nav-link">
                    Welcome {{ Auth::user()->getRule->rule_name }}!
                    </h2>
                  </li>
                  <!-- Messages Dropdown Menu -->
                  
                  <livewire:chat.chat-box />

                  <!-- Notifications Dropdown Menu -->
                  {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                      <i class="fa fa-history"></i>
                      <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      <span class="dropdown-item dropdown-header">15 Notifications</span>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                      </a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                      </a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                      </a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                  </li> --}}
                  
                  
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                      {{-- <img src="/storage/{{ Auth::user()->profile_photo_path ?? 'default-profile/admin-profile.png' }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}" width="25" height="25"> --}}
                      <img src="/storage/{{ Auth::user()->profile_photo_path ?? 'default-profile/admin-profile.png' }}" alt="{{ Auth::user()->name }}" class="rounded-full h-6 w-6 object-cover">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      <span class="dropdown-item dropdown-header"><i class="fa fa-circle" style="color:#4BB543"></i> {{ Auth::user()->name }}</span>
                      <div class="dropdown-divider"></div>
                      {{-- Profile Management--}}
                        <a href="/editprofileform" class="dropdown-item"><i class="fas fa-user-edit mr-2"></i>{{ __('Profile Management') }}</a>
                      {{-- Password Update--}}
                        <a href="/passwordupdate" class="dropdown-item"><i class="fa fa-key mr-2"></i>{{ __('Password Update') }}</a>
                      <!-- Log Out -->
                      <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}"
                        @click.prevent="$root.submit();" class="dropdown-item">
                          <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                        </a>
                      </form>
                    </div>
                  </li>
                </ul>
              </nav>