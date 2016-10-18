@extends('layouts.master')

@section('title')
  @if(isset($data['bindjabatan']))
    <title>Edit Data Dokumen Pegawai</title>
  @else
    <title>Tambah Data Dokumen Pegawai</title>
  @endif
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@stop

@section('breadcrumb')
  <h1>Dokumen Pegawai</h1>
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
    <div class="modal modal-default fade" id="modalDelete" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus Data Dokumen Pegawai</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus dokumen pegawai ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <a class="btn btn btn-primary" id="setdelete">Ya, saya yakin.</a>
          </div>
        </div>
      </div>
    </div>
    <!--start Modal delete dokumen -->

    <!--start Modal edit dokumen -->
    <div class="modal modal-default fade" id="modalEdit" role="dialog">
      <div class="modal-dialog" style="width:50%">
        <form class="form-horizontal" action="{{ route('upload.edit') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Data Dokumen Pegawai</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <div class="col-sm-1">
                  {{-- divider --}}
                </div>
                <label class="col-sm-2">Pilih NIP</label>
                <div class="col-sm-8">
                  <input type="hidden" name="id_doc" id="edit_id_doc">
                  <select name="id_pegawai" class="form-control select2" style="width: 100%;" id="edit_nip">
                    @foreach($data['getpegawai'] as $key)
                      <option value="{{ $key->id }}" id="peg{{$key->id}}">{{ $key->nip }} - {{ $key->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-1">
                  {{-- divider --}}
                </div>
                <label class="col-sm-2">Nama Dokumen</label>
                <div class="col-sm-8">
                  <input type="text" name="nama_dokumen" class="form-control" required id="edit_nama_dokumen">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-1">
                  {{-- divider --}}
                </div>
                <label class="col-sm-2">File Dokumen</label>
                <div class="col-sm-8">
                  <input type="file" name="file_dokumen" class="form-control">
                  <span style="color:#001f3f">* Biarkan kosong jika tidak ingin diubah.</span>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn btn-default pull-left" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn btn-primary" >Simpan Perubahan</button>
            </div>
        </div>
      </form>
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
          <form action="{{ route('uploaddocument.store') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="modal-body">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-1 control-label" style="padding-right:0px;padding-top:4px;">Pilih NIP</label>
                  <div class="col-sm-6">
                    <select name="id_pegawai" class="form-control select2" style="width: 100%;">
                      <option selected="selected"></option>
                      @foreach($data['getpegawai'] as $key)
                        <option value="{{ $key->id }}">{{ $key->nip }} - {{ $key->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <br>
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
                            <div>
                              <input type="text" name="nama_dokumen[]" class="form-control">
                            </div>
                          </td>
                          <td>
                            <div>
                              <input type="file" name="file_dokumen[]" class="form-control">
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
              <button type="submit" class="btn btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--start Modal add dokumen -->

  <div class="row">
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
      <div class="box box-success box-solid">
        <div class="box-header">
          <a class="btn btn-round bg-red" data-toggle="modal" data-target="#modalAddDocument"><i class="fa fa-plus"></i>&nbsp; Tambah Dokumen Pegawai</a>
        </div>
        <div class="box-body">
          <table class="table table-hover" id="tabeldokumen">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Nama Dokumen</th>
                <th>File Dokumen</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>   <!-- /.row -->

  <!-- jQuery 2.1.4 -->
  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>

  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>


  <script type="text/javascript">
    $(function() {
        $('#tabeldokumen').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{!! route('datatables.doc') !!}',
          column: [
            {data: 'id', name: 'id'},
            {data: '0', name: 'nip'},
            {data: '1', name: 'nama'},
            {data: '2', name: 'nama_dokumen'},
            {data: '3', name: 'file_dokumen'},
            {data: '4', name: 'tanggal_upload'}
          ]
        });

        $('#tabeldokumen').DataTable().on('click', '.hapusdoc[data-value]', function(){
          var a = $(this).data('value');
          $('#setdelete').attr('href', "{{ url('/') }}/uploaddokumen/hapusdokumen/"+a);
        });

        $('#tabeldokumen').DataTable().on('click', '.editdoc[data-value]', function(){
          var a = $(this).data('value');
          $.ajax({
            url: "{{ url('/') }}/upload/bind-data/"+a,
            dataType: 'json',
            success: function(data){
              //get
              var id_doc = data.id;
              var edit_nama_dokumen = data.nama_dokumen;
              var id_peg = data.id_pegawai;

              // set
              $("#edit_id_doc").attr('value', id_doc);
              $('#edit_nama_dokumen').attr('value', edit_nama_dokumen);
              $('option').attr('selected', false);
              $('option#peg'+id_peg).attr('selected', true);
              $(".select2").select2();
            }
          });
        });
    });
  </script>

  <script type="text/javascript">
  $(document).ready(function(){
    $(".select2").select2();
  });
  </script>

  <script language="javascript">
    function test(){
      var a = $(this).attr('data-value');
      alert(a);
    }

    var numA=1;
    function adduploaddocument(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;

        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';

        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<input type="text" name="nama_dokumen[]" class="form-control" placeholder="Nama Dokument"@if(!$errors->has('nama_dokumen'))value="{{ old('nama_dokumen') }}"@endif>@if($errors->has('nama_dokumen'))<span class="help-block"><strong><h6>{{ $errors->first('nama_dokumen')}}</h6></strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<input type="file" class="form-control" name="file_dokumen[]" @if(!$errors->has('file_dokumen'))value="{{ old('file_dokumen') }}"@endif>@if($errors->has('file_dokumen'))<span class="help-block"><strong><h6>{{ $errors->first('file_dokumen')}}</h6></strong></span>@endif';

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