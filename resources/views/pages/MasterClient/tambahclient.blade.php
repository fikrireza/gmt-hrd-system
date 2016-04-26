@extends('layouts.master')

@section('title')
  <title>Tambah Data Client</title>
@stop

@section('breadcrumb')
  <h1>
    Master Client
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ url('masterclient')}}"> Master Client</a></li>
    <li class="active">Data Client</li>
  </ol>
@stop

@section('content')
      <div class="row">
        <!--column -->
        <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Data Client</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{url('masterclient')}}">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group {{ $errors->has('kode_client') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Kode Client</label>
                  <div class="col-sm-4">
                    <input type="text" name="kode_client" class="form-control" placeholder="Kode Client" maxlength="5" value="{{ old('kode_client') }}">
                  </div>
                  @if($errors->has('kode_client'))
                    <span class="help-block">
                      <strong>{{ $errors->first('kode_client')}}
                      </stron>
                    </span>
                  @endif
                </div>
                <div class="form-group {{ $errors->has('nama_client') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Nama Client</label>
                  <div class="col-sm-4">
                    <input type="text" name="nama_client" class="form-control" placeholder="Nama Client" maxlength="20" value="{{ old('nama_client') }}">
                  </div>
                  @if($errors->has('nama_client'))
                    <span class="help-block">
                      <strong>{{ $errors->first('nama_client')}}
                      </stron>
                    </span>
                  @endif
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
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
