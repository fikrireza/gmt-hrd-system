@extends('layouts.master')

@section('title')
    <title>Kelola Bpjs</title>
@stop

@section('breadcrumb')
  <h1>
    BPJS
    <small>Kelola Bpjs</small>
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

    window.setTimeout(function() {
      $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 5000);
  </script>

    <!-- Modal Hapus -->
    <div class="modal modal-default fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus Bpjs</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus Bpjs ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <a href="#" class="btn btn-danger" id="sethapus">Ya, saya yakin.</a>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal Update-->
    <div class="modal fade" id="myModalEdit" role="dialog">
    <div class="modal-dialog">
      <form class="form-horizontal" action="{{route('bpjs.update')}}" method="post">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Bpjs</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-3 control-label">Client</label>
              <div class="col-sm-9">
                <input type="hidden" name="id" class="form-control" id="id">
                <select name="id_cabang_client_edit" class="form-control select2" style="width: 100%;" id="id_cabang_client_edit">
                  <option selected="selected"></option>
                  @foreach($getClient as $client)
                    <optgroup label="{{ $client->nama_client}}">
                      @foreach($getCabang as $key)
                        @if($client->id == $key->id_client)
                          <option value="{{ $key->id }}" id="cel{{$key->id}}">{{ $key->kode_cabang }} - {{ $key->nama_cabang }}</option>
                        @endif
                      @endforeach
                    </optgroup>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Tipe Bpjs</label>
              <div class="col-sm-9">
              <select class="form-control" name="id_bpjs_edit" id="id_bpjs_edit">
                <option selected="selected"></option>
                  @foreach($getKomponentGaji as $key)
                    <option value="{{ $key->id }}" id="tipebpjs{{$key->id}}">{{ $key->nama_komponen }}</option>
                  @endforeach
              </select>
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Nilai</label>
              <div class="col-sm-9">
              <input type="text" name="bpjs_dibayarkan_edit" class="form-control" id="bpjs_dibayarkan_edit" placeholder="Nilai" id="bpjs_dibayarkan" onkeypress="return isNumber(event)">
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Keterangan</label>
              <div class="col-sm-9">
              <input type="text" name="keterangan_edit" class="form-control" placeholder="Keterangan" id="keterangan_edit">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-success">Simpan Perubahan</a>
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
          <h4><i class="icon fa fa-ban"></i> Oops, terjadi kesalahan!</h4>
          <p>{{ Session::get('messagefail') }}</p>
        </div>
      @endif
    </div>
    <div class="col-md-5">
      <form class="form-horizontal" action="{{route('bpjs.store')}}" method="post">
          {{csrf_field()}}
      <!-- Horizontal Form -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Tambah Bpjs</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
              <label class="col-sm-3 control-label">Client</label>
              <div class="col-sm-9">
                <select name="id_cabang_client" class="form-control select2" style="width: 100%;" required="true">
                  <option selected="selected"></option>
                  @foreach($getClient as $client)
                    <optgroup label="{{ $client->nama_client}}">
                      @foreach($getCabang as $key)
                        @if($client->id == $key->id_client)
                          <option value="{{ $key->id }}">{{ $key->kode_cabang }} - {{ $key->nama_cabang }}</option>
                        @endif
                      @endforeach
                    </optgroup>
                  @endforeach
                </select>
                @if($errors->has('id_cabang_client'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('id_cabang_client')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Tipe Bpjs</label>
              <div class="col-sm-9">
              <select class="form-control" name="id_bpjs" id="id_bpjs">
                <option selected="selected"></option>
                  @foreach($getKomponentGaji as $key)
                    <option value="{{ $key->id }}">{{ $key->nama_komponen }}</option>
                  @endforeach
              </select>
               @if($errors->has('id_bpjs'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('id_bpjs')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Nilai</label>
              <div class="col-sm-9">
              <input type="text" name="bpjs_dibayarkan" class="form-control" placeholder="Nilai" id="bpjs_dibayarkan" onkeypress="return isNumber(event)">
               @if($errors->has('bpjs_dibayarkan'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('bpjs_dibayarkan')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Keterangan</label>
              <div class="col-sm-9">
              <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
               @if($errors->has('keterangan'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('keterangan')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
        </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right btn-sm">Simpan</button>
            <button type="reset" class="btn btn-danger btn-sm">Reset Formulir</button>
          </div>
        </div>
      </form>
    </div><!--/.col -->

    <div class="col-md-7">
      <div class="box box-primary box-solid">
        <div class="box-header">
          <h3 class="box-title">Seluruh BPJS</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">
                      <th>No</th>
                      <th>Client</th>
                      <th>Tipe BPJS</th>
                      <th>Nilai</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($getbpjs)!=0)
                      @php
                        $pageget;
                        if($getbpjs->currentPage()==1)
                          $pageget = 1;
                        else
                          $pageget = (($getbpjs->currentPage() - 1) * $getbpjs->perPage())+1;
                      @endphp
                      @foreach ($getbpjs as $key)
                        <tr>
                          <td>
                            {{$pageget}}
                          </td>
                          <td>
                           {{$key->nama_client}} - {{$key->nama_cabang}}
                          </td>
                          <td>
                           {{$key->nama_komponen}}
                          </td>
                          <td>
                          Rp. {{ number_format($key->bpjs_dibayarkan,0,',','.') }},-
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
                          $pageget++;
                        @endphp
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                {{-- <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Menampilkan 1 s/d {!! $getbpjs->count() !!}  dari {!! count($getbpjs) !!} Data</div> --}}
              </div>
              <div class="col-sm-7">
                <div class="pull-right">
                  {{ $getbpjs->links() }}
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
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
    });
    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    }
  </script>

  <script type="text/javascript">
  $('.datepicker1').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    daysOfWeekDisabled: [0,6]
  });
  </script>
  <script type="text/javascript">
    $('#myModalEdit').on('hidden.bs.modal', function () {
     location.reload();
    });

    $('#myModal').on('hidden.bs.modal', function () {
     location.reload();
    });
  </script>

  <script type="text/javascript">
    $(function(){
       $('a.hapus').click(function(){
        var a = $(this).data('value');
          $('#sethapus').attr('href', "{{ url('/') }}/bpjs/delete/"+a);
      });

      $('a.edit').click(function(){
        var a = $(this).data('value');
        $.ajax({
          url: "{{url('/')}}/bpjs/bind-bpjs/"+a,
          success: function(data){
            //get
            var id = data.id;
            var id_bpjs_edit = data.id_bpjs;
            var keterangan_edit = data.  keterangan;
            var bpjs_dibayarkan_edit = data.bpjs_dibayarkan;
            var id_cabang_client_edit = data. id_cabang_client;
            
            //set
            $('#id').attr('value', id);

            $('option').attr('selected', false);
            $('option#cel'+id_cabang_client_edit).attr('selected', true);
            $('option#tipebpjs'+id_bpjs_edit).attr('selected', true);
            $(".select2").select2();

            $('#keterangan_edit').attr('value', keterangan_edit);
            $('#bpjs_dibayarkan_edit').attr('value', bpjs_dibayarkan_edit);
          }
        });
      });
    });
  </script>
@stop