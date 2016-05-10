<!-- GET CONTENT LAYOUT -->
@extends('layouts.master')

<!-- START CONDITION SECTION TITLE-->
@section('title')
  @if(isset($data['bindbahasaasing']))
    <title>Edit Data Pelengkap Pegawai</title>
  @else
    <title>Tambah Data Pelengkap Pegawai</title>
  @endif
  <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
  <style>
      .uppercase {
    text-transform: uppercase;
    }
    .lowercase {
    text-transform: lowercase;
    }
    .capitalize {
    text-transform: capitalize;
    }
  </style>
@stop
<!-- END CONDITION SECTION TITLE-->

@section('breadcrumb')
  <h1>
      Master Data Pelengkap Pegawai <small>Kelola Data Pelengkap Pegawai</small>
  </h1>
  <ol class="breadcrumb">
    <li>
        <a href="#"><i class="fa fa-dashboard"></i>Home</a>
    </li>
    <li class="active">Dashboard</li>
  </ol>
@stop

@section('content')


<!-- START DURATION TIME ALERT -->
<script>
  window.setTimeout(function() {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
  }, 2000);
</script>
<!-- END DURATION TIME ALERT -->

<!-- START MESSAGE -->
<div class="col-md-12">
  @if(Session::has('message'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
      <p>{{ Session::get('message') }}</p>
    </div>
  @endif
</div>
<!-- END MESSAGE -->

  <div class="row">
    <!-- START FORM-->
    <form class="form-horizontal" method="post" action="{{route('masterpelengkappegawai.store')}}">
      {!! csrf_field() !!}
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Data Pegawai</h3>
            </div>
            {{-- START DATA PEGAWAI --}}
            <div class="box-body">
              <div class="col-md-6 {{ $errors->has('id_pegawai') ? 'has-error' : '' }}">
                <label class="control-label">NIP</label>
                <select class="form-control" name="id_pegawai" id="id_pegawai" onchange="onChangeNIP()">
                <option></option>
                @foreach($data['getpegawai'] as $key)
                    <option value="{{ $key->id }}">{{  $key->nip}} - {{$key->nama}}</option>
                @endforeach
                </select>
                @if($errors->has('id_pegawai'))
                  <span class="help-block">
                    <strong>{{ $errors->first('id_pegawai')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>
              <h3 class="box-title">Deskrispi Pegawai</h3>
            </div>
            {{-- END DATA PEGAWAI --}}

            {{-- START GET DATA PEGAWAI --}}
            <div class="box-body">
              <div class="col-md-5">
                <dl class="dl-horizontal">
                  <dt>NIP Lama : </dt>
                    <dd></dd>
                  <br/>
                  <dt>Nomor KTP : </dt>
                    <dd id="noktp"></dd>
                  <br/>
                  <dt>Nomor KK : </dt>
                    <dd id="nokk"></dd>
                  <br/>
                  <dt>Nomor NPWP : </dt>
                  <dd id="npwp"></dd>
                  <br/>
                  <dt>Tanggal Lahir : </dt>
                    <dd id="tanggallahir"></dd>
                  <br/>
                  <dt>Jenis Kelamin : </dt>
                    <dd id="jeniskelamin"></dd>
                  <br/>
                  <dt>Email : </dt>
                    <dd id="email"></dd>
                  <br/>
                </dl>
              </div>
              <div class="col-md-7">
                <dl class="dl-horizontal">
                  <dt>Alamat : </dt>
                    <dd id="alamat"></dd>
                  <br/>
                  <dt>Agama : </dt>
                    <dd id="agama"></dd>
                  <br/>
                  <dt>No Telepon : </dt>
                    <dd id="notelepon"></dd>
                  <br/>
                  <dt>Status Pajak : </dt>
                    <dd id="statuspajak"></dd>
                  <br/>
                  <dt>Kewarganegaraan : </dt>
                  <dd id="kewarganegaraan"></dd>
                  <br/>
                  <dt>Nomor BPJS : </dt>
                    <dd id="bpjs"></dd>
                  <br/>
                  <dt>Nomor Rekening : </dt>
                    <dd id="norekening"></dd>
                  <br/>
                </dl>
              </div>
            </div>
          </div>
        </div>
        {{-- END GET DATA PEGAWAI --}}

      {{-- START TAB --}}
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Data Keluarga</a></li>
            <li><a href="#tab_2" data-toggle="tab">Kondisi Kesehatan</a></li>
            <li><a href="#tab_3" data-toggle="tab">Pendidikan</a></li>
            <li><a href="#tab_4" data-toggle="tab">Bahasa Asing</a></li>
            <li><a href="#tab_5" data-toggle="tab">Keahlian Komputer</a></li>
            <li><a href="#tab_6" data-toggle="tab">Riwayat Penyakit</a></li>
            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
          </ul>
          {{-- START TAB 1 --}}
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="box-body">
                <div class="col-md-8 {{ $errors->has('nama') ? 'has-error' : '' }}">
                  <label class="control-label">Nama Keluarga</label>
                  <input type="text" name="namakeluarga" class="form-control uppercase" placeholder="Nama Keluarga">
                  @if($errors->has('nama'))
                    <span class="help-block">
                      <strong>{{ $errors->first('nama')}}
                      </strong>
                    </span>
                  @endif
                </div>
                <div class="col-md-8 {{ $errors->has('hubungan') ? 'has-error' : '' }}">
                  <label class="control-label">Hubungan</label>
                  <select class="form-control" name="hubungan">
                    <option value=""></option>
                    <option value="KAKAK">KAKAK KANDUNG</option>
                    <option value="ADIK">ADIK KANDUNG</option>
                    <option value="IBU">IBU KANDUNG</option>
                    <option value="AYAH">AYAH KANDUNG</option>
                    <option value="LAINNYA">LAINNYA</option>
                  </select>
                  @if($errors->has('hubungan'))
                    <span class="help-block">
                      <strong>{{ $errors->first('hubungan')}}
                      </strong>
                    </span>
                  @endif
                </div>
                <div class="col-md-8 {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                  <label class="control-label">Tanggal Lahir</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="tanggal_lahir" name="tanggal_lahir" data-date-format="dd-mm-yyyy"
                    >
                  </div>
                </div>
                <div class="col-md-8 {{ $errors->has('perkerjaan') ? 'has-error' : '' }}">
                  <label class="control-label">Perkerjaan</label>
                  <select class="form-control" name="pekerjaan">
                    <option value=""></option>
                    <option value="PEGAWAINEGERI">PEGAWAI NEGEARI</option>
                    <option value="PEGAWAISWASTA">PEGAWAI SWASTA</option>
                    <option value="FREELANCE">FREELANCE</option>
                    <option value="LAINNYA">LAINNYA</option>
                  </select>
                  @if($errors->has('perkerjaan'))
                    <span class="help-block">
                      <strong>{{ $errors->first('perkerjaan')}}
                      </strong>
                    </span>
                  @endif
                </div>
                <div class="col-md-8 {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                  <label class="control-label">Jenis Kelamin</label>
                  <div class="form-group">
                    &nbsp;&nbsp;&nbsp;
                    <label>
                      <input type="radio" name="jk" class="minimal" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                    </label>
                    &nbsp;
                    <label>Pria</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                      <input type="radio" name="jk" class="minimal" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                    </label>
                    &nbsp;
                    <label>Wanita</label>
                  </div>
                  @if($errors->has('jenis_kelamin'))
                    <span class="help-block">
                      <strong>{{ $errors->first('jenis_kelamin')}}
                      </strong>
                    </span>
                  @endif
                </div>
                <div class="col-md-8 {{ $errors->has('alamat') ? 'has-error' : '' }}">
                  <label class="control-label">Alamat</label>
                  <textarea type="text" name="alamat" class="form-control  uppercase" placeholder="Alamat" rows="5" cols="40"></textarea>
                  @if($errors->has('alamat'))
                    <span class="help-block">
                      <strong>{{ $errors->first('alamat')}}
                      </strong>
                    </span>
                  @endif
                </div>
            </div>
          </div>
          {{-- END TAB 1 --}}
          {{-- START TAB 2 --}}
          <div class="tab-pane" id="tab_2">
            <div class="box-body">
              <div class="col-md-8 {{ $errors->has('tinggi_badan') ? 'has-error' : '' }}">
              <label class="control-label">Tinggi Badan</label>
              <input type="text" name="tinggibadan" class="form-control" placeholder="Tinggi Badan" maxlength="4" onkeyup="validAngka(this)">
              @if($errors->has('tinggi_badan'))
                <span class="help-block">
                  <strong>{{ $errors->first('tinggi_badan')}}
                  </strong>
                </span>
              @endif
            </div>
            <div class="col-md-8 {{ $errors->has('berat_badan') ? 'has-error' : '' }}">
              <label class="control-label">Berat Badan</label>
              <input type="text" name="beratbadan" class="form-control" placeholder="Berat Badan" maxlength="4" onkeyup="validAngka(this)">
              @if($errors->has('berat_badan'))
                <span class="help-block">
                  <strong>{{ $errors->first('berat_badan')}}
                  </strong>
                </span>
              @endif
            </div>
            <div class="col-md-8 {{ $errors->has('warna_rambut') ? 'has-error' : '' }}">
              <label class="control-label">Warna Rambut</label>
              <input type="text" name="warnarambut" class="form-control  uppercase" placeholder="Warna Rambut" maxlength="10">
              @if($errors->has('warna_rambut'))
                <span class="help-block">
                  <strong>{{ $errors->first('warna_rambut')}}
                  </strong>
                </span>
              @endif
            </div>
            <div class="col-md-8 {{ $errors->has('warna_mata') ? 'has-error' : '' }}">
              <label class="control-label">Warna Mata</label>
              <input type="text" name="warnamata" class="form-control" placeholder="Warna Mata uppercase"  maxlength="10">
              @if($errors->has('warna_mata'))
                <span class="help-block">
                  <strong>{{ $errors->first('warna_mata')}}
                  </strong>
                </span>
              @endif
            </div>
            <div class="col-md-8 {{ $errors->has('berkacamata') ? 'has-error' : '' }}">
              <label class="control-label">berkacamata</label>
              <div class="form-group">
                &nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="kacamata" class="minimal" value="Ya" {{ old('berkacamata') == 'L' ? 'checked' : '' }}>
                </label>
                &nbsp;
                <label>Ya</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="kacamata" class="minimal" value="Tidak" {{ old('berkacamata') == 'P' ? 'checked' : '' }}>
                </label>
                &nbsp;
                <label>Tidak</label>
              </div>
              @if($errors->has('berkacamata'))
                <span class="help-block">
                  <strong>{{ $errors->first('berkacamata')}}
                  </strong>
                </span>
              @endif
            </div>
            <div class="col-md-8 {{ $errors->has('merokok') ? 'has-error' : '' }}">
              <label class="control-label">Merokok</label>
              <div class="form-group">
                &nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="merokok" class="minimal" value="Ya" {{ old('merokok') == 'L' ? 'checked' : '' }}>
                </label>
                &nbsp;
                <label>Ya</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="merokok" class="minimal" value="Tidak" {{ old('merokok') == 'P' ? 'checked' : '' }}>
                </label>
                &nbsp;
                <label>Tidak</label>
              </div>
              @if($errors->has('berkacamata'))
                <span class="help-block">
                  <strong>{{ $errors->first('berkacamata')}}
                  </strong>
                </span>
              @endif
            </div>
            </div>
          </div>
          {{-- END TAB 2 --}}
          {{-- START TAB 3 --}}
          <div class="tab-pane" id="tab_3">
            <div class="box-body">
              <div class="col-md-8 {{ $errors->has('jenjang_pendidikan') ? 'has-error' : '' }}">
                <label class="control-label">Jenjang Pendidikan</label>
                <select class="form-control" name="jenjangpendidikan">
                  <option value=""></option>
                  <option value="PELATIHANKEAHLIAN">PELATIHAN KEAHLIAN</option>
                  <option value="S2">S2 Magister</option>
                  <option value="S1">S1 Universitas</option>
                  <option value="D3">D3 Akademik</option>
                  <option value="SMU">SMU</option>
                  <option value="SMP">SMP</option>
                  <option value="SD">SD</option>
                  <option value="LAINNYA">LAINNYA</option>
                </select>
                @if($errors->has('jenjang_pendidikan'))
                  <span class="help-block">
                    <strong>{{ $errors->first('jenjang_pendidikan')}}
                    </strong>
                  </span>
                @endif
              </div>
              <div class="col-md-8 {{ $errors->has('institusi_pendidikan') ? 'has-error' : '' }}">
              <label class="control-label">Institusi Pendidikan</label>
              <input type="text" name="institusipendidikan" class="form-control uppercase" placeholder="Institusi Pendidikan">
              @if($errors->has('institusi_pendidikan'))
                <span class="help-block">
                  <strong>{{ $errors->first('institusi_pendidikan')}}
                  </strong>
                </span>
              @endif
            </div>
            <div class="col-md-8 {{ $errors->has('tahun_masuk') ? 'has-error' : '' }}">
              <label class="control-label">Tahun Masuk</label>
              <input type="text" name="tahunmasuk" class="form-control" placeholder="Tahun Masuk" maxlength="4" onkeyup="validAngka(this)">
              @if($errors->has('tahun_masuk'))
                <span class="help-block">
                  <strong>{{ $errors->first('tahun_masuk')}}
                  </strong>
                </span>
              @endif
            </div>
            <div class="col-md-8 {{ $errors->has('tahun_lulus') ? 'has-error' : '' }}">
              <label class="control-label">Tahun Lulus</label>
              <input type="text" name="tahunlulus" class="form-control" placeholder="Tahun Lulus" maxlength="4" onkeyup="validAngka(this)">
              @if($errors->has('tahun_lulus'))
                <span class="help-block">
                  <strong>{{ $errors->first('tahun_lulus')}}
                  </strong>
                </span>
              @endif
            </div>
            <div class="col-md-8 {{ $errors->has('gelar_akademik') ? 'has-error' : '' }}">
              <label class="control-label">Gelar Kelulusan</label>
              <input type="text" name="gelarakademik" class="form-control" placeholder="Gelar Kelulusan" maxlength="10">
              @if($errors->has('gelar_akademik'))
                <span class="help-block">
                  <strong>{{ $errors->first('gelar_akademik')}}
                  </strong>
                </span>
              @endif
            </div>
            </div>
          </div>
          {{-- END TAB 3 --}}
          {{-- START TAB 4 --}}
          <div class="tab-pane" id="tab_4">
            <div class="box-body">
              <div class="col-md-8 {{ $errors->has('bahasa') ? 'has-error' : '' }}">
                <label class="control-label">Bahasa</label>
                <input type="text" name="bahasa" class="form-control uppercase" placeholder="Bahasa"
                @if(isset($data['bindbahasaasing']))
                  value="{{  $data['bindbahasaasing']->bahasa }}" readonly="true"
                @endif
                >
                @if($errors->has('bahasa'))
                  <span class="help-block">
                    <strong>{{ $errors->first('bahasa')}}
                    </strong>
                  </span>
                @endif
              </div>
              <div class="col-md-8 {{ $errors->has('berbicara') ? 'has-error' : '' }}">
                <label class="control-label">Berbicara</label>
                <select class="form-control" name="berbicara">
                  <option value=""></option>
                  <option value="1" {{ old('berbicara') == '1' ? 'selected="selected"' : '' }}>BAIK</option>
                  <option value="2" {{ old('berbicara') == '2' ? 'selected="selected"' : '' }}>CUKUP</option>
                  <option value="3" {{ old('berbicara') == '3' ? 'selected="selected"' : '' }}>KURANG</option>
                </select>
                @if($errors->has('berbicara'))
                  <span class="help-block">
                    <strong>{{ $errors->first('berbicara')}}
                    </strong>
                  </span>
                @endif
              </div>
              <div class="col-md-8 {{ $errors->has('menulis') ? 'has-error' : '' }}">
                <label class="control-label">Menulis</label>
                <select class="form-control" name="menulis">
                  <option value=""></option>
                  <option value="1" {{ old('menulis') == 'Baik' ? 'selected="selected"' : '' }}>BAIK</option>
                  <option value="2" {{ old('menulis') == 'Cukup' ? 'selected="selected"' : '' }}>CUKUP</option>
                  <option value="3" {{ old('menulis') == 'Kurang' ? 'selected="selected"' : '' }}>KURANG</option>
                </select>
                @if($errors->has('menulis'))
                  <span class="help-block">
                    <strong>{{ $errors->first('menulis')}}
                    </strong>
                  </span>
                @endif
              </div>
              <div class="col-md-8 {{ $errors->has('mengerti') ? 'has-error' : '' }}">
                <label class="control-label">Mengerti</label>
                <select class="form-control" name="mengerti">
                  <option value=""></option>
                  <option value="1" {{ old('mengerti') == 'Baik' ? 'selected="selected"' : '' }}>BAIK</option>
                  <option value="2" {{ old('mengerti') == 'Cukup' ? 'selected="selected"' : '' }}>CUKUP</option>
                  <option value="3" {{ old('mengerti') == 'Kurang' ? 'selected="selected"' : '' }}>KURANG</option>
                </select>
                @if($errors->has('mengerti'))
                  <span class="help-block">
                    <strong>{{ $errors->first('mengerti')}}
                    </strong>
                  </span>
                @endif
              </div>
            </div>
          </div>
          {{-- END TAB 4 --}}
          {{-- START TAB 5 --}}
          <div class="tab-pane" id="tab_5">
            <div class="box-body">
              <div class="col-md-8 {{ $errors->has('bahasa') ? 'has-error' : '' }}">
                <label class="control-label">BELUM TAU CUUUY TAB 5</label>
              </div>
            </div>
          </div>
          {{-- START TAB 5 --}}
          {{-- START TAB 6 --}}
          <div class="tab-pane" id="tab_6">
            <div class="box-body">
              <div class="col-md-8 {{ $errors->has('bahasa') ? 'has-error' : '' }}">
                <label class="control-label">BELUM TAU CUUUY TAB 6</label>
              </div>
            </div>
          </div>
          {{-- START TAB 6 --}}
        </div>
        {{-- START BUTTON BOTTOM --}}
        <div class="box-footer">
          <button type="reset" class="btn btn-danger pull-left">Reset Formulir</button>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>
        {{-- END BUTTON BOTTOM --}}
      </div>
    </div>
    {{-- START TAB --}}

</form>
<!-- END FORM-->
</div>
<!-- END FORM -->

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

  <!-- iCheck -->
  <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>

  <!-- date time -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>

  <script type="text/javascript">
    $(function(){
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      });

      $('#tanggal_lahir').datepicker();
    });
  </script>
  <script type="text/javascript">
  function onChangeNIP() {
      var getId = document.getElementById("id_pegawai");
      var getVal = getId.options[getId.selectedIndex].value;
      $key = getVal;
      alert($key);
      location.href = "{{route('masterpelengkappegawai.show', $key)}}";
  }
  </script>
  <script type="text/javascript">
    function validAngka(evt)
    {
    	if(!/^[0-9.]+$/.test(evt.value))
    	{
    	evt.value = evt.value.substring(0,evt.value.length-1000);
    	}
    }
  </script>
@stop
