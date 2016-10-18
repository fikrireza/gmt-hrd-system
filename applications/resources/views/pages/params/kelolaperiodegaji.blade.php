@extends('layouts.master')

@section('title')
    <title>Kelola Periode Gaji</title>
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Periode Pemrosesan Gaji
    <small>Kelola Periode Gaji</small>
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
            <h4 class="modal-title">Hapus Periode Gaji</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus periode gaji ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <a href="#" class="btn btn-danger" id="set">Ya, saya yakin.</a>
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
          <h3 class="box-title">Formulir Tambah Periode Gaji</h3>
        </div>
        <form class="form-horizontal" action="{{route('periodegaji.store')}}" method="post">
          {{csrf_field()}}
        <div class="box-body">
            <div class="col-md-14 ">
              <label class="control-label">Per Tanggal</label>
              <input type="text" name="tanggal" class="form-control" placeholder="Tanggal Periode Penggajian" id="tanggal">
            </div>
            <div class="col-md-14 ">
              <label class="control-label">Keterangan</label>
              <textarea name="keterangan" rows="4" cols="40" class="form-control"></textarea>
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
          <h3 class="box-title">Seluruh Periode Penggajian</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              @if (count($getperiode)!=0)
                @foreach ($getperiode as $key)
                  <div class="col-md-6">
                    <div class="small-box bg-primary">
                      <div class="inner">
                        <h3>Periode: {{$key->tanggal}}</h3>
                        <p>Pemrosesan Gaji Per Tanggal {{$key->tanggal}} Tiap Bulan</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <a href="{{route('periodegaji.detail', $key->id)}}" class="small-box-footer">
                        Lihat detail pegawai di periode ini &nbsp; <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
            <div class="row">
              {{-- <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Menampilkan 1 s/d {!! $getkomponen->count() !!}  dari {!! count($getkomponen) !!} Data</div>
              </div>
              <div class="col-sm-7">
                <div class="pull-right">
                  {{ $getkomponen->links() }}
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
  {{-- datepicker --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>


  <script type="text/javascript">
    $(function(){
      // $('a.hapus').click(function(){
      //   var a = $(this).data('value');
      //   $('#set').attr('href', "{{ url('/') }}/masterjabatan/hapusjabatan/"+a);
      // });

      $('#tanggal').datepicker({
        format: 'dd',
        startView: "date",
        minViewMode: "date"
      });
    });
  </script>
@stop
