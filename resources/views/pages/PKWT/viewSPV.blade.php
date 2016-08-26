@extends('layouts.master')

@section('title')
  <title>Lihat Detail PKWT</title>
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
  <style>
  .datepicker{z-index:1151 !important;}
  </style>
@stop

@section('breadcrumb')
  <h1>
    SPV Manajemen
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">SPV Manajemen</li>
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
      {{-- @elseif(Session::has('terminate'))
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
          <p>{{ Session::get('terminate') }}</p>
        </div> --}}
      @endif
    </div>
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Pilih Client</h3>
        </div>
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ url('getClientSPV') }}">
          {!! csrf_field() !!}
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Client</label>
              <div class="col-sm-4">
                <select name="id_client" class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected"></option>
                  @foreach($getClient as $key)
                    <option value="{{ $key->id }}">{{ $key->kode_client }} - {{ $key->nama_client }}</option>
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

      @if(isset($getSpv))
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">SPV Terikat PKWT</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12" style="margin-bottom:20px;">
            <form class="form-horizontal" method="post" action="{{ url('changeSPV') }}">
              {!! csrf_field() !!}
              <div class="form-group">
                <label class="col-sm-4 control-label">SPV Lama</label>
                <div class="col-sm-4">
                  <select name="spv_lama" class="form-control select2" style="width: 100%;" required="">
                    <option selected="selected"></option>
                    @foreach($spvExist as $key)
                      <option value="{{ $key->id }}">{{ $key->nip }} - {{ $key->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">SPV Baru</label>
                <div class="col-sm-4">
                  <select name="new_spv" class="form-control select2" style="width: 100%;" required="">
                    <option selected="selected"></option>
                    @foreach($spvExist as $key)
                      <option value="{{ $key->id }}">{{ $key->nip }} - {{ $key->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="from-group">
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-info pull-right">Simpan</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-12">
            <div class="box box-success box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Histori PKWT</h3>
              </div>
              <div class="box-body">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>Nama Karyawan</th>
                      <th>Client Departemen</th>
                      <th>Tanggal Awal PKWT</th>
                      <th>Tanggal Akhir PKWT</th>
                      <th>Kelompok Jabatan</th>
                      <th>Keterangan</th>
                    </tr>
                    @foreach($getSpv as $key)
                    <tr>
                      <td>{{ $key->nama_karyawan }}</td>
                      <td>{{ $key->nama_client }} - {{ $key->nama_cabang }}</td>
                      <td>{{ $key->tanggal_awal_pkwt }}</td>
                      <td>{{ $key->tanggal_akhir_pkwt }}</td>
                      <td>{{ $key->spv }}</td>
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
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>


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
      $("#tanggal_masuk_client").datepicker({
        format: 'yyyy-mm-dd'
      });

      $('.edit_pkwt').click(function(){
        var a = $(this).data('value');
        $.ajax({
          url: "{{ url('/') }}/edit-pkwt/getpkwt/"+a,
          dataType: 'json',
          success: function(data){
            var id_pkwt = data.id;
            var tanggal_masuk_gmt = data.tanggal_masuk_gmt;
            var tanggal_masuk_client = data.tanggal_masuk_client;
            var tanggal_awal_pkwt = data.tanggal_awal_pkwt;
            var tanggal_akhir_pkwt = data.tanggal_akhir_pkwt;
            var status_karyawan_pkwt = data.status_karyawan_pkwt;
            var status_pkwt = data.status_pkwt;

            // set
            $('#id_pkwt').attr('value', id_pkwt);
            $('#tanggal_masuk_gmt').attr('value', tanggal_masuk_gmt);
            $('#tanggal_masuk_client').attr('value', tanggal_masuk_client);
            $('#tanggal_awal_pkwt').attr('value', tanggal_awal_pkwt);
            $('#tanggal_akhir_pkwt').attr('value', tanggal_akhir_pkwt);

            // alert(status_pkwt);
            if(status_pkwt=="1")
            {
              $('#status_pkwt_aktif').attr('selected', 'true');
            }
            else if(status_pkwt=="0")
            {
              $('#status_pkwt_tidakaktif').attr('selected', 'true');
            }

            if(status_karyawan_pkwt=="1")
            {
              $('#status_karyawan_kontrak').attr('selected', "true");
            }
            else if(status_karyawan_pkwt=="2")
            {
              $('#status_karyawan_freelance').attr('selected', "true");
            }
            else if(status_karyawan_pkwt=="3")
            {
              $('#status_karyawan_freelance').attr('selected', "true");
            }
          }
        });
      });
    });
  </script>
@stop
