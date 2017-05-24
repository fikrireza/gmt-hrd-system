@extends('layouts.master')

@section('title')
    <title>Kelola Komponen Gaji</title>
@stop

@section('breadcrumb')
  <h1>
    Rapel Gaji
    <small>Perhitungan Rapel Gaji</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Perhitungan Rapel Gaji</li>
  </ol>
@stop

@section('content')
  <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 2000);

    window.setTimeout(function() {
      $(".alert-warning").fadeTo(500, 0).slideUp(500, function(){
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
      @if(Session::has('gagal'))
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-times"></i> Perhatian!</h4>
        <p>{{ Session::get('gagal') }}</p>
      </div>
      @endif
    </div>
    <div class="col-md-12">
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Pilih Client Area</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12" style="margin-bottom:20px;">
          </div>
          <div class="col-md-12">
              <form class="form-horizontal" method="post" action="#">
                {!! csrf_field() !!}
                <div class="callout callout-warning">
                  <label class="col-sm-2 control-label">Client</label>
                  <div class="col-sm-8">
                    <select name="id_client" class="form-control select2" style="width: 100%;" required="true">
                      <option selected="selected"></option>
                      @foreach($getClient as $client)
                        <optgroup label="{{ $client->nama_client}}">
                          @foreach($getCabang as $key)
                            @if($client->id == $key->id_client)
                              <option value="{{ $key->id }}">{{ $key->kode_cabang }} - {{ $key->nama_cabang }}</option>
                            @endif
                          @endforeach
                        </optgroup>
                      @endforeach
                    </select>
                  </div>
                   <button type="submit" class="btn btn-success">Proses</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Form Penyesuaian Gaji</h3>
          </div>
          <div class="box-body">
            <form class="form-horizontal" action="#" method="post">

            <div class="form-group ">
              <label class="col-sm-2 control-label">Client</label>
              <div class="col-sm-9">
                <input type="text" name="id_client" class="form-control">
              </div>
            </div>

            <div class="form-group ">
              <label class="col-sm-2 control-label">Cabang Client</label>
              <div class="col-sm-9">
                <input type="text" name="id_client" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal" class="form-control" id="tanggal">
                </div>
              </div>
            </div>

            <div class="form-group ">
              <label class="col-sm-2 control-label">Nilai Gaji</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <div class="input-group-addon">
                    Rp.
                  </div>
                  <input type="text" name="tanggal" class="form-control" id="tanggal">
                </div>
              </div>
            </div>

            <div class="form-group ">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-9">
                <textarea name="keterangan" rows="4" cols="40" class="form-control"></textarea>
              </div>
            </div>

        </form>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right btn-sm">Simpan</button>
            <button type="reset" class="btn btn-danger btn-sm">Reset Formulir</button>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Timeline Perubahan Gaji</h3>
          </div>
          <div class="box-body">
            <div class="row" style="margin-top:10px;">
              <div class="col-md-12">
                <ul class="timeline">
                  <li class="time-label" style="margin-left:8px;">
                    <span class="bg-red">
                      &nbsp;&nbsp;Start&nbsp;&nbsp;
                    </span>
                  </li>
                  <li>
                    <i class="fa fa-money bg-blue"></i>
                    <div class="timeline-item" style="background:#ddf2ff;">
                      <div class="timeline-body">
                        <span class="badge bg-green">2015</span> &nbsp;--&nbsp; Rp 1.200.000,-
                      </div>
                    </div>
                  </li>
                  <li>
                    <i class="fa fa-money bg-blue"></i>
                    <div class="timeline-item" style="background:#ddf2ff;">
                      <div class="timeline-body">
                        <span class="badge bg-green">2016</span> &nbsp;--&nbsp; Rp 1.500.000,-
                      </div>
                    </div>
                  </li>
                  <li>
                    <i class="fa fa-money bg-blue"></i>
                    <div class="timeline-item" style="background:#ddf2ff;">
                      <div class="timeline-body">
                        <span class="badge bg-green">2017</span> &nbsp;--&nbsp; Rp 1.700.000,-
                      </div>
                    </div>
                  </li>
                  <li class="time-label" style="margin-left:11px;">
                    <span class="bg-green">
                      &nbsp;&nbsp;End&nbsp;&nbsp;
                    </span>
                  </li>
                </ul>
              </div><!-- /.col -->
            </div><!-- /.row -->
            <span class="text-muted">
              <i>
                Timeline di generate dari histori perubahan gaji per client area.
              </i>
            </span>
          </div>
        </div>
      </div>




    </div>
  </div>

  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
    });
  </script>
  <script>
  $("#example1").DataTable();

  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
          });
  </script>
  <script type="text/javascript">
    function toggle(pilih) {
    checkboxes = document.getElementsByName('idpegawai[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = pilih.checked;
    }
  }
  </script>

@stop
