@extends('layouts.master')

@section('title')
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Dashboard
    @if (Auth::user()->level=="1")
      <small>Akses Human Resources</small>
    @elseif (Auth::user()->level=="2")
      <small>Akses Payroll</small>
    @endif
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
@stop

@section('content')

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $jumlah_pegawai }}</h3>
          <p>Jumlah Pegawai Aktif</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-people"></i>
        </div>
        <a href="{{ route('masterpegawai.index') }}" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$jumlah_pkwt_menuju_expired}}</h3>
          <p>PKWT Menuju Expired</p>
        </div>
        <div class="icon">
          <i class="ion ion-alert-circled"></i>
        </div>
        <a class="small-box-footer">
          <i>
          {{$jumlah_pkwt_menuju_expired}}
          Data PKWT Menuju Expired</i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$jumlah_pkwt_expired}}</h3>
          <p>PKWT Expired</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-clipboard"></i>
        </div>
        <a class="small-box-footer">
          <i>
            {{$jumlah_pkwt_expired}}
            Data PKWT Expired</i>
        </a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $jumlah_client }}</h3>
          <p>Jumlah Client</p>
        </div>
        <div class="icon">
          <i class="fa fa-building-o"></i>
        </div>
        <a href="{{ url('masterclient') }}" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
  </div><!-- /.row -->
  <!-- Main row -->

  @if (Auth::user()->level=="1")
    <div class="row">
      <section class="col-md-12">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Seluruh Data PKWT</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="table table-hover" id="tabelpkwt">
              <thead>
                <tr>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Tanggal Awal PKWT</th>
                  <th>Tanggal Akhir PKWT</th>
                  <th>Status Karyawan</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="box-footer">
            <a href="{{url('data-pkwt')}}" class="btn btn-success pull-right"><i class="fa fa-file"></i> &nbsp;&nbsp;Kelola Data PKWT</a>
          </div>
        </div>
      </section>
    </div><!-- /.row (main row) -->
  @endif

  @if (Auth::user()->level=="2")
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary box-solid">
          <div class="box-header">
            <div class="box-title">
              Batch Payroll
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Batch ID</th>
                    <th>Periode</th>
                    <th>Cut Off Absen</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @for ($i=0; $i < 7; $i++)
                    <tr>
                      <td>312313</td>
                      <td>Per Tanggal 25</td>
                      <td>19-03-1999 s/d 18-03-1999</td>
                      <td><span class="badge bg-green">Dummy</span></td>
                      <td>
                        <a href="#" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box box-primary box-solid">
          <div class="box-header">
            <div class="box-title">
              Master Client
            </div>
          </div>
          <div class="box-body">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="#">CIMB Niaga <span class="badge bg-blue pull-right"> 12 Cabang</span></a></li>
              <li><a href="#">PT Antam <span class="badge bg-green pull-right"> 4 Cabang</span></a></li>
              <li><a href="#">Indosat <span class="badge bg-yellow pull-right"> 2 Cabang</span></a></li>
              <li><a href="#">Dummy <span class="badge bg-red pull-right"> 2 Cabang</span></a></li>
              <li><a href="#">Dummy <span class="badge bg-maroon pull-right"> 2 Cabang</span></a></li>
              <li><a href="#">Dummy <span class="badge bg-navy pull-right"> 2 Cabang</span></a></li>
              <li><a href="#">Dummy <span class="badge bg-blue pull-right"> 2 Cabang</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  @endif

  <!-- jQuery 2.1.4 -->
  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>

  @if (Auth::user()->level=="1")
    <script type="text/javascript">
    $(function() {
      $('#tabelpkwt').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.dash') !!}',
        column: [
          {data: 'id', name: 'id'},
          {data: '0', name: 'nip'},
          {data: '1', name: 'nama'},
          {data: '2', name: 'tanggal_awal_pkwt'},
          {data: '3', name: 'tanggal_akhir_pkwt'},
          {data: '4', name: 'status_karyawan_pkwt'},
          {data: '5', name: 'keterangan'}
        ]
      });
    });
    </script>
  @endif

@stop
