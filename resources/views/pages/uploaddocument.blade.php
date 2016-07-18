@extends('layouts.master')

@section('title')
  @if(isset($data['bindjabatan']))
    <title>Edit Data Dokumen Pegawai</title>
  @else
    <title>Tambah Data Dokumen Pegawai</title>
  @endif
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Dokumen Pegawai
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
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

    <!--start Modal delete dokumen -->
    <div class="modal modal-default fade" id="modalDeleteDocument" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus Data Dokumen Pegawai</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus data Dokumen Pegawai ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <a href="" class="btn btn btn-primary" id="set">Ya, saya yakin.</a>
          </div>
        </div>
      </div>
    </div>
    <!--start Modal delete dokumen -->

    <!--start Modal update dokumen -->
    <div class="modal modal-default fade" id="modalUpdateDocument" role="dialog">
      <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Data Dokumen Pegawai</h4>
          </div>
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-3 control-label">NIP</label>
                <div class="col-sm-6">
                  <select name="nip" class="form-control select2" style="width: 100%;">
                    <option selected="selected"></option>
                    @foreach($data['getpegawai'] as $key)
                      <option value="{{ $key->id }}">{{ $key->nip }} - {{ $key->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_Dokumen">
                <div class="box-body">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th width="500px">Nama Dokumen</th>
                        <th width="700px">Unggah Dokumen</th>
                      </tr>
                      <tr>
                        <td>
                          <div class="{{ $errors->has('nama_dokumen') ? 'has-error' : '' }}">
                            {!! Form::text('data_dokumen[0][nama_dokumen]', null ,['class'=>'form-control', 'placeholder'=>'Nama Dokumen']) !!}
                          </div>
                        </td>
                        <td>
                          <div class="{{ $errors->has('unggah_dokumen') ? 'has-error' : '' }}">
                            {!! Form::file('data_dokumen[0][unggah_dokumen]', null ,['class'=>'form-control', 'placeholder'=>'Unggah Dokumen']) !!}
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <a href="" class="btn btn btn-primary" id="set">Simpan Perubahan</a>
          </div>
        </div>
      </div>
    </div>
    <!--start Modal update dokumen -->

    <!--start Modal add dokumen -->
    <div class="modal modal-default fade" id="modalAddDocument" role="dialog">
      <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data Dokumen Pegawai</h4>
          </div>
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-3 control-label">NIP</label>
                <div class="col-sm-6">
                  <select name="nip" class="form-control select2" style="width: 100%;">
                    <option selected="selected"></option>
                    @foreach($data['getpegawai'] as $key)
                      <option value="{{ $key->id }}">{{ $key->nip }} - {{ $key->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_Dokumen">
                <div class="box-body">
                  <table class="table" id="duploaddocument">
                    <tbody>
                      <tr>
                        <th></th>
                        <th width="500px">Nama Dokumen</th>
                        <th width="700px">Unggah Dokumen</th>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="chk"/></td>
                        <td>
                          <div class="{{ $errors->has('nama_dokumen') ? 'has-error' : '' }}">
                            {!! Form::text('data_dokumen[0][nama_dokumen]', null ,['class'=>'form-control', 'placeholder'=>'Nama Dokumen']) !!}
                          </div>
                        </td>
                        <td>
                          <div class="{{ $errors->has('unggah_dokumen') ? 'has-error' : '' }}">
                            {!! Form::file('data_dokumen[0][unggah_dokumen]', null ,['class'=>'form-control', 'placeholder'=>'Unggah Dokumen']) !!}
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer clearfix">
                  <div class="col-md-9">
                    <label class="btn btn-round bg-green" onclick="adduploaddocument('duploaddocument')">Tambah Dokumen</label>&nbsp;<label class="btn btn-round bg-red" onclick="deluploaddocument('duploaddocument')">Hapus Dokumen</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <a href="" class="btn btn btn-primary" id="set">Simpan</a>
          </div>
        </div>
      </div>
    </div>
    <!--start Modal add dokumen -->

  <div class="row">
    <!--pesan sukses -->
    <div class="col-md-12">
      @if(Session::has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
          <p>{{ Session::get('message') }}</p>
        </div>
      @endif
    </div>
    <!--list dokumen -->
    <div class="col-md-12">
        <div class="box box-info" style="min-height:500px">
          <div class="box-header">
            <h3>Data Dokumen</h3>
            <button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalAddDocument"><i class="fa fa-plus"></i> Tambah Dokumen </button>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-bordered">
              <tr class="bg-navy">
                <th>No</th>
                <th>Id Pegawai</th>
                <th>Tipe Dokumen</th>
                <th>Nama Dokumen</th>
                <th>Aksi</th>
              </tr>
              <?php $pageget = 1; ?>
              @foreach($data['getdocument'] as $key)
                <tr>
                  <td>{{ $pageget }}</td>
                  <td>{{ $key->id_pegawai }}</td>
                  <td>{{ $key->upload_kk }}</td>
                  <td>{{ $key->upload_ktp }}</td>
                  <td>
                    <span data-toggle="tooltip" title="Edit Data">
                      <a href="" class="btn btn-warning btn-xs edit" data-toggle="modal" data-target="#modalUpdateDocument" data-value="{{$key->id}}"><i class="fa fa-edit"></i></a>
                    </span>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-danger btn-xs hapus" data-toggle="modal" data-target="#modalDeleteDocument" data-value="{{$key->id}}"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                <?php $pageget++; ?>
              @endforeach
            </table>
          </div>
        </div>
      </div>
      <!--list dokumen -->
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
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
    });
  </script>
  <script language="javascript">
    var numA=1;
    function adduploaddocument(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;

        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';

        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<input type="text" name="data_dokumen['+numA+'][nama_dokumen]" class="form-control" placeholder="Nama Dokument"@if(!$errors->has('nama_dokumen'))value="{{ old('nama_dokumen') }}"@endif>@if($errors->has('nama_dokumen'))<span class="help-block"><strong><h6>{{ $errors->first('nama_dokumen')}}</h6></strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<input type="file" name="data_dokumen['+numA+'][unggah_dokumen]"@if(!$errors->has('unggah_dokumen'))value="{{ old('unggah_dokumen') }}"@endif>@if($errors->has('unggah_dokumen'))<span class="help-block"><strong><h6>{{ $errors->first('unggah_dokumen')}}</h6></strong></span>@endif';

        numA++;
    }

    function deluploaddocument(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
                numA--;
            }
        }
        }catch(e) {
            alert(e);
        }
    }
  </script>
@stop
