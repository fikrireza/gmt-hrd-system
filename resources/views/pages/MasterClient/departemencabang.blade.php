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
    <li><a href="{{ url()->previous()}}"> Cabang</a></li>
    <li class="active">Cabang Client</li>
  </ol>
@stop

@section('content')
      <div class="row">

        <div class="col-md-12">
        @if (session('status'))
          <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
            {{ session('status') }}
          </div>
        @endif
        </div>

        <div class="col-md-5">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Departemen Cabang : {!! $CabangClient->nama_cabang !!}</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="row">
                <div class="col-md-12">
                  <form class="form-horizontal" method="post" action="{{url('departemencabang')}}">
                    {!! csrf_field() !!}
                    <div class="box-body">
                      <div class="form-group {{ $errors->has('kode_departemen') ? 'has-error' : '' }}">
                        <label class="col-sm-5 control-label">Kode Departemen</label>
                        <div class="col-sm-7">
                          <input type="text" name="kode_departemen" class="form-control" placeholder="Kode Departemen" maxlength="5" value="{{ old('kode_departemen') }}">
                          @if($errors->has('kode_departemen'))
                            <span class="help-block">
                              <strong>{{ $errors->first('kode_departemen')}}
                              </stron>
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('nama_departemen') ? 'has-error' : '' }}">
                        <label class="col-sm-5 control-label">Nama Departemen</label>
                        <div class="col-sm-7">
                          <input type="text" name="nama_departemen" class="form-control" placeholder="Nama Departemen" maxlength="45" value="{{ old('nama_departemen') }}">
                          @if($errors->has('nama_departemen'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nama_departemen')}}
                              </stron>
                            </span>
                          @endif
                        </div>
                      </div>
                      <input type="hidden" name="id_cabang" class="form-control" value="{!! $CabangClient->id !!}">
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
                  <h3 class="box-title">Tabel Departemen Cabang : {!! $CabangClient->nama_cabang !!}</h3>
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
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Kode Departemen</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Nama Departemen</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($DepartemenCabang as $Departemen)
                    <tr>
                      <td class="">{!! $Departemen->kode_departemen !!}</td>
                      <td class="">{!! $Departemen->nama_departemen !!}</td>
                      <td><a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
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
                    {!! $DepartemenCabang->render() !!}
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
