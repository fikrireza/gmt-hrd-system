@extends('layouts.master')

@section('title')
    <title>Tambah Data Jabatan</title>
@stop

@section('breadcrumb')
  <h1>
    Komponen Gaji
    <small>Kelola Komponen Gaji</small>
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
    <div class="col-md-4">
      <!-- Horizontal Form -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Tambah Komponen Gaji</h3>
        </div>
        <form class="form-horizontal" action="{{route('komgaji.store')}}" method="post">
          {{csrf_field()}}
        <div class="box-body">
            <div class="col-md-14 ">
              <label class="control-label">Nama Komponen</label>
              <input type="text" name="nama_komponen" class="form-control" placeholder="Nama Komponen">
            </div>
            <div class="col-md-14 ">
              <label class="control-label">Tipe Komponen</label>
              <select class="form-control" name="tipe_komponen">
                <option>-- Pilih --</option>
                <option value="D">Penerimaan</option>
                <option value="P">Potongan</option>
              </select>
            </div>
            <div class="col-md-14 ">
              <label class="control-label">Periode Perhitungan</label>
              <select class="form-control" name="periode_perhitungan">
                <option>-- Pilih --</option>
                <option value="Bulanan">Bulanan</option>
                <option value="Harian">Harian</option>
                <option value="Jam">Jam</option>
                <option value="Shift">Shift</option>
              </select>
            </div>
        </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right btn-sm btn-flat">Simpan</button>
            <button type="reset" class="btn btn-default btn-sm btn-flat">Reset Formulir</button>
          </div>
        </div>
      </form>
    </div><!--/.col -->

    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Seluruh Komponen Gaji</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">
                      <th>No</th>
                      <th>Nama</th>
                      <th>Tipe</th>
                      <th>Periode</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($getkomponen)!=0)
                      @php
                        $i=1;
                      @endphp
                      @foreach ($getkomponen as $key)
                        <tr>
                          <td>
                            {{$i}}
                          </td>
                          <td>
                            {{$key->nama_komponen}}
                          </td>
                          <td>
                            @if ($key->tipe_komponen=="D")
                              <span class="badge bg-green">Penerimaan</span>
                            @elseif ($key->tipe_komponen=="P")
                              <span class="badge bg-red">Potongan</span>
                            @endif
                          </td>
                          <td>
                            {{$key->periode_perhitungan}}
                          </td>
                          <td>
                            <span data-toggle="tooltip" title="Edit Data">
                              <a href="" class="btn btn-xs btn-warning edit" data-toggle="modal" data-target="#myModalEdit" data-value="{{$key->id}}"><i class="fa fa-edit"></i></a>
                            </span>
                            <span data-toggle="tooltip" title="Hapus Data">
                              <a href="" class="btn btn-xs btn-danger hapus" data-toggle="modal" data-target="#myModal" data-value="{{$key->id}}"><i class="fa fa-remove"></i></a>
                            </span>
                          </td>
                        </tr>
                        @php
                          $i++;
                        @endphp
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              {{-- <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Menampilkan 1 s/d {!! $data['getjabatan']->count() !!}  dari {!! $data['getjabatan']->total() !!} Jabatan</div>
              </div>
              <div class="col-sm-7">
                <div class="pull-right">
                  {{ $data['getjabatan']->links() }}
                </div>
              </div> --}}
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
