@extends('layouts.master')

@section('title')
    <title>Kelola Batch Payroll</title>
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Batch Payroll
    <small>Kelola Batch Payroll</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kelola Batch Payroll</li>
  </ol>
@stop

@section('content')
    <script>
      window.setTimeout(function() {
        $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
      }, 2000);
      window.setTimeout(function() {
        $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
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
            <h4 class="modal-title">Hapus Batch Payroll</h4>
          </div>
          <div class="modal-body">
            <p>Seluruh data penggajian pegawai yang telah di generate akan terhapus, apakah anda yakin untuk menghapus Batch Payroll ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <a href="#" class="btn btn-danger" id="set">Ya, saya yakin.</a>
            {{-- <button type="button" class="btn btn btn-outline" data-dismiss="modal">Ya, saya yakin.</button> --}}
          </div>
        </div>

      </div>
    </div>

    <div class="modal modal-default fade" id="myModalEdit" role="dialog">
    <div class="modal-dialog">
     <form class="form-horizontal" action="" method="post">
      {{ csrf_field() }}
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Batch Payroll</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Periode Penggajian</label>
              <div class="col-sm-9">
              <select class="form-control" name="periode">
                <option>-- Pilih --</option>
                @foreach ($getperiode as $key)
                  <option value="{{$key->id}}">Per Tanggal {{$key->tanggal}}</option>
                @endforeach
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Tanggal Pemrosesan</label>
              <div class="col-sm-9">
               <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right datepicker1" type="text" name="tanggal_proses" id="tanggaledit" placeholder="Tanggal Proses">
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tidak</button>
            <a href="#" class="btn btn-success" id="set">Simpan Perubahan</a>
            {{-- <button type="button" class="btn btn btn-outline" data-dismiss="modal">Ya, saya yakin.</button> --}}
          </div>
        </div>
      </form>
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
      @if(Session::has('messagefail'))
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-close"></i> Oops, terjadi kesalahan!</h4>
          <p>{{ Session::get('messagefail') }}</p>
        </div>
      @endif
    </div>

    <div class="col-md-5">
      <!-- Horizontal Form -->
      <form class="form-horizontal" action="{{route('batchpayroll.store')}}" method="post">
          {{csrf_field()}}
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Batch Payroll</h3>
        </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Periode Penggajian</label>
              <div class="col-sm-9">
              <select class="form-control" name="periode">
                <option>-- Pilih --</option>
                @foreach ($getperiode as $key)
                  <option value="{{$key->id}}">Per Tanggal {{$key->tanggal}}</option>
                @endforeach
              </select>
              </div>
            </div>
            <div class="form-group">
             <label class="col-md-3 control-label">Tanggal Pemprosesan</label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right datepicker1" type="text" name="tanggal_proses" id="tanggal" placeholder="Tanggal Proses">
                </div>
                </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right btn-sm">Generate Batch</button>
            <button type="reset" class="btn btn-danger btn-sm">Reset Formulir</button>
          </div>
        </div>
      </form>
    </div><!--/.col -->

    <div class="col-md-7">
      <div class="box box-primary box-solid">
        <div class="box-header">
          <h3 class="box-title">Seluruh Batch Payroll</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">
                      <th>No</th>
                      <th>Periode Gaji</th>
                      <th>Tanggal Pemrosesan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $pageget;
                      if($getbatch->currentPage()==1)
                        $pageget = 1;
                      else
                        $pageget = (($getbatch->currentPage() - 1) * $getbatch->perPage())+1;
                    @endphp
                    @foreach ($getbatch as $key)
                      <tr>
                        <td>{{$pageget}}</td>
                        <td>Per Tanggal {{$key->tanggal}}</td>
                        <td>
                          @php
                            $date = explode("-", $key->tanggal_proses);
                          @endphp
                          {{$date[2]}}-{{$date[1]}}-{{$date[0]}}
                        </td>
                        <td>
                          <span data-toggle="tooltip" title="Lihat Detail">
                            <a href="{{route('batchpayroll.detail', $key->id)}}" class="btn btn-xs btn-primary edit"><i class="fa fa-eye"></i></a>
                          </span>
                          <span data-toggle="tooltip" title="Edit Data">
                            <a href="" class="btn btn-xs btn-warning edit" data-toggle="modal" data-target="#myModalEdit" data-value="{{$key->id}}"><i class="fa fa-edit"></i></a>
                          </span>
                          <span data-toggle="tooltip" title="Hapus Data">
                            <a href="" class="btn btn-xs btn-danger hapus" data-toggle="modal" data-target="#myModal" data-value="{{$key->id}}"><i class="fa fa-remove"></i></a>
                          </span>
                        </td>
                      </tr>
                      @php
                        $pageget++;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                {{-- <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Menampilkan 1 s/d {!! $getkomponen->count() !!}  dari {!! count($getkomponen) !!} Data</div> --}}
              </div>
              <div class="col-sm-7">
                <div class="pull-right">
                  {{ $getbatch->links() }}
                </div>
              </div>
            </div>
          </div>
          </div><!-- /.box-body -->
        </div>
      </div><!--/.col -->


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

      $('#tanggal').datepicker();
      $('#tanggaledit').datepicker();
    });
  </script>
   <script type="text/javascript">
  $('.datepicker1').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    daysOfWeekDisabled: [0,6]
  });
  </script>
@stop
