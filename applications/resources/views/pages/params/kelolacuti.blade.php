@extends('layouts.master')

@section('title')
    <title>Kelola Intervensi</title>
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Intervensi
    <small>Kelola Intervensi</small>
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
            <h4 class="modal-title">Hapus Intervensi Pegawai</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus intervensi ini?</p>
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
      <form class="form-horizontal" action="{{route('cuti.update')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Intervensi Pegawai</h4>
          </div>
          <div class="modal-body">
            <!-- <div class="form-group ">
              <label class="col-sm-3 control-label">NIP</label>
              <div class="col-sm-9">
               <select name="id_pegawai" class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                  @foreach($getpegawai as $key)
                    <option value="{{$key->id}}" id="editpegawai{{$key->id}}">{{$key->nama}}</option>
                  @endforeach
                </select>
                </div>
            </div> -->
            <div class="form-group">
            <label class="col-md-3 control-label">NIP</label>
            <div class="col-md-9">
              <input name="nip" id="nip" class="form-control" readonly="true" value="{{ old('nip') }}" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Nama</label>
            <div class="col-md-9">
              <input name="nama" id="nama" class="form-control" readonly="true" value="{{ old('nama') }}">
            </div>
          </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Jenis Intervensi</label>
              <div class="col-sm-9">
              <select class="form-control" name="jenis_cuti_edit" id="jenis_cuti">
                <option>-- Pilih --</option>
                <option value="Ijin" id="flag_ijin">Ijin</option>
                <option value="Sakit" id="flag_sakit">Sakit</option>
                <option value="Cuti" id="flag_cuti">Cuti</option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal Awal</label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right datepicker1" id="tanggal_mulai_edit" type="text" name="tanggal_mulai_edit" placeholder="Tanggal Awal">
                </div>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal Akhir</label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right datepicker1" id="tanggal_akhir_edit" type="text" name="tanggal_akhir_edit" placeholder="Tanggal Akhir" onchange="durationDayEdit()">
                </div>
                </div>
            </div>
            <div class="form-group" hidden="true">
              <label class="col-sm-3 control-label">Jumlah Hari</label>
              <div class="col-sm-9">
              <input type="hidden" name="id" class="form-control" id="id">
              <input type="text" name="jumlah_hari_edit" class="form-control" readonly="true" placeholder="Jumlah Hari" id="jumlah_hari_edit">
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Keterangan</label>
              <div class="col-sm-9">
              <input type="text" name="deskripsi_edit" class="form-control" placeholder="Keterangan" id="deskripsi">
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Status</label>
              <div class="col-sm-9">
              <select class="form-control" name="flag_status_edit" id="flag_status">
                <option>-- Pilih --</option>
                <option value="0" id="flag_aktif">Aktif</option>
                <option value="1" id="flag_non_aktif">Tidak Aktif</option>
              </select>
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Berkas</label>
              <div class="col-sm-9">
              <input type="file" name="berkas" class="form-control">
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

  <div class="col-md-4">
      <!-- Horizontal Form -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Tambah Intervensi Pegawai</h3>
        </div>
        <form class="form-horizontal" action="{{route('cuti.store')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
        <div class="box-body">
            <div class="form-group ">
              <label class="col-sm-3 control-label">NIP</label>
              <div class="col-sm-9">
               <select name="id_pegawai" class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                  @foreach($getpegawai as $key)
                    <option value="{{$key->id}}">{{$key->nama}}</option>
                  @endforeach
                </select>
                @if($errors->has('id_pegawai'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('id_pegawai')}}
                    </strong>
                  </span>
                @endif
                </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Jenis Intervensi</label>
              <div class="col-sm-9">
              <select class="form-control" name="jenis_cuti" id="jenis_cuti">
                <option value="">-- Pilih --</option>
                <option value="Ijin" id="flag_ijin">Ijin</option>
                <option value="Sakit" id="flag_sakit">Sakit</option>
                <option value="Cuti" id="flag_cuti">Cuti</option>
              </select>
              @if($errors->has('jenis_cuti'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('jenis_cuti')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal Awal</label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right datepicker1" id="tanggal_mulai" type="text" name="tanggal_mulai" placeholder="Tanggal Awal">
                </div>
                @if($errors->has('tanggal_mulai'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('tanggal_mulai')}}
                    </strong>
                  </span>
                @endif
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal Akhir</label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right datepicker1" id="tanggal_akhir" type="text" name="tanggal_akhir" placeholder="Tanggal Akhir" onchange="durationDay()">
                </div>
                @if($errors->has('tanggal_akhir'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('tanggal_akhir')}}
                    </strong>
                  </span>
                @endif
                </div>
            </div>
            <div class="form-group" hidden="true">
              <label class="col-sm-3 control-label">Jumlah Hari</label>
              <div class="col-sm-9">
              <input type="hidden" name="id" class="form-control" id="id">
              <input type="text" name="jumlah_hari" class="form-control" readonly="true" placeholder="Jumlah Hari" id="jumlah_hari">
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Keterangan</label>
              <div class="col-sm-9">
              <input type="text" name="deskripsi" class="form-control" placeholder="Keterangan" id="deskripsi">
                @if($errors->has('deskripsi'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('deskripsi')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Status</label>
              <div class="col-sm-9">
              <select class="form-control" name="flag_status" id="flag_status">
                <option value="">-- Pilih --</option>
                <option value="0" id="flag_aktif">Aktif</option>
                <option value="1" id="flag_non_aktif">Tidak Aktif</option>
              </select>
                @if($errors->has('flag_status'))
                  <span class="help-block">
                    <strong style="color: red">{{ $errors->first('flag_status')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-3 control-label">Berkas</label>
              <div class="col-sm-9">
              <input type="file" name="berkas" class="form-control">
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

    <div class="col-md-8">
      <div class="box box-primary box-solid">
        <div class="box-header">
          <h3 class="box-title">Seluruh Intervensi Pegawai</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">
                      <th>No</th>
                      <th>Nip</th>
                      <th>Jenis Intervensi</th>
                      <th>Tanggal Awal - Tanggal Akhir</th>
                      <th>Jumlah Intervensi</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($getcuti)!=0)
                      @php
                        $pageget;
                        if($getcuti->currentPage()==1)
                          $pageget = 1;
                        else
                          $pageget = (($getcuti->currentPage() - 1) * $getcuti->perPage())+1;
                      @endphp
                      @foreach ($getcuti as $key)
                        <tr>
                          <td>
                            {{$pageget}}
                          </td>
                          <td>
                           {{$key->nama}}
                          </td>
                          <td>
                           {{$key->jenis_cuti}}
                          </td>
                          <td>
                            {{ \Carbon\Carbon::parse($key->tanggal_mulai)->format('d-M-y')}} - {{ \Carbon\Carbon::parse($key->tanggal_akhir)->format('d-M-y')}}
                          </td>
                          <td>
                           {{$key->jumlah_hari}}
                          </td>
                          <td>
                           {{$key->deskripsi}}
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
                {{-- <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Menampilkan 1 s/d {!! $getcuti->count() !!}  dari {!! count($getcuti) !!} Data</div> --}}
              </div>
              <div class="col-sm-7">
                <div class="pull-right">
                  {{ $getcuti->links() }}
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
  {{-- datepicker --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
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
          $('#sethapus').attr('href', "{{ url('/') }}/cuti/delete/"+a);
      });

      $('a.edit').click(function(){
        var a = $(this).data('value');
        $.ajax({
          url: "{{url('/')}}/cuti/bind-cuti/"+a,
          success: function(data){
            //get
            var id = data.id;
            var nip = data.nip;
            var nama = data.nama;
            var jenis_cuti = data.jenis_cuti;
            var tanggal_mulai_edit = data.tanggal_mulai;
            var tanggal_akhir_edit = data.tanggal_akhir;
            var jumlah_hari_edit = data.jumlah_hari;
            var deskripsi = data.deskripsi;
            var flag_status = data.flag_status;
            var id_pegawai = data.id_pegawai;
            //set
          
            $('#id').attr('value', id);
            $('#nip').attr('value', nip);
            $('#nama').attr('value', nama);
            $('#tanggal_mulai_edit').attr('value', tanggal_mulai_edit);
            $('#tanggal_akhir_edit').attr('value', tanggal_akhir_edit);
            $('#jumlah_hari_edit').attr('value', jumlah_hari_edit);
            $('#deskripsi').attr('value', deskripsi);
            // alert(id_pegawai);
            $('#editpegawai'+id_pegawai).attr('selected', true);

            if (jenis_cuti=="Ijin") {
              $('#flag_ijin').attr('selected', true);
            } else if (jenis_cuti=="Sakit") {
              $('#flag_sakit').attr('selected', true);
            } else if (jenis_cuti=="Cuti") {
              $('#flag_cuti').attr('selected', true);
            }

            if (flag_status=="0") {
              $('#flag_aktif').attr('selected', true);
            } else {
              $('#flag_non_aktif').attr('selected', true);
            }
          }
        });
      });
    });
  </script>
  <script type="text/javascript">
  function durationDay(){
    $(document).ready(function() {
      $('#tanggal_mulai, #tanggal_akhir').on('change textInput input', function () {
            if ( ($("#tanggal_mulai").val() != "") && ($("#tanggal_akhir").val() != "")) {
                var dDate1 = new Date($("#tanggal_mulai").val());
                var dDate2 = new Date($("#tanggal_akhir").val());
                var iWeeks, iDateDiff, iAdjust = 0;
                if (dDate2 < dDate1) return -1; // error code if dates transposed
                var iWeekday1 = dDate1.getDay(); // day of week
                var iWeekday2 = dDate2.getDay();
                iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
                iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
                if ((iWeekday1 > 5) && (iWeekday2 > 5)) iAdjust = 1; // adjustment if both days on weekend
                iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
                iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;

                // calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
                iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000)

                if (iWeekday1 <= iWeekday2) {
                  iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1)
                } else {
                  iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2)
                }

                iDateDiff -= iAdjust // take into account both days on weekend
                $("#jumlah_hari").val(iDateDiff+1);
                //return (iDateDiff + 1); // add 1 because dates are inclusive
            }
        });
    });
  }
