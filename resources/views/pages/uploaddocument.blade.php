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
    Master Dokumen Pegawai
    <small>Kelola Data Dokumen Pegawai</small>
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

    <!-- Modal -->
    <div class="modal modal-warning fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus Data Dokumen Pegawai</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus data Dokumen Pegawai ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
            <a href="{{url('masterjabatan/hapusjabatan/1')}}" class="btn btn btn-outline" id="set">Ya, saya yakin.</a>
            {{-- <button type="button" class="btn btn btn-outline" data-dismiss="modal">Ya, saya yakin.</button> --}}
          </div>
        </div>

      </div>
    </div>

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
    <div class="col-md-5">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          @if(isset($data['bindjabatan']))
            <h3 class="box-title">Formulir Edit Data Dokumen Pegawai</h3>
          @else
            <h3 class="box-title">Formulir Tambah Data Dokumen Pegawai</h3>
          @endif
        </div><!-- /.box-header -->
        <!-- form start -->
        @if(isset($data['bindjabatan']))
          {!! Form::model($data['bindjabatan'], ['route' => ['masterjabatan.update', $data['bindjabatan']->id], 'method' => "patch", 'class'=>'form-horizontal']) !!}
        @else
          <form class="form-horizontal" method="post" action="{{url('uploaddocument')}}">
        @endif
          {!! csrf_field() !!}
          <div class="box-body">
            <div class="form-group {{ $errors->has('upload_kk') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Unggah KK</label>
              <div class="col-sm-9">
                {!! Form::open(array('url'=>'items','files'=>true,'class'=>'register-form')) !!}
                        {!! Form::file('upload_kk') !!}
                {!! Form::close() !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('upload_ktp') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Unggah KTP</label>
              <div class="col-sm-9">
                <input
                  @if(isset($data['binduploaddocument']))
                    value="{{$data['binduploaddocument']->upload_ktp}}"
                  @endif
                  type="file" name="upload_ktp"
                  @if(!$errors->has('upload_ktp'))
                   value="{{ old('upload_ktp') }}"
                  @endif
                >
              </div>
            </div>
            <div class="form-group {{ $errors->has('upload_ijazah') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Unggah IJAZAH</label>
              <div class="col-sm-9">
                <input
                  @if(isset($data['binduploaddocument']))
                    value="{{$data['binduploaddocument']->upload_ijazah}}"
                  @endif
                  type="file" name="upload_ijazah"
                  @if(!$errors->has('upload_ijazah'))
                   value="{{ old('upload_ijazah') }}"
                  @endif
                >
              </div>
            </div>
            <div class="form-group {{ $errors->has('upload_foto') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Unggah FOTO</label>
              <div class="col-sm-9">
                <input
                  @if(isset($data['binduploaddocument']))
                    value="{{$data['binduploaddocument']->upload_foto}}"
                  @endif
                  type="file" name="upload_foto"
                  @if(!$errors->has('upload_foto'))
                   value="{{ old('upload_foto') }}"
                  @endif
                >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">NIP</label>
              <div class="col-sm-9">
                <select name="nip" class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                  @foreach($data['getpegawai'] as $key)
                    <option value="{{ $key->id }}">{{ $key->nip }} - {{ $key->nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-info pull-right" style="margin-left:5px;">
                  @if(isset($data['bindjabatan']))
                    Simpan Perubahan
                  @else
                    Simpan
                  @endif
                </button>
                  @if(!isset($data['bindjabatan']))
                    <button type="reset" class="btn btn-default pull-right">Reset Formulir</button>
                  @endif
              </div>
            </div>
          </div><!-- /.box-body -->
        @if(isset($data['bindjabatan']))
          {!! Form::close() !!}
        @else
          </form>
        @endif
      </div><!-- /.box -->
    </div><!--/.col -->

    <div class="col-md-7">
      <div class="box box-info" style="min-height:500px">
        <div class="box-header">
          <h3 class="box-title">Seluruh Data Jabatan</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>No</th>
              <th>Tipe Dokumen</th>
              <th>Nama Dokumen</th>
              <th>Aksi</th>
            </tr>
            <?php $pageget = 1; ?>
            @foreach($data['getdocument'] as $key)
              <tr>
                <td>{{ $pageget }}</td>
                <td>{{ $key->id_pegawai }}</td>
                <td>{{ $key->upload_foto }}</td>
                <td>
                  <a href="{{ route('masterjabatan.edit', $key->id) }}" class="btn btn-warning" data-toggle='tooltip' title='Edit Data'><i class="fa fa-edit"></i></a>
                  <span data-toggle="tooltip" title="Hapus Data">
                    <a href="" class="btn btn-danger hapus" data-toggle="modal" data-target="#myModal" data-value="{{$key->id}}"><i class="fa fa-remove"></i></a>
                  </span>
                </td>
              </tr>
              <?php $pageget++; ?>
            @endforeach
          </table>
        </div><!-- /.box-body -->
        {{-- <div class="box-footer clearfix pull-right">
          {!! $data['getjabatan']->links() !!}
        </div> --}}
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
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
    });
  </script>
  <script type="text/javascript">
    $(function(){
      $('a.hapus').click(function(){
        var a = $(this).data('value');
        $('#set').attr('href', "{{ url('/') }}/masterjabatan/hapusjabatan/"+a);
      });
    });
  </script>
@stop
