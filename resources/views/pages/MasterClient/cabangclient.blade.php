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
    <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 1500);
    </script>
      <div class="row">
        <div class="col-md-12">
        @if (session('tambah'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
            {{ session('tambah') }}
          </div>
        @endif
        @if (session('ubah'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
            {{ session('ubah') }}
          </div>
        @endif
        </div>
        <div class="col-md-5">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">
                @if(isset($CabangEdit))
                  Ubah Data Cabang
                @else
                  Tambah Cabang Client : {!! $MasterClient->nama_client !!}
                @endif
                </h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="row">
                <div class="col-md-12">
                  @if(isset($CabangEdit))
            			  {!! Form::model($CabangClient, ['method' => 'PATCH', 'url' => ['cabangclient', $CabangEdit->id], 'class'=>'form-horizontal']) !!}
            			@else
            			  <form class="form-horizontal" method="post" action="{{url('cabangclient')}}">
            			@endif
                    {!! csrf_field() !!}
                    <div class="box-body">
                      <div class="form-group {{ $errors->has('kode_cabang') ? 'has-error' : '' }}">
                        <label class="col-sm-4 control-label">Kode Cabang</label>
                        <div class="col-sm-8">
                          <input type="text" name="kode_cabang" class="form-control" placeholder="Kode Cabang" maxlength="5"
                          @if(isset($CabangEdit))
                  				  value="{{$CabangEdit->kode_cabang}}" readonly=""
                  				@else
                  				value="{{ 'CAB'.$AutoNumber }}" readonly=""
                  				@endif
                  				>
                          @if($errors->has('kode_cabang'))
                            <span class="help-block">
                              <strong>{{ $errors->first('kode_cabang')}}
                              </strong>
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('nama_cabang') ? 'has-error' : '' }}">
                        <label class="col-sm-4 control-label">Nama Cabang</label>
                        <div class="col-sm-8">
                          <input type="text" name="nama_cabang" class="form-control" placeholder="Nama Cabang" maxlength="40" @if(isset($CabangEdit))
                  				  value="{{$CabangEdit->nama_cabang}}"
                  				@else
                  				value="{{ old('nama_cabang') }}"
                  				@endif
                  				>
                          @if($errors->has('nama_cabang'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nama_cabang')}}
                              </strong>
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('alamat_cabang') ? 'has-error' : ''}}">
                        <label class="col-sm-4 control-label">Alamat Cabang</label>
                        <div class="col-sm-8">
                          <textarea name="alamat_cabang" class="form-control" rows="2" placeholder="Alamat Cabang">@if(isset($CabangEdit)){{$CabangEdit->alamat_cabang}}@else{{old('alamat_cabang')}}@endif</textarea>
                          @if($errors->has('alamat_cabang'))
                            <span class="help-block">
                              <strong>{{ $errors->first('alamat_cabang')}}
                              </strong>
                            </span>
                          @endif
                        </div>
                      </div>
                      <input type="hidden" name="id_client" class="form-control"
                      @if(isset($CabangEdit))
                        value="{{$MasterClient->id }}"
                      @else
                      value="{!! $MasterClient->id !!}"
                      @endif >
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      @if(isset($CabangEdit))
                        {{-- <button type="button" class="btn btn-default pull-left">Kembali</button> --}}
                			  <button type="submit" class="btn btn-info pull-right">Simpan Perubahan</button>
                			@else
                			  <button type="submit" class="btn btn-info pull-right" style="margin-left:5px;">Simpan</button>
                        <button type="reset" class="btn btn-default pull-right">Reset Formulir</button>
                			@endif
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
                  <h3 class="box-title">Data Cabang Client : {!! $MasterClient->nama_client !!}</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                          <tr role="row">
                            <th>No</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Kode cabang</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama cabang</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Alamat Cabang</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="2">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $page = $CabangClient->currentPage();
                        if($page == 1){
                          $no = 1;
                        }elseif($page == 2){
                          $no = 11;
                        }elseif($page == 3){
                          $no = 21;
                        }elseif($page == 4){
                          $no = 31;
                        }
                        ?>
                          @foreach($CabangClient as $Cabang)
                            <tr>
                              <td>{!! $no++ !!}</td>
                              <td class="">{!! $Cabang->kode_cabang !!}</td>
                              <td class="">{!! $Cabang->nama_cabang !!}</td>
                              <td class="">{!! $Cabang->alamat_cabang !!}</td>
                              <td>
                                <a href="{{ url('cabangclient', $Cabang->id).('/edit')}}" class="btn btn-xs btn-warning"  data-toggle='tooltip' title='Edit Data'><i class="fa fa-edit" alt="Ubah"></i></a>
                                <a href="{{ url('departemencabang', $Cabang->id )}}" class="btn btn-xs btn-success" data-toggle='tooltip' title='Tambah Departemen'><i class="fa fa-plus"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Menampilkan 1 s/d {!! $CabangClient->count() !!} dari {!! $CabangClient->total() !!} Cabang</div>
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
