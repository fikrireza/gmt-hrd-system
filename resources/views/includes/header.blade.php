<a href="{{ url('')}}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>GMT</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg" style="font-size:18px;"><b>GMT</b>
    @if (Auth::user()->level=="1")
      Human Resources
    @elseif (Auth::user()->level="2")
      Payroll System
    @endif
  </span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          @if(Auth::check())
          @if(Auth::user()->url_foto!="")
            <img src="{{url('images')}}/{{Auth::user()->url_foto}}" class="user-image" alt="User Image">
          @else
            <img src="{{url('images')}}/user-not-found.png" class="user-image" alt="User Image">
          @endif
            <span class="hidden-xs">
              @if(Auth::user())
                {{ Auth::user()->master_pegawai->nama }}
              @endif
          @endif
            </span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            @if(Auth::check())
            @if(Auth::user()->url_foto!="")
              <img src="{{url('images')}}/{{Auth::user()->url_foto}}" class="user-image" alt="User Image">
            @else
              <img src="{{url('images')}}/user-not-found.png" class="user-image" alt="User Image">
            @endif
            <p>
              @if(Auth::user())
                {{ Auth::user()->master_pegawai->nama}}
              @endif
            @endif
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              @if(Auth::check())
              <a href="{{ url('useraccount/kelola-profile') }}/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
              @endif
            </div>
            <div class="pull-right">
              <a href="{{ url('logoutprocess') }}" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
