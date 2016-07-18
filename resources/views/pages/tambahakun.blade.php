@extends('layouts.master')

@section('title')
  <title>Tambah Akun Baru</title>
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
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
    <!--column -->
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Tambah Akun</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{url('useraccount')}}">
          {!! csrf_field() !!}
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">NIP</label>
              <div class="col-sm-4">
                <select name="nip" class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                  @foreach($getnip as $key)
                    <option value="{{ $key->id }}">{{ $key->nip }} - {{ $key->nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Username</label>
              <div class="col-sm-4">
                <input type="text" name="username" class="form-control" placeholder="Username">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Password</label>
              <div class="col-sm-4">
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Konfirmasi Password</label>
              <div class="col-sm-4">
                <input type="password" name="kpassword" class="form-control" placeholder="Konfirmasi Password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Level Akses</label>
              <div class="col-sm-4">
                <select class="form-control" name="level">
                  <option></option>
                  <option value="1">Akses HR</option>
                  <option value="2">Akses Payroll</option>
                  <option value="3">Akses Direktur Operasional</option>
                </select>
              </div>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="reset" class="btn btn-default">Cancel</button>
            <button type="submit" class="btn btn-info pull-right">Sign in</button>
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

  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
    });
  </script>
@stop
