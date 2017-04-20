@extends('layouts.master')

@section('title')
    <title>Kelola Komponen Gaji Tetap</title>
@stop

@section('breadcrumb')
  <h1>
    Komponen Gaji Tetap
    <small>Kelola Komponen Gaji Tetap</small>
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
            <h4 class="modal-title">Hapus Komponen Gaji Tetap</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus komponen gaji ini?</p>
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
      <form class="form-horizontal" action="{{route('komgajitetap.update')}}" method="post">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Komponen Gaji Tetap</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-3 control-label">Client</label>
              <div class="col-sm-9">
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
              <label class="col-sm-3 control-label">Nama Komponen</label>
              <div class="col-sm-9">
              <input type="hidden" name="id" class="form-control" id="id">
              <input type="text" name="nama_komponen_edit" class="form-control" placeholder="Nama Komponen" id="nama_komponen_edit">
                @if($errors->has('nama_komponen_edit'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('nama_komponen_edit')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tipe Komponen</label>
              <div class="col-sm-9">
              <select class="form-control" name="tipe_komponen_edit" id="tipe_komponen_edit">
                <option value="">-- Pilih --</option>
                <option value="D" id="flag_penerimaan_edit">Penerimaan</option>
                <option value="P" id="flag_potongan_edit">Potongan</option>
              </select>
                @if($errors->has('tipe_komponen_edit'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('tipe_komponen_edit')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
             <div class="form-group ">
              <label class="col-sm-3 control-label">Periode Perhitungan</label>
              <div class="col-sm-9">
              <select class="form-control" name="periode_perhitungan_edit" id="periode_perhitungan_edit">
                <option value="">-- Pilih --</option>
                <option value="Bulanan" id="flag_bulanan_edit">Bulanan</option>
                <option value="Harian" id="flag_harian_edit">Harian</option>
                <option value="Jam" id="flag_jam_edit">Jam</option>
                <option value="Shift" id="flag_shift_edit">Shift</option>
              </select>
               @if($errors->has('periode_perhitungan_edit'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('periode_perhitungan_edit')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Nilai</label>
              <div class="col-sm-9">
              <input type="text" name="komgaj_tetap_dibayarkan_edit" class="form-control" id="komgaj_tetap_dibayarkan_edit" placeholder="Nilai" id="komgaj_tetap_dibayarkan" onkeypress="return isNumber(event)">
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
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
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
      <!-- Horizontal Form -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Tambah Komponen Gaji Tetap</h3>
        </div>
        <form class="form-horizontal" action="{{route('komgajitetap.store')}}" method="post">
          {{csrf_field()}}
        <div class="box-body">
          <div class="form-group">
              <label class="col-sm-3 control-label">Client</label>
              <div class="col-sm-9">
                <select name="id_cabang_client" class="form-control select2" style="width: 100%;">
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
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama Komponen</label>
              <div class="col-sm-9">
              <input type="text" name="nama_komponen" class="form-control" value="{{ old('nama_komponen') }}" placeholder="Nama Komponen">
                @if($errors->has('nama_komponen'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('nama_komponen')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tipe Perhitungan</label>
              <div class="col-sm-9">
              <select class="form-control" name="tipe_komponen">
                <option value="">-- Pilih --</option>
                <option value="D">Penerimaan</option>
                <option value="P">Potongan</option>
              </select>
                @if($errors->has('tipe_komponen'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('tipe_komponen')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Periode Perhitungan</label>
              <div class="col-sm-9">
              <select class="form-control" name="periode_perhitungan">
                <option value="">-- Pilih --</option>
                <option value="Bulanan">Bulanan</option>
                <option value="Harian">Harian</option>
                <option value="Jam">Jam</option>
                <option value="Shift">Shift</option>
              </select>
              @if($errors->has('periode_perhitungan'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('periode_perhitungan')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Nilai</label>
              <div class="col-sm-9">
              <input type="text" name="komgaj_tetap_dibayarkan" class="form-control" placeholder="Nilai" id="komgaj_tetap_dibayarkan" onkeypress="return isNumber(event)">
               @if($errors->has('komgaj_tetap_dibayarkan'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('komgaj_tetap_dibayarkan')}}
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
          <h3 class="box-title">Seluruh Komponen Gaji Tetap</h3>
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
                      <th>Nama</th>
                      <th>Tipe</th>
                      <th>Periode</th>
                      <th>Nilai</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($getkomponentetap)!=0)
                      @php
                        $pageget;
                        if($getkomponentetap->currentPage()==1)
                          $pageget = 1;
                        else
                          $pageget = (($getkomponentetap->currentPage() - 1) * $getkomponentetap->perPage())+1;
                      @endphp
                      @foreach ($getkomponentetap as $key)
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
                            Rp. {{ number_format($key->komgaj_tetap_dibayarkan,0,',','.') }},-
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
                {{-- <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Menampilkan 1 s/d {!! $getkomponentetap->count() !!}  dari {!! count($getkomponentetap) !!} Data</div> --}}
              </div>
              <div class="col-sm-7">
                <div class="pull-right">
                  {{ $getkomponentetap->links() }}
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
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

  <script type="text/javascript">
    $('#myModalEdit').on('hidden.bs.modal', function () {
     location.reload();
    });

    $('#myModal').on('hidden.bs.modal', function () {
     location.reload();
    });
  </script>
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
    $(function(){
       $('a.hapus').click(function(){
        var a = $(this).data('value');
          $('#sethapus').attr('href', "{{ url('/') }}/komponen-gaji-tetap/delete/"+a);
      });

      $('a.edit').click(function(){
        var a = $(this).data('value');
        $.ajax({
          url: "{{url('/')}}/komponen-gaji-tetap/bind-gaji-tetap/"+a,
          success: function(data){
            //get
            var id = data.id;
            var nama_komponen_edit = data.nama_komponen;
            var tipe_komponen_edit = data.tipe_komponen;
            var periode_perhitungan_edit = data.periode_perhitungan;
            var keterangan_edit = data.  keterangan;
            var komgaj_tetap_dibayarkan_edit = data.komgaj_tetap_dibayarkan;
            var id_cabang_client_edit = data. id_cabang_client;

            //set
            $('#id').attr('value', id);
            $('#nama_komponen_edit').attr('value', nama_komponen_edit);

            $('option').attr('selected', false);
            $('option#cel'+id_cabang_client_edit).attr('selected', true);
            $(".select2").select2();

            if (tipe_komponen_edit=="D") {
              $('#flag_penerimaan_edit').attr('selected', true);
            } else {
              $('#flag_potongan_edit').attr('selected', true);
            }

            if (periode_perhitungan_edit=="Bulanan") {
              $('#flag_bulanan_edit').attr('selected', true);
            } else if (periode_perhitungan_edit=="Harian") {
              $('#flag_harian_edit').attr('selected', true);
            } else if (periode_perhitungan_edit=="Jam") {
              $('#flag_jam_edit').attr('selected', true);
            } else if (periode_perhitungan_edit=="Shift") {
              $('#flag_shift_edit').attr('selected', true);
            }

            $('#keterangan_edit').attr('value', keterangan_edit);
            $('#komgaj_tetap_dibayarkan_edit').attr('value', komgaj_tetap_dibayarkan_edit);
          }
        });
      });
    });
  </script>
@stop
