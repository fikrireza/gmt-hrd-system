<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      @if(Auth::check())
      @if(Auth::user()->url_foto!="")
        <img src="{{url('images')}}/{{Auth::user()->url_foto}}" class="img-circle" alt="User Image">
      @else
        <img src="{{url('images')}}/user-not-found.png" class="img-circle" alt="User Image">
      @endif
      @endif
    </div>
    <div class="pull-left info">
      <p>
        @if(Auth::check())
        @if(Auth::user())
          {{ Auth::user()->master_pegawai->nama }}
        @endif
        @endif
      </p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

  <ul class="sidebar-menu">
    <li class="header">NAVIGASI UTAMA</li>
    <li>
      <a href="{{ url('/dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    @if (Auth::user()->level=="1")
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
          <i class="fa fa-users"></i>
          <span>Master Pegawai</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('masterpegawai.index') }}"><i class="fa fa-circle-o"></i> Data Pegawai</a></li>
          <li><a href="{{ route('uploaddocument.create') }}"><i class="fa fa-circle-o"></i> Kelola Dokumen Pegawai</a></li>
          <li><a href="{{ url('import') }}"><i class="fa fa-circle-o"></i> Import Data Pegawai</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-briefcase"></i>
          <span>Master Jabatan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('masterjabatan.create') }}"><i class="fa fa-circle-o"></i>Data Jabatan</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-file-text"></i>
          <span>Manajemen PKWT</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('data-pkwt')}}"><i class="fa fa-circle-o"></i>Data PKWT</a></li>
          <li><a href="{{url('spv-manajemen')}}"><i class="fa fa-circle-o"></i>SPV Manajemen</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Manajemen Akun</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('useraccount.create') }}"><i class="fa fa-circle-o"></i> Tambah Akun Baru</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-newspaper-o"></i>
          <span>Laporan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('laporanpegawai') }}"><i class="fa fa-circle-o"></i> Laporan Data Pegawai</a></li>
        </ul>
      </li>
    @endif

    @if (Auth::user()->level=="2")
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cog"></i>
          <span>Set Parameter</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('periodegaji.index')}}"><i class="fa fa-circle-o"></i> Periode Gaji</a></li>
          <li><a href="{{route('komgaji.index')}}"><i class="fa fa-circle-o"></i> Komponen Gaji</a></li>
          <li><a href="{{route('setgaji.index')}}"><i class="fa fa-circle-o"></i> Set Gaji Pegawai</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-money"></i>
          <span>Proses Payroll</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('periodepegawai.index') }}"><i class="fa fa-circle-o"></i> Input Pegawai Ke Periode</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Proses Gaji Per Batch</a></li>
        </ul>
      </li>
    @endif
  </ul>
</section>