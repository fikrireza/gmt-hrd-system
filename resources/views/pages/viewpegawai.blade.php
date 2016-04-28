@extends('layouts.master')

@section('title')
  <title>Lihat Data Pegawai</title>
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Seluruh Data Pegawai
    <small>Berikut adalah seluruh data pegawai pada database.</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-danger box-solid">
        <div class="box-header">
            Data ditampilkan dalam bentuk tabular.
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped" id="tabelpegawai">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>No Telp</th>
                <th>Jabatan</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>   <!-- /.row -->


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
        $('#tabelpegawai').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.data') !!}',
            column: [
              {data: 'nip', name: 'nip'},
              {data: 'nama', name: 'name'},
              {data: 'jenis_kelamin', name: 'jenis_kelamin'},
              {data: 'no_telp', name: 'no_telp'},
              {data: 'id_jabatan', name: 'id_jabatan'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
  </script>

@stop
