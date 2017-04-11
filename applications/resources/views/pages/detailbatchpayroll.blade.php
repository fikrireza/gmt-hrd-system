@extends('layouts.master')

@section('title')
  <title>Detail Batch Payroll</title>
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Detail Batch Payroll
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Detail Batch Payroll</li>
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


  <div class="modal modal-default fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width:700px;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Set Komponen Gaji</h4>
        </div>
          <div class="modal-body">
            <div class="col-sm-12" style="margin-bottom:10px;">
              <div class="form-group">
                <label class="col-sm-2 control-label">Komponen Gaji</label>
                <div class="col-sm-8">
                  <input type="hidden" name="name" id="idpegawaigaji">
                  <select class="form-control" id="idkomponengaji">
                    <option>-- Pilih --</option>
                    @foreach ($getkomponengaji as $key)
                      <option value="{{$key->id}}">
                        @if ($key->tipe_komponen=="D")
                          [Penerimaan]
                        @else
                          [Potongan]
                        @endif
                        - {{$key->nama_komponen}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-2"></div>
              </div>
            </div>
            <div class="col-sm-12" style="margin-bottom:40px;">
              <div class="form-group">
                <label class="col-sm-2 control-label">Nilai</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="nilaikomponengaji">
                </div>
                <div class="col-sm-2">
                  <button type="button" name="button" id="addkomponentopegawai" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <table class="table table-bordered" id="tabelkomponen">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Komponen Gaji</th>
                  <th>Tipe</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            {{-- <strong>Status:</strong> Berhasil memasukkan data. --}}
            {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-primary" id="set">Simpan Perubahan</button> --}}
          </div>
      </div>
    </div>
  </div>

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
      <div class="box box-primary box-solid">
        <div class="box-header">
          <h3 class="box-title">
            @php
              $date = explode("-", $getbatch->tanggal_proses);
              $date2 = explode("-", $getbatch->tanggal_proses_akhir);
            @endphp
            @if($getbatch->tanggal_proses == null)
              Seluruh Penerima Gaji Untuk Periode Per Tanggal {{$getbatch->tanggal}} &nbsp;&nbsp;|&nbsp;&nbsp; Tanggal Proses : tanggal proses awal kosong s/d {{$date2[2]}}-{{$date2[1]}}-{{$date2[0]}} 
            @elseif($getbatch->tanggal_proses_akhir == null)
              Seluruh Penerima Gaji Untuk Periode Per Tanggal {{$getbatch->tanggal}} &nbsp;&nbsp;|&nbsp;&nbsp; Tanggal Proses : {{$date[2]}}-{{$date[1]}}-{{$date[0]}} s/d tanggal proses akhir kosong 
            @else
              Seluruh Penerima Gaji Untuk Periode Per Tanggal {{$getbatch->tanggal}} &nbsp;&nbsp;|&nbsp;&nbsp; Tanggal Proses : {{$date[2]}}-{{$date[1]}}-{{$date[0]}} s/d {{$date2[2]}}-{{$date2[1]}}-{{$date2[0]}} 
            @endif
          </h3>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered" id="tabelpegawai">
            <thead>
              <tr>
                <th rowspan="2">NIP</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Jabatan</th>
                <th colspan="3">Absensi</th>
                <th rowspan="2">Penerimaan Tetap</th>
                <th rowspan="2">Penerimaan Variable</th>
                <th rowspan="2">Potongan Tetap</th>
                <th rowspan="2">Potongan Variable</th>
                <th rowspan="2">Total</th>
                <th rowspan="2">Aksi</th>
              </tr>
              <tr>
                <th>Hari Normal</th>
                <th>Absen</th>
                <th>Hari Kerja</th>
              </tr>
            </thead>
            <tbody>
              {{-- @foreach ($getdetailbatchpayroll as $key)
                <tr>
                  <td>{{$key->nip}}</td>
                  <td>{{$key->nama}}</td>
                  <td>{{$key->nama_jabatan}}</td>
                  <td>{{$key->workday}}</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="box box-primary box-solid">
        <div class="box-header">
          <h3 class="box-title"><strong>Summary</strong></h3>
          <hr style="margin-top:5px;margin-bottom:8px;">
          <ul>
            <li>Total Pegawai : 1200</li>
            <li>Total Penerimaan : Rp 2.333.489.894,00</li>
            <li>Total Potongan : Rp 2.489.894,00</li>
          </ul>
          <button type="button" name="button" class="btn btn-warning">Proses Payroll</button>
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


  <script type="text/javascript">
    $(function() {

        $('#tabelpegawai').DataTable();

        // yajra datatable
        // $('#tabelpegawai').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: '{!! route('batchpayroll.getdata', $idbatch) !!}',
        //     column: [
        //       {data: 'id', name: 'id'},
        //       {data: '0', name: 'nip'},
        //       {data: '1', name: 'nama'},
        //       {data: '2', name: 'nama_jabatan'},
        //       {data: '3', name: 'status'},
        //       {data: '4', name: 'komponen_gaji'},
        //       {data: '5', name: 'action', orderable: false, searchable: false}
        //     ]
        // });

        // bind to table komponen in modal
        $('#tabelpegawai').DataTable().on('click', 'a.addkomponen[data-value]', function () {
          var idpegawai = $(this).data('value');
          $('#idkomponengaji').prop('selectedIndex', 0);
          $('#nilaikomponengaji').val("");
          $('#nilaikomponengaji').attr('readonly', false);

          $.ajax({
            url: "{{url('/')}}/detail-batch-payroll/bind-to-table/{{$idbatch}}/"+idpegawai,
            dataType: 'json',
            success: function(data){
              $('#idpegawaigaji').val(idpegawai);
              $("#tabelkomponen").find("tr:gt(0)").remove();
              if (data.length==0) {
                $('#tabelkomponen tr:last').after(
                  "<tr>"+
                  "<td colspan='5' align='center'><span class='text-muted'>Data tidak tersedia.</span></td>"+
                  "</tr>"
                );
              } else {
                var no = 1;
                $.each(data, function(index, value){
                  if (data[index].tipe_komponen=="D") {
                    $('#tabelkomponen tr:last').after(
                      "<tr>"+
                      "<td>"+no+"</td>"+
                      "<td>"+data[index].nama_komponen+"</td>"+
                      "<td><span class='label bg-green'>Penerimaan</span></td>"+
                      "<td id='nilai-for-id-"+data[index].id+"'>"+data[index].nilai+"</td>"+
                      "<td><span data-toggle='tooltip' title='Hapus Komponen'> <a class='btn btn-xs btn-danger hapuskomponen' data-value="+data[index].id+"><i class='fa fa-close'></i></a></span>"+
                      "<span data-toggle='tooltip' title='Edit Nilai'> <a class='btn btn-xs btn-warning editkomponen' data-value="+data[index].id+" data-nilai="+data[index].nilai+"><i class='fa fa-edit'></i></a></span></td>"+
                      "</tr>"
                    );
                  } else {
                    $('#tabelkomponen tr:last').after(
                      "<tr>"+
                      "<td>"+no+"</td>"+
                      "<td>"+data[index].nama_komponen+"</td>"+
                      "<td><span class='label bg-red'>Potongan</span></td>"+
                      "<td id='nilai-for-id-"+data[index].id+"'>"+data[index].nilai+"</td>"+
                      "<td><span data-toggle='tooltip' title='Hapus Komponen'> <a class='btn btn-xs btn-danger hapuskomponen' data-value="+data[index].id+"><i class='fa fa-close'></i></a></span>"+
                      "<span data-toggle='tooltip' title='Edit Nilai'> <a class='btn btn-xs btn-warning editkomponen' data-value="+data[index].id+" data-nilai="+data[index].nilai+"><i class='fa fa-edit'></i></a></span></td>"+
                      "</tr>"
                    );
                  }
                  no++;
                })
              }
            }
          });
        });

        $('body').on('click', 'a.editkomponen[data-value]', function (){
          var id = $(this).data('value');
          var nilai = $(this).data('nilai');
          $('#nilai-for-id-'+id).html("<div class='input-group input-group-sm'>"+
                                      "<input type='text' class='form-control' value='"+nilai+"' id='inputnilai"+id+"'>"+
                                      "<span class='input-group-btn'>"+
                                      "<a class='btn btn-xs btn-info btn-flat editnilai"+id+"' href='#' data-value='"+id+"'><i class='fa fa-check'></i></a>"+
                                      "</span>"+
                                      "</div>");

          $('a.editnilai'+id).click(function(){
            var _id = $(this).data('value');
            var _inputnilai = $('#inputnilai'+id).val();
            $.ajax({
              url: "{{url('/')}}/komponen-gaji/update-nilai/"+_id+"/"+_inputnilai,
              success: function(data){
                $('#nilai-for-id-'+id).html(_inputnilai);
              }
            })
          });
        });



        // save to database
        $('#addkomponentopegawai').click(function(){
          var idkomponen = $('#idkomponengaji').val();
          var nilai = $('#nilaikomponengaji').val();
          var idpegawai = $('#idpegawaigaji').val();

          $.ajax({
            url: "{{url('/')}}/detail-batch-payroll/add-to-komponen/{{$idbatch}}/"+idpegawai+"/"+idkomponen+"/"+nilai,
            dataType: 'json',
            success: function(data){
              $('#nilaikomponengaji').val("");
              $('#idkomponengaji').prop('selectedIndex', 0);
              $("#tabelkomponen").find("tr:gt(0)").remove();
              if (data.length==0) {
                $('#tabelkomponen tr:last').after(
                  "<tr>"+
                  "<td colspan='5' align='center'><span class='text-muted'>Data tidak tersedia.</span></td>"+
                  "</tr>"
                );
              } else {
                var no = 1;
                $.each(data, function(index, value){
                  if (data[index].tipe_komponen=="D") {
                    $('#tabelkomponen tr:last').after(
                      "<tr>"+
                      "<td>"+no+"</td>"+
                      "<td>"+data[index].nama_komponen+"</td>"+
                      "<td><span class='label bg-green'>Penerimaan</span></td>"+
                      "<td>"+data[index].nilai+"</td>"+
                      "<td><span data-toggle='tooltip' title='Hapus Komponen'> <a class='btn btn-xs btn-danger hapuskomponen' data-value="+data[index].id+"><i class='fa fa-close'></i></a></span></td>"+
                      "</tr>"
                    );
                  } else {
                    $('#tabelkomponen tr:last').after(
                      "<tr>"+
                      "<td>"+no+"</td>"+
                      "<td>"+data[index].nama_komponen+"</td>"+
                      "<td><span class='label bg-red'>Potongan</span></td>"+
                      "<td>"+data[index].nilai+"</td>"+
                      "<td><span data-toggle='tooltip' title='Hapus Komponen'> <a class='btn btn-xs btn-danger hapuskomponen' data-value="+data[index].id+"><i class='fa fa-close'></i></a></span></td>"+
                      "</tr>"
                    );
                  }
                  no++;
                })
              }

              // update status komponen gaji
              $.ajax({
                url: "{{url('/')}}/detail-batch-payroll/cek-komponen-gaji/{{$idbatch}}/"+idpegawai,
                dataType: 'json',
                success: function(datax){
                  if (datax.length!=0) {
                    $("#statuskomponen"+idpegawai).attr('class', 'badge bg-green');
                    $("#statuskomponen"+idpegawai).html('Sudah Di Set');
                  }  else {
                    $("#statuskomponen"+idpegawai).attr('class', 'badge bg-red');
                    $("#statuskomponen"+idpegawai).html('Belum Di Set');
                  }
                }
              });
            }
          });
        });

        // automatically set value from gaji pokok pegawai
        $('#idkomponengaji').change(function(){
          var a = $(this).val();
          var idpegawai = $('#idpegawaigaji').val();

          // gaji pokok id in database is 1
          if (a==1) {
            $.ajax({
              url: "{{url('/')}}/detail-batch-payroll/get-gapok/"+idpegawai,
              dataType: 'json',
              success: function(data){
                if (data!=0) {
                  $('#nilaikomponengaji').val(data);
                  $('#nilaikomponengaji').attr('readonly', true);
                } else {
                  $('#nilaikomponengaji').val("");
                  $('#nilaikomponengaji').attr('readonly', false);
                }
              }
            });
          } else {
            $('#nilaikomponengaji').val("");
            $('#nilaikomponengaji').attr('readonly', false);
          }
        });

        $('body').on('click', 'a.hapuskomponen[data-value]', function (){
            var idpegawai = $('#idpegawaigaji').val();
            var a = $(this).data('value');
            $.ajax({
              url: "{{url('/')}}/detail-batch-payroll/delete-komponen-gaji/"+a,
              dataType: 'json',
              success: function(data){
                $.ajax({
                  url: "{{url('/')}}/detail-batch-payroll/bind-to-table/{{$idbatch}}/"+idpegawai,
                  dataType: 'json',
                  success: function(data){
                    $('#idpegawaigaji').val(idpegawai);
                    $("#tabelkomponen").find("tr:gt(0)").remove();
                    if (data.length==0) {
                      $('#tabelkomponen tr:last').after(
                        "<tr>"+
                        "<td colspan='5' align='center'><span class='text-muted'>Data tidak tersedia.</span></td>"+
                        "</tr>"
                      );
                    } else {
                      var no = 1;
                      $.each(data, function(index, value){
                        if (data[index].tipe_komponen=="D") {
                          $('#tabelkomponen tr:last').after(
                            "<tr>"+
                            "<td>"+no+"</td>"+
                            "<td>"+data[index].nama_komponen+"</td>"+
                            "<td><span class='label bg-green'>Penerimaan</span></td>"+
                            "<td id='nilai-for-id-"+data[index].id+"'>"+data[index].nilai+"</td>"+
                            "<td><span data-toggle='tooltip' title='Hapus Komponen'> <a class='btn btn-xs btn-danger hapuskomponen' data-value="+data[index].id+"><i class='fa fa-close'></i></a></span>"+
                            "<span data-toggle='tooltip' title='Edit Nilai'> <a class='btn btn-xs btn-warning editkomponen' data-value="+data[index].id+" data-nilai="+data[index].nilai+"><i class='fa fa-edit'></i></a></span></td>"+
                            "</tr>"
                          );
                        } else {
                          $('#tabelkomponen tr:last').after(
                            "<tr>"+
                            "<td>"+no+"</td>"+
                            "<td>"+data[index].nama_komponen+"</td>"+
                            "<td><span class='label bg-red'>Potongan</span></td>"+
                            "<td id='nilai-for-id-"+data[index].id+"'>"+data[index].nilai+"</td>"+
                            "<td><span data-toggle='tooltip' title='Hapus Komponen'> <a class='btn btn-xs btn-danger hapuskomponen' data-value="+data[index].id+"><i class='fa fa-close'></i></a></span>"+
                            "<span data-toggle='tooltip' title='Edit Nilai'> <a class='btn btn-xs btn-warning editkomponen' data-value="+data[index].id+" data-nilai="+data[index].nilai+"><i class='fa fa-edit'></i></a></span></td>"+
                            "</tr>"
                          );
                        }
                        no++;
                      })
                    }

                    // update status komponen gaji
                    $.ajax({
                      url: "{{url('/')}}/detail-batch-payroll/cek-komponen-gaji/{{$idbatch}}/"+idpegawai,
                      dataType: 'json',
                      success: function(datax){
                        if (datax.length!=0) {
                          $("#statuskomponen"+idpegawai).attr('class', 'badge bg-green');
                          $("#statuskomponen"+idpegawai).html('Sudah Di Set');
                        } else {
                          $("#statuskomponen"+idpegawai).attr('class', 'badge bg-red');
                          $("#statuskomponen"+idpegawai).html('Belum Di Set');
                        }
                      }
                    });
                  }
                });
              }
            });
        });
      });
  </script>

@stop
