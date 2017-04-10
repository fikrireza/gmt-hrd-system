@extends('layouts.master')

@section('title')
    <title>Kelola Komponen Gaji</title>
@stop

@section('breadcrumb')
  <h1>
    Input Pegawai ke Periode
    <small>Kelola Payroll</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Pegewai ke Periode</li>
  </ol>
@stop

@section('content')
  <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 2000);
  </script>



  <div class="row">

    <div class="col-md-12">
      @if(Session::has('message'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        <p>{{ Session::get('message') }}</p>
      </div>
      @endif
    </div>

    <div class="col-md-12">
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Input Pegawai ke Periode</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12" style="margin-bottom:20px;">
          </div>
          <div class="col-md-12">
            <form class="form-horizontal" method="post" action="{{route('periodepegawai.store')}}"> <!-- START FORM -->
              {!! csrf_field() !!}
              <div class="form-group">
                <label class="col-sm-4 control-label">Pilih Periode</label>
                <div class="col-sm-4">
                  <select name="periodegaji" class="form-control select2" style="width: 100%;" required="">
                    <option selected="selected"></option>
                    @foreach($periodeGaji as $key)
                      <option value="{{ $key->id }}">{{ $key->tanggal }} - {{ $key->keterangan }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Pilih Pegawai</h3>
              </div>
                <div class="box-body">
                  <table id="example1" class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Karyawan</th>
                        <th>Client Departemen</th>
                        <th>Tanggal Awal PKWT</th>
                        <th>Tanggal Akhir PKWT</th>
                        <th>Kelompok Jabatan</th>
                        <th>Keterangan</th>
                      </tr>
                      <thead>
                        <tbody>
                          @foreach($pkwtActive as $key)
                            <tr>
                              <td><input type="checkbox" class="minimal" name="idpegawai[]" value="{{$key->idpegawai}}"></td>
                              <td>{{ $key->nama }}</td>
                              <td>{{ $key->nama_client }} - {{ $key->nama_cabang }}</td>
                              <td>{{ $key->tanggal_awal_pkwt }}</td>
                              <td>{{ $key->tanggal_akhir_pkwt }}</td>
                              <td>{{ $key->spv_nama }}</td>
                              <td><?php
                              $date1=date_create($key->tanggal_akhir_pkwt);
                              $date2=date_create(gmdate("Y-m-d", time()+60*60*7));
                              $diff=date_diff($date2,$date1);
                              $sym = substr($diff->format("%R%a"), 0, 1);
                              $days = substr($diff->format("%R%a"), 1);
                              if($days==0)
                              {
                                echo "<span class='label bg-yellow'>Expired Hari Ini</span>";
                              }
                              elseif($sym=="+" && $days <= 30)
                              {
                                echo "<span class='label bg-yellow'>Expired Dalam ".$days." Hari</span>";
                              }
                              elseif($sym=="+" && $days > 30)
                              {
                                echo "<span class='label bg-green'>PKWT Aktif</span>";
                              }
                              elseif($sym=="-")
                              {
                                echo "<span class='label bg-red'>Telah Expired</span>";
                              }?></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="box-footer">
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-success pull-right">Simpan</button>
                      </div>
                    </div>
                </form> <!-- END FORM -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  {{-- <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script> --}}
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <script>

  $("#example1").DataTable();

  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
          });
  </script>

@stop
