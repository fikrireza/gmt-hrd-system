@extends('layouts.master')

@section('title')
  <title>Lihat Detail PKWT</title>
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Detail PKWT
    <small>Lihat Detail PKWT</small>
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Detail PKWT</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
          <div class="col-md-12" style="margin-bottom:20px;">
            <table style="font-size:18px;">
              <tr>
                <td width="80px"><b>NIP</b></td>
                <td>:</td>
                <td style="padding-left:10px;">{{ $getnip[0]->nip }}</td>
              </tr>
              <tr>
                <td><b>Nama</b></td>
                <td>:</td>
                <td style="padding-left:10px;">{{ $getnip[0]->nama }}</td>
              </tr>
            </table>
          </div>
          <div class="col-md-12">
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Seluruh PKWT Untuk Pegawai Terkait</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>Tanggal Masuk GMT</th>
                      <th>Tanggal Bekerja di Client</th>
                      <th>Tanggal Awal PKWT</th>
                      <th>Tanggal Akhir PKWT</th>
                      <th>Status PKWT</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>

                    @foreach($getpkwt as $key)
                      <tr>
                        <td>{{$key->tanggal_masuk_gmt}}</td>
                        <td>{{$key->tanggal_masuk_client}}</td>
                        <td>{{$key->tanggal_awal_pkwt}}</td>
                        <td>{{$key->tanggal_akhir_pkwt}}</td>
                        <td>
                          @if($key->status_pkwt==1)
                            Kontrak
                          @elseif($key->status_pkwt==2)
                            Freelance
                          @elseif($key->status_pkwt==3)
                            Tetap
                          @endif
                        </td>
                        <td>
                          <?php
                            $date1=date_create($key->tanggal_akhir_pkwt);
                            $date2=date_create(date("Y-m-d"));
                            $diff=date_diff($date2,$date1);
                            $sym = substr($diff->format("%R%a"), 0, 1);
                            $days = substr($diff->format("%R%a"), 1);
                            if($sym=="+" && $days <= 30)
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
                            }
                          ?>
                        </td>
                        <td>
                          <a href="#" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
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
      $("#tanggal_masuk_client").datepicker({
        format: 'yyyy-mm-dd'
      });
    });
  </script>
@stop
