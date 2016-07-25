@extends('layouts.master')

@section('title')
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Dashboard
    <small>Control panel</small>
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
          <p>Jumlah Pegawai</p>
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
          <h3>10</h3>
          <p>PKWT Menuju Expired</p>
        </div>
        <div class="icon">
          <i class="ion ion-alert-circled"></i>
        </div>
        <a class="small-box-footer">
          <i>
          10
          Data PKWT Menuju Expired</i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>123</h3>
          <p>PKWT Expired</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-clipboard"></i>
        </div>
        <a class="small-box-footer">
          <i>
            123
            Data PKWT Expired</i>
        </a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>12</h3>
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
  <div class="row">
    <section class="col-md-12">
      <div class="box box-primary box solid">
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
                <th>Status PKWT</th>
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
              {data: '4', name: 'status_pkwt'},
              {data: '5', name: 'keterangan'}
            ]
        });

    });
  </script>

@stop
