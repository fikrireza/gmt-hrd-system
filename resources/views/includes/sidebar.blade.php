<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset('/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>
        @if(Auth::user())
          {{ Auth::user()->username }}
        @endif
      </p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Master Pegawai</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('masterpegawai.index') }}"><i class="fa fa-circle-o"></i> Lihat Data Pegawai</a></li>
        {{-- <li><a href="{{ route('masterpegawai.create') }}"><i class="fa fa-circle-o"></i> Tambah Data Pegawai</a></li> --}}
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-briefcase"></i>
        <span>Master Jabatan</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('masterjabatan.create') }}"><i class="fa fa-circle-o"></i> Kelola Data Jabatan</a></li>
      </ul>
    </li>
    {{-- <li class="treeview">
      <a href="#">
        <i class="fa fa-commenting-o"></i>
        <span>Master Bahasa Asing</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('masterbahasaasing.create') }}"><i class="fa fa-circle-o"></i> Kelola Data Bahasa Asing</a></li>
      </ul>
    </li> --}}
    <li class="treeview">
         <a href="#">
           <i class="fa fa-file-text"></i>
           <span>Pelengkap Pegawai</span>
           <i class="fa fa-angle-left pull-right"></i>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{ route('masterpelengkappegawai.create') }}"><i class="fa fa-circle-o"></i> Kelola Data Pelengkap Pegawai</a></li>
         </ul>
       </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-building-o"></i>
        <span>Master Client</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ url('masterclient') }}"><i class="fa fa-circle-o"></i> Data Client</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>Management Akun</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('useraccount.create') }}"><i class="fa fa-circle-o"></i> Tambah Akun Baru</a></li>
      </ul>
    </li>
  </ul>
</section>
