@extends('layouts.master')

@section('title')
  @if(isset($data['bindjabatan']))
    <title>Edit Data Jabatan</title>
  @else
    <title>Tambah Data Jabatan</title>
  @endif
@stop

@section('breadcrumb')
  <h1>
    Master Jabatan
    <small>Kelola Data Jabatan</small>
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
    <div class="modal modal-default fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus Data Jabatan</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus data jabatan ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <a href="{{url('masterjabatan/hapusjabatan/1')}}" class="btn btn-primary" id="set">Ya, saya yakin.</a>
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
            <h3 class="box-title">Formulir Edit Data Jabatan</h3>
          @else
            <h3 class="box-title">Formulir Tambah Data Jabatan</h3>
          @endif
        </div><!-- /.box-header -->
        <!-- form start -->
        @if(isset($data['bindjabatan']))
          {!! Form::model($data['bindjabatan'], ['route' => ['masterjabatan.update', $data['bindjabatan']->id], 'method' => "patch", 'class'=>'form-horizontal']) !!}
        @else
          <form class="form-horizontal" method="post" action="{{url('masterjabatan')}}">
        @endif
          {!! csrf_field() !!}
          <div class="box-body">
            <div class="form-group {{ $errors->has('kode_jabatan') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Kode Jabatan</label>
              <div class="col-sm-9">
                <input
                  @if(isset($data['bindjabatan']))
                    value="{{$data['bindjabatan']->kode_jabatan}}"
                  @else
                    value=<?php echo $data['kodegenerate']?>
                  @endif
                  readonly="true"
                  type="text" name="kode_jabatan" class="form-control" placeholder="Kode Jabatan" maxlength="6"
                  @if(!$errors->has('kode_jabatan'))
                   value="{{ old('kode_jabatan') }}"
                  @endif
                >

                @if($errors->has('kode_jabatan'))
                 <span class="help-block">
                   <strong>{{ $errors->first('kode_jabatan')}}
                   </strong>
                 </span>
                @endif
              </div>
            </div>
            <div class="form-group {{ $errors->has('nama_jabatan') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Nama Jabatan</label>
              <div class="col-sm-9">
                <input
                  @if(isset($data['bindjabatan']))
                    value="{{$data['bindjabatan']->nama_jabatan}}"
                  @endif
                  type="text" name="nama_jabatan" class="form-control" placeholder="Nama Jabatan"
                  @if(!$errors->has('nama_jabatan'))
                    value="{{ old('nama_jabatan') }}"
                  @endif
                >
                @if($errors->has('nama_jabatan'))
                 <span class="help-block">
                   <strong>{{ $errors->first('nama_jabatan')}}
                   </strong>
                 </span>
                @endif
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
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Seluruh Data Jabatan</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">
                      <th>No</th>
                      <th>Kode Jabatan</th>
                      <th>Nama Jabatan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                @if($data['getjabatan']->isEmpty())
                  <tr>
                    <td colspan="4" class="text-muted" style="text-align:center;"><i>Data jabatan tidak tersedia.</i></td>
                  </tr>
                @else
                  <?php
                    $pageget;
                    if($data['getjabatan']->currentPage()==1)
                      $pageget = 1;
                    else
                      $pageget = (($data['getjabatan']->currentPage() - 1) * $data['getjabatan']->perPage())+1;
                  ?>
                  @foreach($data['getjabatan'] as $key)
                    <tr>
                      <td>{{ $pageget }}</td>
                      <td>{{ $key->kode_jabatan }}</td>
                      <td>{{ $key->nama_jabatan }}</td>
                      <td>
                        @if($key->id == '999')
                          <span data-toggle="tooltip" title="Tidak Dapat Dirubah">
                            <i class="fa fa-remove"></i>
                          </span>
                        @else
                        <a href="{{ route('masterjabatan.edit', $key->id) }}" class="btn btn-xs btn-warning" data-toggle='tooltip' title='Edit Data'><i class="fa fa-edit"></i></a>
                        <span data-toggle="tooltip" title="Hapus Data">
                          <a href="" class="btn btn-xs btn-danger hapus" data-toggle="modal" data-target="#myModal" data-value="{{$key->id}}"><i class="fa fa-remove"></i></a>
                        </span>
                        @endif
                      </td>
                    </tr>
                    <?php $pageget++; ?>
                  @endforeach
                @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Menampilkan 1 s/d {!! $data['getjabatan']->count() !!}  dari {!! $data['getjabatan']->total() !!} Jabatan</div>
              </div>
              <div class="col-sm-7">
                <div class="pull-right">
                  {{ $data['getjabatan']->links() }}
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

  <script type="text/javascript">
    $(function(){
      $('a.hapus').click(function(){
        var a = $(this).data('value');
        $('#set').attr('href', "{{ url('/') }}/masterjabatan/hapusjabatan/"+a);
      });
    });
  </script>
@stop
