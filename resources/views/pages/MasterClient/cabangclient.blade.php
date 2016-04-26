@extends('layouts.master')

@section('title')
  <title>Tambah Data Cabang Client</title>
@stop

@section('breadcrumb')
  <h1>
    Cabang Client
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ url('masterclient')}}"> Master Client</a></li>
    <li class="active">Cabang Client</li>
  </ol>
@stop

@section('content')
      <div class="row">
        <div class="col-md-12">
        @if (session('status'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
            {{ session('status') }}
          </div>
        @endif
        </div>
        <div class="col-md-5">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Cabang Client : {!! $MasterClient->nama_client !!}</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="row">
                <div class="col-md-12">
                  <form class="form-horizontal" method="post" action="{{url('cabangclient')}}">
                    {!! csrf_field() !!}
                    <div class="box-body">
                      <div class="form-group {{ $errors->has('kode_cabang') ? 'has-error' : '' }}">
                        <label class="col-sm-4 control-label">Kode Cabang</label>
                        <div class="col-sm-8">
                          <input type="text" name="kode_cabang" class="form-control" placeholder="Kode Cabang" maxlength="5" value="{{ old('kode_cabang') }}">
                          @if($errors->has('kode_cabang'))
                            <span class="help-block">
                              <strong>{{ $errors->first('kode_cabang')}}
                              </stron>
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('nama_cabang') ? 'has-error' : '' }}">
                        <label class="col-sm-4 control-label">Nama Cabang</label>
                        <div class="col-sm-8">
                          <input type="text" name="nama_cabang" class="form-control" placeholder="Nama Cabang" maxlength="40" value="{{ old('nama_cabang') }}">
                          @if($errors->has('nama_cabang'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nama_cabang')}}
                              </stron>
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('alamat_cabang') ? 'has-error' : ''}}">
                        <label class="col-sm-4 control-label">Alamat Cabang</label>
                        <div class="col-sm-8">
                          <textarea name="alamat_cabang" class="form-control" rows="2" placeholder="Alamat Cabang">{{ old('alamat_cabang')}}</textarea>
                          @if($errors->has('alamat_cabang'))
                            <span class="help-block">
                              <strong>{{ $errors->first('alamat_cabang')}}
                              </stron>
                            </span>
                          @endif
                        </div>
                      </div>
                      <input type="hidden" name="id_client" class="form-control" value="{!! $MasterClient->id !!}">
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-info pull-right">Simpan</button>
                    </div><!-- /.box-footer -->
                  </form>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-7">
          <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Tabel Cabang : {!! $MasterClient->nama_client !!}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="dataTables_length" id="example1_length"><label>Show
                          <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                          </select> entries</label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                          <label>Search:
                            <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Kode cabang</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama cabang</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Alamat Cabang</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="2">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($CabangClient as $Cabang)
                    <tr>
                      <td class="">{!! $Cabang->kode_cabang !!}</td>
                      <td class="">{!! $Cabang->nama_cabang !!}</td>
                      <td class="">{!! $Cabang->alamat_cabang !!}</td>
                      <td><a href="" class="btn btn-warning" ><i class="fa fa-edit" alt="Ubah"></i></a></td>
                      <td><i class="glyphicon glyphicon-open"></i><a href="{{ url('masterclient/departemen', $Cabang->id )}}">Tambah Departemen</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-5">
                  <!--<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>-->
                </div>
                <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                    {!! $CabangClient->render() !!}
                  </div>
                </div>
              </div>
            </div>
                </div><!-- /.box-body -->
              </div>
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
