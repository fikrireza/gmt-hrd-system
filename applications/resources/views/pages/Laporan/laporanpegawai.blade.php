@extends('layouts.master')

@section('title')
  <title>Laporan Pegawai</title>
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Laporan
    <small>Data Pegawai</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laporan Pegawai</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <!--column -->
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Pilih Client</h3>
        </div>
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ url('laporan-proses') }}">
          {!! csrf_field() !!}
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Client</label>
              <div class="col-sm-4">
                <select name="id_client" class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                  @foreach($getClient as $key)
                    <option value="{{ $key->id }}" @if(isset($proses))@if($key->id == $idClient) selected="" @endif @endif>{{ $key->kode_client }} - {{ $key->nama_client }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Proses</button>
          </div>
        </form>
      </div>
    </div>
    @if(isset($proses))
    <div class="col-md-12">
      <div class="box box-success box-solid">
        <div class="box-header">
          <div class="pull-left">
            <button type="button" class="btn btn btn-default" data-clipboard-text="{{ url('report').'/'.$proses[0]->kode_client.'/'.$proses[0]->token }}">Copy Url</button>
          </div>
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-default">Download</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ URL::to('laporan-proses/'.$idClient.'/xlsx') }}">Excel</a></li>
            </ul>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-hover" id="tabellaporan">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Departemen</th>
                <th>Kelompok Jabatan</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Masuk GMT</th>
                <th>Tanggal Masuk Client</th>
              </tr>
            </thead>
            <tbody>
              @foreach($proses as $key)
                <tr>
                  <td>{{ $key->nip }}</td>
                  <td>{{ $key->nama }}</td>
                  <td>{{ $key->nama_client }} - {{$key->nama_cabang}}</td>
                  <td>{{ $key->spv }}</td>
                  <td>{{ $key->nama_jabatan }}</td>
                  <td>{{ $key->jenis_kelamin }}</td>
                  <td>{{ $key->tanggal_masuk_gmt }}</td>
                  <td>{{ $key->tanggal_masuk_client }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          {{ $proses->links()}}
        </div>
      </div>
    </div>
    @endif

  </div>

  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <script src="{{asset('plugins/clipboard/clipboard.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
    });

    var clipboard = new Clipboard('.btn');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
  </script>
@stop