</script>
<script type="text/javascript">
  function durationDayEdit(){
    $(document).ready(function() {
      $('#tanggal_mulai_edit, #tanggal_akhir_edit').on('change textInput input', function () {
            if ( ($("#tanggal_mulai_edit").val() != "") && ($("#tanggal_akhir_edit").val() != "")) {
                var dDate1 = new Date($("#tanggal_mulai_edit").val());
                var dDate2 = new Date($("#tanggal_akhir_edit").val());
                var iWeeks, iDateDiff, iAdjust = 0;
                if (dDate2 < dDate1) return -1; // error code if dates transposed
                var iWeekday1 = dDate1.getDay(); // day of week
                var iWeekday2 = dDate2.getDay();
                iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
                iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
                if ((iWeekday1 > 5) && (iWeekday2 > 5)) iAdjust = 1; // adjustment if both days on weekend
                iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
                iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;

                // calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
                iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000)

                if (iWeekday1 <= iWeekday2) {
                  iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1)
                } else {
                  iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2)
                }

                iDateDiff -= iAdjust // take into account both days on weekend
                $("#jumlah_hari_edit").val(iDateDiff+1);
                //return (iDateDiff + 1); // add 1 because dates are inclusive
            }
        });
    });
  }
</script>
<script type="text/javascript">
    $(document).ready(function(){
          $("#tanggal_mulai").datepicker({
              todayBtn:  1,
              autoclose: true,
          }).on('changeDate', function (selected) {
            $("#tanggal_akhir").prop('disabled', false);
            $("#tanggal_akhir").val("");
            $("#jumlah_hari").val("");
              var minDate = new Date(selected.date.valueOf());
              $("#tanggal_akhir").datepicker('setStartDate', minDate);
          });

          $("#tanggal_akhir").datepicker()
              .on('changeDate', function (selected) {
                  var minDate = new Date(selected.date.valueOf());
              //    $('.tgl_faktur_awal').datepicker('setEndDate', minDate);
              });
      });
</script>
<script type="text/javascript">
    $(document).ready(function(){
          $("#tanggal_mulai_edit").datepicker({
              todayBtn:  1,
              autoclose: true,
          }).on('changeDate', function (selected) {
            $("#tanggal_akhir_edit").prop('disabled', false);
            $("#tanggal_akhir_edit").val("");
            $("#jumlah_hari_edit").val("");
              var minDate = new Date(selected.date.valueOf());
              $("#tanggal_akhir_edit").datepicker('setStartDate', minDate);
          });

          $("#tanggal_akhir_edit").datepicker()
              .on('changeDate', function (selected) {
                  var minDate = new Date(selected.date.valueOf());
              //    $('.tgl_faktur_awal').datepicker('setEndDate', minDate);
              });
      });
</script>

@stop

