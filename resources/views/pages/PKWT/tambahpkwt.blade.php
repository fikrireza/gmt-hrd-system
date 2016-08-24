@extends('layouts.master')

@section('title')
  <title>Tambah Data PKWT</title>
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Data PKWT
    <small>Kelola Data PKWT</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kelola Data PKWT</li>
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
    <!--column -->
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
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Tambah Data PKWT</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{url('add-pkwt/proses')}}">
          {!! csrf_field() !!}
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">NIP</label>
              <div class="col-sm-4">
                <select name="id_pegawai" class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                  @foreach($getnip as $key)
                    <option value="{{ $key->id }}">{{ $key->nip }} - {{ $key->nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Client</label>
              <div class="col-sm-4">
                <select name="id_cabang_client" class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                  @foreach($getclient as $client)
                    <optgroup label="{{ $client->nama_client}}">
                      @foreach($getcabang as $key)
                        @if($client->id == $key->id_client)
                          <option value="{{ $key->id }}">{{ $key->kode_cabang }} - {{ $key->nama_cabang }}</option>
                        @endif
                      @endforeach
                    </optgroup>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Kelompok Jabatan</label>
              <div class="col-sm-4">
                <select name="id_kelompok_jabatan" class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                  @foreach($get_kel_jabatan as $key)
                    <option value="{{ $key->id }}">{{ $key->nip }} - {{ $key->nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Awal PKWT</label>
              <div class="col-sm-3">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal_awal_pkwt" class="form-control" id="tanggal_awal_pkwt" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Akhir PKWT</label>
              <div class="col-sm-3">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal_akhir_pkwt" class="form-control" id="tanggal_akhir_pkwt" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Masuk GMT</label>
              <div class="col-sm-3">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal_masuk_gmt" class="form-control" id="tanggal_masuk_gmt" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Kerja Pada Client</label>
              <div class="col-sm-3">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input readonly type="text" name="tanggal_masuk_client" class="form-control" id="tanggal_masuk_client" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status Karyawan</label>
              <div class="col-sm-3">
                <select class="form-control" name="status_karyawan_pkwt">
                  <option>-- Pilih --</option>
                  <option value="1">Kontrak</option>
                  <option value="2">Freelance</option>
                  <option value="3">Tetap</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status PKWT</label>
              <div class="col-sm-3">
                <select class="form-control" name="status_pkwt">
                  {{-- <option>-- Pilih --</option> --}}
                  <option value="1">Aktif</option>
                  <option value="0">Tidak Aktif</option>
                  {{-- <option value="Tetap">Tetap</option> --}}
                </select>
              </div>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="reset" class="btn btn-default">Cancel</button>
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div><!-- /.box-footer -->
        </form>
      </div><!-- /.box -->
    </div>
  </div>   <!-- /.row -->


  <!-- jQuery 2.1.4 -->
  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>

  <!-- date time -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>

  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
    });
  </script>

  <script type="text/javascript">
    $(function(){
      $("#tanggal_awal_pkwt").datepicker({
        format: 'yyyy-mm-dd'
      });
      $("#tanggal_akhir_pkwt").datepicker({
        format: 'yyyy-mm-dd'
      });
      $("#tanggal_masuk_gmt").datepicker({
        format: 'yyyy-mm-dd'
      });

      $('#tanggal_masuk_gmt').change(function(){
        var value = $(this).val();
        $('#tanggal_masuk_client').val(value);
      });
    });
  </script>
@stop
