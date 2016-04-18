@extends('layouts.master')

@section('title')
  <title>Tambah Data Pegawai</title>
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
        <!--column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{url('masterpegawai')}}">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-4">
                    <input type="text" name="nip" class="form-control" placeholder="NIP">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Pegawai</label>
                  <div class="col-sm-4">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Pegawai">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-4">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-4">
                    <textarea class="form-control" name="alamat" rows="8" cols="40" placeholder="Alamat"></textarea>
                  </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
              </div><!-- /.box-footer -->
            </form>
          </div><!-- /.box -->
        </div><!--/.col -->
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


@stop
