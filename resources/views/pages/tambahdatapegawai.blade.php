@extends('layouts.master')

@section('title')
  <title>Tambah Data Pegawai</title>
  <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Formulir Tambah Pegawai
    <small>Silahkan isi informasi di bawah ini.</small>
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

    <form class="form-horizontal" method="post" action="{{url('masterpegawai')}}">
      <div class="row">
        <!--column -->
        <div class="col-md-12">
          @if(Session::has('message'))
            <div class="alert alert-success">
              <h4>Berhasil!</h4>
              <p>{{ Session::get('message') }}</p>
            </div>
          @endif
        </div>
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Informasi Utama</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group {{ $errors->has('nip') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">NIP Baru</label>
                  <div class="col-sm-9">
                    <input type="text" name="nip" class="form-control" placeholder="NIP Baru"
                      @if(!$errors->has('nip'))
                       value="{{ old('nip') }}"
                      @endif
                    >
                    @if($errors->has('nip'))
                      <span class="help-block">
                        <strong>{{ $errors->first('nip')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('nip_lama') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">NIP Lama</label>
                  <div class="col-sm-9">
                    <input type="text" name="nip_lama" class="form-control" placeholder="NIP Lama"
                    @if(!$errors->has('nip_lama'))
                       value="{{ old('nip_lama') }}"
                      @endif
                    >
                    @if($errors->has('nip_lama'))
                      <span class="help-block">
                        <strong>{{ $errors->first('nip_lama')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">Nama Pegawai</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Pegawai"
                      @if(!$errors->has('nama'))
                       value="{{ old('nama') }}"
                      @endif
                    >
                    @if($errors->has('nama'))
                      <span class="help-block">
                        <strong>{{ $errors->first('nama')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">Alamat</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" name="alamat" rows="3" cols="40" placeholder="Alamat">{{ !$errors->has('alamat') ? old('alamat') : '' }}</textarea>
                    @if($errors->has('alamat'))
                      <span class="help-block">
                        <strong>{{ $errors->first('alamat')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">Tanggal Lahir</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="tanggal_lahir" name="tanggal_lahir" data-date-format="dd-mm-yyyy"
                        @if(!$errors->has('tanggal_lahir'))
                         value="{{ old('tanggal_lahir') }}"
                        @endif
                      >
                    </div><!-- /.input group -->
                    @if($errors->has('tanggal_lahir'))
                      <span class="help-block">
                        <strong>{{ $errors->first('tanggal_lahir')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" placeholder="Email"
                      @if(!$errors->has('email'))
                       value="{{ old('email') }}"
                      @endif
                    >
                    @if($errors->has('email'))
                          <span class="help-block">
                            <strong>{{ $errors->first('email')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('jk') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">Jenis Kelamin</label>
                  <div class="col-sm-9">
                    <div class="col-sm-9">
                      <label>
                        <input type="radio" name="jk" class="minimal" value="L" {{ old('jk') == 'L' ? 'checked' : '' }}>
                      </label>
                      &nbsp;
                      <label>Pria</label>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <label>
                        <input type="radio" name="jk" class="minimal" value="P" {{ old('jk') == 'P' ? 'checked' : '' }}>
                      </label>
                      &nbsp;
                      <label>Wanita</label>
                    </div>
                    @if($errors->has('jk'))
                      <span class="help-block">
                        <strong>{{ $errors->first('jk')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">Agama</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="agama">
                      <option value="" disabled selected>-- Pilih Agama --</option>
                      <option value="Islam" {{ old('agama') == 'Islam' ? 'selected="selected"' : '' }}>Islam</option>
                      <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected="selected"' : '' }}>Kristen</option>
                      <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected="selected"' : '' }}>Hindu</option>
                      <option value="Budha" {{ old('agama') == 'Budha' ? 'selected="selected"' : '' }}>Budha</option>
                      <option value="Lainnya" {{ old('agama') == 'Lainnya' ? 'selected="selected"' : '' }}>Lainnya</option>
                    </select>
                    @if($errors->has('agama'))
                      <span class="help-block">
                        <strong>{{ $errors->first('agama')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('jabatan') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">Jabatan</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="jabatan">
                      <option value="" disabled selected>-- Pilih Jabatan --</option>
                      @foreach($getjabatan as $key)
                        <option value="{{ $key->id }}" {{ old('jabatan') == $key->id ? 'selected="selected"' : '' }}>{{ $key->kode_jabatan }} - {{ $key->nama_jabatan }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('jabatan'))
                      <span class="help-block">
                        <strong>{{ $errors->first('jabatan')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('status_karyawan') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">Status</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="status_karyawan">
                      <option value="" disabled selected>-- Pilih Status Karyawan --</option>
                      <option value="Kontrak" {{ old('status_karyawan') == 'Kontrak' ? 'selected="selected"' : '' }}>Kontrak</option>
                      <option value="Freelance" {{ old('status_karyawan') == 'Freelance' ? 'selected="selected"' : '' }}>Freelance</option>
                      <option value="Tetap" {{ old('status_karyawan') == 'Tetap' ? 'selected="selected"' : '' }}>Tetap</option>
                    </select>
                    @if($errors->has('status_karyawan'))
                      <span class="help-block">
                        <strong>{{ $errors->first('status_karyawan')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!--/.col -->

        <div class="col-md-6">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Informasi Pendukung</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="form-group {{ $errors->has('no_ktp') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label">KTP</label>
                <div class="col-sm-9">
                  <input type="text" name="no_ktp" maxlength="16" class="form-control" placeholder="Nomor KTP"
                  @if(!$errors->has('no_ktp'))
                   value="{{ old('no_ktp') }}"
                  @endif
                  >
                  @if($errors->has('no_ktp'))
                    <span class="help-block">
                      <strong>{{ $errors->first('no_ktp')}}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('no_kk') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label">Kartu Keluarga</label>
                <div class="col-sm-9">
                  <input type="text" name="no_kk" class="form-control" placeholder="Nomor KK"
                    @if(!$errors->has('no_kk'))
                     value="{{ old('no_kk') }}"
                    @endif
                  >
                  @if($errors->has('no_kk'))
                    <span class="help-block">
                      <strong>{{ $errors->first('no_kk')}}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('no_npwp') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label">NPWP</label>
                <div class="col-sm-9">
                  <input type="text" name="no_npwp" class="form-control" placeholder="Nomor NPWP"
                    @if(!$errors->has('no_npwp'))
                     value="{{ old('no_npwp') }}"
                    @endif
                  >
                  @if($errors->has('no_npwp'))
                    <span class="help-block">
                      <strong>{{ $errors->first('no_npwp')}}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('no_telp') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label">Telepon</label>
                <div class="col-sm-9">
                  <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon"
                    @if(!$errors->has('no_telp'))
                     value="{{ old('no_telp') }}"
                    @endif
                  >
                  @if($errors->has('no_telp'))
                    <span class="help-block">
                      <strong>{{ $errors->first('no_telp')}}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('no_rekening') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label">Rekening</label>
                <div class="col-sm-9">
                  <input type="text" name="no_rekening" class="form-control" placeholder="Nomor Rekening"
                    @if(!$errors->has('no_rekening'))
                     value="{{ old('no_rekening') }}"
                    @endif
                  >
                  @if($errors->has('no_rekening'))
                    <span class="help-block">
                      <strong>{{ $errors->first('no_rekening')}}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('bpjs_kesehatan') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label">BPJS Kesehatan</label>
                <div class="col-sm-9">
                  <input type="text" name="bpjs_kesehatan" class="form-control" placeholder="Nomor BPJS Kesehatan"
                    @if(!$errors->has('bpjs_kesehatan'))
                     value="{{ old('bpjs_kesehatan') }}"
                    @endif
                  >
                  @if($errors->has('bpjs_kesehatan'))
                    <span class="help-block">
                      <strong>{{ $errors->first('bpjs_kesehatan')}}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('bpjs_ketenagakerjaan') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label">BPJS Ketenagakerjaan</label>
                <div class="col-sm-9">
                  <input type="text" name="bpjs_ketenagakerjaan" class="form-control" placeholder="Nomor BPJS Ketenagakerjaan"
                    @if(!$errors->has('bpjs_ketenagakerjaan'))
                     value="{{ old('bpjs_ketenagakerjaan') }}"
                    @endif
                  >
                  @if($errors->has('bpjs_ketenagakerjaan'))
                    <span class="help-block">
                      <strong>{{ $errors->first('bpjs_ketenagakerjaan')}}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('status_pajak') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label">Status Pajak</label>
                <div class="col-sm-9">
                  <select class="form-control" name="status_pajak">
                    <option value="" disabled selected>-- Pilih Status Pajak --</option>
                    <option value="Wajib Pajak" {{ old('status_pajak') == 'Wajib Pajak' ? 'selected="selected"' : '' }}>Wajib Pajak</option>
                    <option value="Tidak Wajib Pajak" {{ old('status_pajak') == 'Tidak Wajib Pajak' ? 'selected="selected"' : '' }}>Tidak Wajib Pajak</option>
                  </select>
                  @if($errors->has('status_pajak'))
                    <span class="help-block">
                      <strong>{{ $errors->first('status_pajak')}}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('kewarganegaraan') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label">Kewarganegaraan</label>
                <div class="col-sm-9">
                  <select class="form-control" name="kewarganegaraan">
                    <option value="" disabled selected>-- Pilih Kewarganegaraan --</option>
                    <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected="selected"' : '' }}>WNI</option>
                    <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected="selected"' : '' }}>WNA</option>
                  </select>
                  @if($errors->has('kewarganegaraan'))
                    <span class="help-block">
                      <strong>{{ $errors->first('kewarganegaraan')}}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
            </div> <!-- /.box-body -->
            {{-- <div class="box-footer">
              <button type="reset" class="btn btn-default">Reset Formulir</button>
              <button type="submit" class="btn btn-info pull-right">Simpan</button>
            </div><!-- /.box-footer --> --}}
          </div> <!-- /.box-info -->
        </div> <!-- /.col -->

        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_Keluarga" data-toggle="tab">Data Keluarga</a></li>
              <li><a href="#tab_Pengalaman" data-toggle="tab">Pengalaman Kerja</a></li>
              <li><a href="#tab_Kesehatan" data-toggle="tab">Kondisi Kesehatan</a></li>
              <li><a href="#tab_Pendidikan" data-toggle="tab">Pendidikan</a></li>
              <li><a href="#tab_Bahasa" data-toggle="tab">Bahasa Asing</a></li>
              <li><a href="#tab_Komputer" data-toggle="tab">Keahlian Komputer</a></li>
              <li><a href="#tab_Penyakit" data-toggle="tab">Riwayat Penyakit</a></li>
            </ul>
            {{-- START TAB 1 --}}
            <div class="tab-content">
              <div class="tab-pane active" id="tab_Keluarga">
                <div class="box-body">
                  <table class="table" id="dKeluarga">
                    <thead>
                      <label class="btn btn-round bg-green" onclick="addKeluarga('dKeluarga')">Tambah Anggota</label>&nbsp;<label class="btn btn-round bg-red" onclick="delKeluarga('dKeluarga')">Hapus Anggota</label>
                    </thead>
                    <tbody>
                      <tr>
                        <th></th>
                        <th width="200px">Nama</th>
                        <th width="200px">Hubungan</th>
                        <th width="200px">Tanggal Lahir</th>
                        <th width="200px">Pekerjaan</th>
                        <th width="200px">Jenis Kelamin</th>
                        <th width="200px">Alamat</th>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="chk"/></td>
                        <td>
                          <div class="{{ $errors->has('nama_keluarga') ? 'has-error' : '' }}">
                            <input type="text" name="nama_keluarga[0]" class="form-control" placeholder="Nama Keluarga" required="[]"
                              @if(!$errors->has('nama_keluarga'))
                               value="{{ old('nama_keluarga') }}"
                              @endif
                            >
                              @if($errors->has('nama_keluarga'))
                                <span class="help-block">
                                  <strong><h6>{{ $errors->first('nama_keluarga')}}</h6></strong>
                                </span>
                              @endif
                          </div>
                        </td>
                        <td>
                          <div class="{{ $errors->has('hubungan_keluarga') ? 'has-error' : '' }}">
                            <select class="form-control" name="hubungan_keluarga[0]" required="[]">
                              <option value="" disabled selected>-- Pilih --</option>
                              <option value="AYAH" {{ old('hubungan_keluarga') == 'AYAH' ? 'selected="selected"' : '' }}>AYAH</option>
                              <option value="IBU" {{ old('hubungan_keluarga') == 'IBU' ? 'selected="selected"' : '' }}>IBU</option>
                              <option value="KAKAK" {{ old('hubungan_keluarga') == 'KAKAK' ? 'selected="selected"' : ''}}>KAKAK</option>
                              <option value="ADIK" {{ old('hubungan_keluarga') == 'ADIK' ? 'selected="selected"' : ''}}>ADIK</option>
                              <option value="LAINNYA" {{ old('hubungan_keluarga') == 'LAINNYA' ? 'selected="selected"' : ''}}>LAINNYA</option>
                            </select>
                            @if($errors->has('hubungan_keluarga'))
                              <span class="help-block">
                                <strong><h6>{{ $errors->first('hubungan_keluarga')}}</h6></strong>
                              </span>
                            @endif
                          </div>
                        </td>
                        <td>
                          <div class="{{ $errors->has('tanggal_lahir_keluarga') ? 'has-error' : '' }}">
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tanggal_lahir_keluarga" name="tanggal_lahir_keluarga[0]" data-date-format="dd-mm-yyyy"
                              @if(!$errors->has('tanggal_lahir_keluarga'))
                               value="{{ old('tanggal_lahir_keluarga') }}"
                              @endif>
                            </div>
                            @if($errors->has('tanggal_lahir_keluarga'))
                              <span class="help-block">
                                <strong><h6>{{ $errors->first('tanggal_lahir_keluarga')}}</h6></strong>
                              </span>
                            @endif
                          </div>
                        </td>
                        <td>
                          <select class="form-control" name="pekerjaan_keluarga[0]">
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="PEGAWAINEGERI" {{ old('pekerjaan_keluarga') == 'PEGAWAINEGERI' ? 'selected="selected"' : '' }}>PEGAWAI NEGERI</option>
                            <option value="PEGAWAISWASTA" {{ old('pekerjaan_keluarga') == 'PEGAWAISWASTA' ? 'selected="selected"' : '' }}>PEGAWAI SWASTA</option>
                            <option value="WIRASAWASTA" {{ old('pekerjaan_keluarga') == 'WIRASAWASTA' ? 'selected="selected"' : '' }}>WIRASAWASTA</option>
                            <option value="RUMAH TANGGA" {{ old('pekerjaan_keluarga') == 'RUMAH TANGGA' ? 'selected="selected"' : '' }}>RUMAH TANGGA</option>
                            <option value="MAHASISWA" {{ old('pekerjaan_keluarga') == 'MAHASISWA' ? 'selected="selected"' : '' }}>MAHASISWA</option>
                            <option value="PELAJAR" {{ old('pekerjaan_keluarga') == 'PELAJAR' ? 'selected="selected"' : '' }}>PELAJAR</option>
                            <option value="LAINNYA" {{ old('pekerjaan_keluarga') == 'LAINNYA' ? 'selected="selected"' : '' }}>LAINNYA</option>
                          </select>
                          @if($errors->has('pekerjaan_keluarga'))
                            <span class="help-block">
                              <strong>{{ $errors->first('pekerjaan_keluarga')}}
                              </strong>
                            </span>
                          @endif
                        </td>
                        <td>
                          {{-- <div class="form-group"> --}}
                            <label>
                              <input type="radio" name="jenis_kelamin_keluarga[0]" class="minimal" value="L" {{ old('jenis_kelamin_keluarga') == 'L' ? 'checked' : '' }}>
                            </label>
                            {{-- &nbsp; --}}
                            <label>Pria</label>
                            &nbsp;&nbsp;&nbsp;
                            <label>
                              <input type="radio" name="jenis_kelamin_keluarga[0]" class="minimal" value="P" {{ old('jenis_kelamin_keluarga') == 'P' ? 'checked' : '' }}>
                            </label>
                            {{-- &nbsp; --}}
                            <label>Wanita</label>
                          {{-- </div> --}}
                          @if($errors->has('jenis_kelamin_keluarga'))
                            <span class="help-block">
                              <strong>{{ $errors->first('jenis_kelamin_keluarga')}}
                              </strong>
                            </span>
                          @endif
                        </td>
                        <td>
                          <textarea type="text" name="alamat_keluarga[0]" class="form-control uppercase" placeholder="Alamat" rows="2">@if(!$errors->has('alamat_keluarga')){{ old('alamat_keluarga') }}@endif</textarea>
                          @if($errors->has('alamat_keluarga'))
                            <span class="help-block">
                              <strong>{{ $errors->first('alamat_keluarga')}}
                              </strong>
                            </span>
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              {{-- END TAB 1 --}}

              {{-- START Pengalaman Kerja--}}
              <div class="tab-pane" id="tab_Pengalaman">
                <div class="box-body">
                  <table class="table" id="dPengalaman">
                    <thead>
                      <label class="btn btn-round bg-green" onclick="addPengalaman('dPengalaman')">Tambah Pengalaman</label>&nbsp;
                      <label class="btn btn-round bg-red" onclick="delPengalaman('dPengalaman')">Hapus Pengalaman</label>
                    </thead>
                    <tbody>
                      <tr>
                        <th width="20px"></th>
                        <th width="250px">Nama Perusahaan</th>
                        <th width="300px">Posisi</th>
                        <th width="150px">Tahun Awal Kerja</th>
                        <th width="150px">Tahun Akhir Kerja</th>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="chk"/></td>
                        <td>
                          <div class="{{ $errors->has('nama_perusahaan') ? 'has-error' : '' }}">
                            <input type="text" name="nama_perusahaan[0]" id="nama_perusahaan" class="form-control" placeholder="Nama Perusahaan" required="[]"
                              @if(!$errors->has('nama_perusahaan'))
                               value="{{ old('nama_perusahaan') }}"
                              @endif
                            >
                              @if($errors->has('nama_perusahaan'))
                                <span class="help-block">
                                  <strong><h6>{{ $errors->first('nama_perusahaan')}}</h6></strong>
                                </span>
                              @endif
                          </div>
                        </td>
                        <td>
                          <div class="{{ $errors->has('posisi') ? 'has-error' : '' }}">
                            <input type="text" name="posisi[0]" id="posisi" class="form-control" placeholder="Posisi" required="[]"
                              @if(!$errors->has('posisi'))
                               value="{{ old('posisi') }}"
                              @endif
                            >
                              @if($errors->has('posisi'))
                                <span class="help-block">
                                  <strong><h6>{{ $errors->first('posisi')}}</h6></strong>
                                </span>
                              @endif
                          </div>
                        </td>
                        <td>
                          <div class="{{ $errors->has('tahun_awal_kerja') ? 'has-error' : '' }}">
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tahun_awal_kerja" name="tahun_awal_kerja[0]" data-date-format="dd-mm-yyyy" required="[]"
                              @if(!$errors->has('tahun_awal_kerja'))
                               value="{{ old('tahun_awal_kerja') }}"
                              @endif>
                            </div>
                            @if($errors->has('tahun_awal_kerja'))
                              <span class="help-block">
                                <strong><h6>{{ $errors->first('tahun_awal_kerja')}}</h6></strong>
                              </span>
                            @endif
                          </div>
                        </td>
                        <td>
                          <div class="{{ $errors->has('tahun_akhir_kerja') ? 'has-error' : '' }}">
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tahun_akhir_kerja" name="tahun_akhir_kerja[0]" data-date-format="dd-mm-yyyy" required="[]"
                              @if(!$errors->has('tahun_akhir_kerja'))
                               value="{{ old('tahun_akhir_kerja') }}"
                              @endif>
                            </div>
                            @if($errors->has('tahun_akhir_kerja'))
                              <span class="help-block">
                                <strong><h6>{{ $errors->first('tahun_akhir_kerja')}}</h6></strong>
                              </span>
                            @endif
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              {{-- END Pengalaman Kerja--}}
              {{-- START TAB 2 --}}
              <div class="tab-pane" id="tab_Kesehatan">
                <div class="box-body">
                  <div class="form-group {{ $errors->has('tinggi_badan') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Tinggi Badan</label>
                    <div class="col-sm-6">
                      <input type="text" name="tinggibadan" class="form-control" placeholder="Tinggi Badan" maxlength="4" onkeyup="validAngka(this)">
                      @if($errors->has('tinggi_badan'))
                        <span class="help-block">
                          <strong>{{ $errors->first('tinggi_badan')}}
                          </strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('berat_badan') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Berat Badan</label>
                    <div class="col-sm-6">
                      <input type="text" name="beratbadan" class="form-control" placeholder="Berat Badan" maxlength="4" onkeyup="validAngka(this)">
                      @if($errors->has('berat_badan'))
                        <span class="help-block">
                          <strong>{{ $errors->first('berat_badan')}}
                          </strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('warna_rambut') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Warna Rambut</label>
                    <div class="col-sm-6">
                      <input type="text" name="warnarambut" class="form-control  uppercase" placeholder="Warna Rambut" maxlength="10">
                      @if($errors->has('warna_rambut'))
                        <span class="help-block">
                          <strong>{{ $errors->first('warna_rambut')}}
                          </strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('warna_mata') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Warna Mata</label>
                      <div class="col-sm-6">
                      <input type="text" name="warnamata" class="form-control" placeholder="Warna Mata"  maxlength="10">
                      @if($errors->has('warna_mata'))
                        <span class="help-block">
                          <strong>{{ $errors->first('warna_mata')}}
                          </strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('berkacamata') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Berkacamata</label>
                    <div class="col-sm-6">
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
                  </div>
                  <div class="form-group {{ $errors->has('merokok') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Merokok</label>
                    <div class="col-sm-6">
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
            </div>
            {{-- END TAB 2 --}}
            {{-- START TAB 3 --}}
            <div class="tab-pane" id="tab_Pendidikan">
              <div class="box-body">
                <table class="table table-hover" id="dPendidikan">
                  <thead>
                    <label class="btn btn-round bg-green" onclick="addPendidikan('dPendidikan')">Tambah Pendidikan</label>&nbsp;
                    <label class="btn btn-round bg-red" onclick="delPendidikan('dPendidikan')">Hapus Pendidikan</label>
                  <thead>
                  <tbody>
                    <tr>
                      <th width="20px"></th>
                      <th width="200px">Jenjang</th>
                      <th width="200px">Institusi</th>
                      <th width="200px">Tahun Masuk</th>
                      <th width="200px">Tahun Lulus</th>
                      <th width="200px">Gelar</th>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk"/></td>
                      <td>
                        <select class="form-control" name="jenjangpendidikan[0]" required="">
                          <option value="" disabled selected>-- Pilih --</option>
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
                      </td>
                      <td>
                        <input type="text" name="institusipendidikan[0]" class="form-control uppercase" placeholder="Institusi Pendidikan" required="">
                        @if($errors->has('institusi_pendidikan'))
                          <span class="help-block">
                            <strong>{{ $errors->first('institusi_pendidikan')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <input type="text" name="tahunmasuk[0]" class="form-control" placeholder="Tahun Masuk" maxlength="4" onkeyup="validAngka(this)" required="">
                        @if($errors->has('tahun_masuk'))
                          <span class="help-block">
                            <strong>{{ $errors->first('tahun_masuk')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <input type="text" name="tahunlulus[0]" class="form-control" placeholder="Tahun Lulus" maxlength="4" onkeyup="validAngka(this)" required="">
                        @if($errors->has('tahun_lulus'))
                          <span class="help-block">
                            <strong>{{ $errors->first('tahun_lulus')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <input type="text" name="gelarakademik[0]" class="form-control" placeholder="Gelar Kelulusan" maxlength="10" required="">
                        @if($errors->has('gelar_akademik'))
                          <span class="help-block">
                            <strong>{{ $errors->first('gelar_akademik')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            {{-- END TAB 3 --}}
            {{-- START TAB 4 --}}
            <div class="tab-pane" id="tab_Bahasa">
              <div class="box-body">
                <table class="table table-hover" id="dBahasa">
                  <thead>
                    <label class="btn btn-round bg-green" onclick="addBahasa('dBahasa')">Tambah Bahasa</label>&nbsp;
                    <label class="btn btn-round bg-red" onclick="delBahasa('dBahasa')">Hapus Bahasa</label>
                  <thead>
                  <tbody>
                    <tr>
                      <th width="20px"></th>
                      <th width="200px">Bahasa</th>
                      <th width="200px">Berbicara</th>
                      <th width="200px">Menulis</th>
                      <th width="200px">Mengerti</th>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk"/></td>
                      <td>
                        <input type="text" name="bahasa[0]" class="form-control uppercase" placeholder="Bahasa" required=""
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
                      </td>
                      <td>
                        <select class="form-control" name="berbicara[0]" required="">
                          <option value="" disabled selected>-- Pilih --</option>
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
                      </td>
                      <td>
                        <select class="form-control" name="menulis[0]" required="">
                          <option value="" disabled selected>-- Pilih --</option>
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
                      </td>
                      <td>
                        <select class="form-control" name="mengerti[0]" required="">
                          <option value="" disabled selected>-- Pilih --</option>
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
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            {{-- END TAB 4 --}}
            {{-- START TAB 5 --}}
            <div class="tab-pane" id="tab_Komputer">
              <div class="box-body">
                <table class="table table-hover" id="dKomputer">
                  <thead>
                    <label class="btn btn-round bg-green" onclick="addKomputer('dKomputer')">Tambah Komputer</label>&nbsp;
                    <label class="btn btn-round bg-red" onclick="delKomputer('dKomputer')">Hapus Komputer</label>
                  <thead>
                  <tbody>
                    <tr>
                      <th width="20px"></th>
                      <th width="200px">Nama Program</th>
                      <th width="200px">Nilai</th>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk"/></td>
                      <td>
                        <input type="text" name="nama_program[0]" class="form-control" placeholder="Nama Program"
                        @if(isset($data['nama_program']))
                          value="{{  $data['nama_program']->bahasa }}"
                        @endif
                        >
                        @if($errors->has('nama_program'))
                          <span class="help-block">
                            <strong>{{ $errors->first('nama_program')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <select class="form-control" name="nilai[0]">
                          <option value="" disabled selected>-- Pilih --</option>
                          <option value="1" {{ old('nilai') == '1' ? 'selected="selected"' : '' }}>BAIK</option>
                          <option value="2" {{ old('nilai') == '2' ? 'selected="selected"' : '' }}>CUKUP</option>
                          <option value="3" {{ old('nilai') == '3' ? 'selected="selected"' : '' }}>KURANG</option>
                        </select>
                        @if($errors->has('nilai'))
                          <span class="help-block">
                            <strong>{{ $errors->first('nilai')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            {{-- START TAB 5 --}}
            {{-- START TAB 6 --}}
            <div class="tab-pane" id="tab_Penyakit">
              <div class="box-body">
                <table class="table table-hover" id="dPenyakit">
                  <thead>
                    <label class="btn btn-round bg-green" onclick="addPenyakit('dPenyakit')">Tambah Penyakit</label>&nbsp;
                    <label class="btn btn-round bg-red" onclick="delPenyakit('dPenyakit')">Hapus Penyakit</label>
                  </thead>
                  <tbody>
                    <tr>
                      <td width="20px"></th>
                      <th width="200px">Nama Penyakit</th>
                      <th width="200px">Keterangan</th>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk"/></td>
                      <td>
                        <input type="text" name="nama_penyakit[0]" class="form-control" placeholder="Nama Penyakit"
                        @if(isset($data['nama_penyakit']))
                          value="{{  $data['nama_penyakit']->bahasa }}"
                        @endif
                        >
                        @if($errors->has('nama_penyakit'))
                          <span class="help-block">
                            <strong>{{ $errors->first('nama_penyakit')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <textarea type="text" name="keterangan[0]" class="form-control" placeholder="Keterangan" rows="2" cols="40"></textarea>
                        @if($errors->has('keterangan'))
                          <span class="help-block">
                            <strong>{{ $errors->first('keterangan')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            {{-- START TAB 6 --}}
          </div>
          {{-- START BUTTON BOTTOM --}}
          <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
          {{-- END BUTTON BOTTOM --}}
        </div>
      </div>
      </div>   <!-- /.row -->
    </form>

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
      $('#tanggal_lahir_keluarga').datepicker();
      $('#tahun_awal_kerja').datepicker();
      $('#tahun_akhir_kerja').datepicker();
    });
  </script>

  <script language="javascript">
    var numA=1;
    function addKeluarga(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;

        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';

        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<input type="text" name="nama_keluarga['+numA+']" class="form-control" placeholder="Nama Keluarga" required="[]"@if(!$errors->has('nama_keluarga'))value="{{ old('nama_keluarga') }}"@endif>@if($errors->has('nama_keluarga'))<span class="help-block"><strong><h6>{{ $errors->first('nama_keluarga')}}</h6></strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<select class="form-control" name="hubungan_keluarga['+numA+']" required="[]"><option value="" disabled selected>-- Pilih --</option><option value="AYAH" {{ old('hubungan_keluarga') == 'AYAH' ? 'selected="selected"' : '' }}>AYAH</option><option value="IBU" {{ old('hubungan_keluarga') == 'IBU' ? 'selected="selected"' : '' }}>IBU</option><option value="KAKAK" {{ old('hubungan_keluarga') == 'KAKAK' ? 'selected="selected"' : ''}}>KAKAK</option><option value="ADIK" {{ old('hubungan_keluarga') == 'ADIK' ? 'selected="selected"' : ''}}>ADIK</option><option value="LAINNYA" {{ old('hubungan_keluarga') == 'LAINNYA' ? 'selected="selected"' : ''}}>LAINNYA</option></select>@if($errors->has('hubungan_keluarga'))<span class="help-block"><strong><h6>{{ $errors->first('hubungan_keluarga')}}</h6></strong></span>@endif';

        var cell4 = row.insertCell(3);
        cell4.innerHTML = '<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right" id="tanggal_lahir_keluarga" name="tanggal_lahir_keluarga['+numA+']" data-date-format="dd-mm-yyyy"@if(!$errors->has('tanggal_lahir_keluarga'))value="{{ old('tanggal_lahir_keluarga') }}"@endif></div>@if($errors->has('tanggal_lahir_keluarga'))<span class="help-block"><strong><h6>{{ $errors->first('tanggal_lahir_keluarga')}}</h6></strong></span>@endif';

        var cell5 = row.insertCell(4);
        cell5.innerHTML = '<select class="form-control" name="pekerjaan_keluarga['+numA+']"><option value="" disabled selected>-- Pilih --</option><option value="PEGAWAINEGERI" {{ old('pekerjaan_keluarga') == 'PEGAWAINEGERI' ? 'selected="selected"' : '' }}>PEGAWAI NEGERI</option><option value="PEGAWAISWASTA" {{ old('pekerjaan_keluarga') == 'PEGAWAISWASTA' ? 'selected="selected"' : '' }}>PEGAWAI SWASTA</option><option value="WIRASAWASTA" {{ old('pekerjaan_keluarga') == 'WIRASAWASTA' ? 'selected="selected"' : '' }}>WIRASAWASTA</option><option value="RUMAH TANGGA" {{ old('pekerjaan_keluarga') == 'RUMAH TANGGA' ? 'selected="selected"' : '' }}>RUMAH TANGGA</option><option value="MAHASISWA" {{ old('pekerjaan_keluarga') == 'MAHASISWA' ? 'selected="selected"' : '' }}>MAHASISWA</option><option value="PELAJAR" {{ old('pekerjaan_keluarga') == 'PELAJAR' ? 'selected="selected"' : '' }}>PELAJAR</option><option value="LAINNYA" {{ old('pekerjaan_keluarga') == 'LAINNYA' ? 'selected="selected"' : '' }}>LAINNYA</option></select>@if($errors->has('pekerjaan_keluarga'))<span class="help-block"><strong>{{ $errors->first('pekerjaan_keluarga')}}</strong></span>@endif';

        var cell6 = row.insertCell(5);
        cell6.innerHTML = '<label><input type="radio" name="jenis_kelamin_keluarga['+numA+']" class="minimal" value="L" {{ old('jenis_kelamin_keluarga') == 'L' ? 'checked' : '' }}></label><label>Pria</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="jenis_kelamin_keluarga['+numA+']" class="minimal" value="P" {{ old('jenis_kelamin_keluarga') == 'P' ? 'checked' : '' }}></label><label>Wanita</label>@if($errors->has('jenis_kelamin_keluarga'))<span class="help-block"><strong>{{ $errors->first('jenis_kelamin_keluarga')}}</strong></span>@endif';

        var cell7 = row.insertCell(6);
        cell7.innerHTML = '<textarea type="text" name="alamat_keluarga['+numA+']" class="form-control uppercase" placeholder="Alamat" rows="2">@if(!$errors->has('alamat_keluarga')){{ old('alamat_keluarga')}}@endif</textarea>@if($errors->has('alamat_keluarga'))<span class="help-block"><strong>{{ $errors->first('alamat_keluarga')}}</strong></span>@endif';
        numA++;
    }

    function delKeluarga(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
                numA--;
            }
        }
        }catch(e) {
            alert(e);
        }
    }
  </script>

  <script language="javascript">
    var numB=1;
    function addPengalaman(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;

        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';

        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<input type="text" name="nama_perusahaan['+numB+']" id="nama_perusahaan" class="form-control" placeholder="Nama Perusahaan"@if(!$errors->has('nama_perusahaan'))value="{{ old('nama_perusahaan') }}"@endif>@if($errors->has('nama_perusahaan'))<span class="help-block"><strong><h6>{{ $errors->first('nama_perusahaan')}}</h6></strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<input type="text" name="posisi['+numB+']" id="posisi" class="form-control" placeholder="Posisi" required="[]"@if(!$errors->has('posisi'))value="{{ old('posisi') }}"@endif>@if($errors->has('posisi'))<span class="help-block"><strong><h6>{{ $errors->first('posisi')}}</h6></strong></span>@endif';

        var cell4 = row.insertCell(3);
        cell4.innerHTML = '<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right" id="tahun_awal_kerja" name="tahun_awal_kerja['+numB+']" data-date-format="dd-mm-yyyy" required="[]"@if(!$errors->has('tahun_awal_kerja'))value="{{ old('tahun_awal_kerja') }}"@endif></div>@if($errors->has('tahun_awal_kerja'))<span class="help-block"><strong><h6>{{ $errors->first('tahun_awal_kerja')}}</h6></strong></span>@endif';

        var cell5 = row.insertCell(4);
        cell5.innerHTML = '<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right" id="tahun_akhir_kerja" name="tahun_akhir_kerja['+numB+']" data-date-format="dd-mm-yyyy" required="[]"@if(!$errors->has('tahun_akhir_kerja'))value="{{ old('tahun_akhir_kerja') }}"@endif></div>@if($errors->has('tahun_akhir_kerja'))<span class="help-block"><strong><h6>{{ $errors->first('tahun_akhir_kerja')}}</h6></strong></span>@endif';
        numB++;
    }

    function delPengalaman(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
                numB--;
            }
        }
        }catch(e) {
            alert(e);
        }
    }
  </script>

  <script language="javascript">
    var numC=1;
    function addPendidikan(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;

        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';

        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<select class="form-control" name="jenjangpendidikan['+numC+']" required=""><option value="" disabled selected>-- Pilih --</option><option value="PELATIHANKEAHLIAN">PELATIHAN KEAHLIAN</option><option value="S2">S2 Magister</option><option value="S1">S1 Universitas</option><option value="D3">D3 Akademik</option><option value="SMU">SMU</option><option value="SMP">SMP</option><option value="SD">SD</option><option value="LAINNYA">LAINNYA</option></select>@if($errors->has('jenjang_pendidikan'))<span class="help-block"><strong>{{ $errors->first('jenjang_pendidikan')}}</strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<input type="text" name="institusipendidikan['+numC+']" class="form-control uppercase" placeholder="Institusi Pendidikan" required="">@if($errors->has('institusi_pendidikan'))<span class="help-block"><strong>{{ $errors->first('institusi_pendidikan')}}</strong></span>@endif';

        var cell4 = row.insertCell(3);
        cell4.innerHTML = '<input type="text" name="tahunmasuk['+numC+']" class="form-control" placeholder="Tahun Masuk" maxlength="4" onkeyup="validAngka(this)" required="">@if($errors->has('tahun_masuk'))<span class="help-block"><strong>{{ $errors->first('tahun_masuk')}}</strong></span>@endif';

        var cell5 = row.insertCell(4);
        cell5.innerHTML = '<input type="text" name="tahunlulus['+numC+']" class="form-control" placeholder="Tahun Lulus" maxlength="4" onkeyup="validAngka(this)" required="">@if($errors->has('tahun_lulus'))<span class="help-block"><strong>{{ $errors->first('tahun_lulus')}}</strong></span>@endif';

        var cell6 = row.insertCell(5);
        cell6.innerHTML = '<input type="text" name="gelarakademik['+numC+']" class="form-control" placeholder="Gelar Kelulusan" maxlength="10" required="">@if($errors->has('gelar_akademik'))<span class="help-block"><strong>{{ $errors->first('gelar_akademik')}}</strong></span>@endif';
        numC++;
    }

    function delPendidikan(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
                numC--;
            }
        }
        }catch(e) {
            alert(e);
        }
    }
  </script>

  <script language="javascript">
    var numD=1;
    function addBahasa(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;

        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';

        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<input type="text" name="bahasa['+numD+']" class="form-control uppercase" placeholder="Bahasa" required=""@if(isset($data['bindbahasaasing']))value="{{  $data['bindbahasaasing']->bahasa }}" readonly="true"@endif>@if($errors->has('bahasa'))<span class="help-block"><strong>{{ $errors->first('bahasa')}}</strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<select class="form-control" name="berbicara['+numD+']" required=""><option value="" disabled selected>-- Pilih --</option><option value="1" {{ old('berbicara') == '1' ? 'selected="selected"' : '' }}>BAIK</option><option value="2" {{ old('berbicara') == '2' ? 'selected="selected"' : '' }}>CUKUP</option><option value="3" {{ old('berbicara') == '3' ? 'selected="selected"' : '' }}>KURANG</option></select>@if($errors->has('berbicara'))<span class="help-block"><strong>{{ $errors->first('berbicara')}}</strong></span>@endif';

        var cell4 = row.insertCell(3);
        cell4.innerHTML = '<select class="form-control" name="menulis['+numD+']" required=""><option value="" disabled selected>-- Pilih --</option><option value="1" {{ old('menulis') == 'Baik' ? 'selected="selected"' : '' }}>BAIK</option><option value="2" {{ old('menulis') == 'Cukup' ? 'selected="selected"' : '' }}>CUKUP</option><option value="3" {{ old('menulis') == 'Kurang' ? 'selected="selected"' : '' }}>KURANG</option></select>@if($errors->has('menulis'))<span class="help-block"><strong>{{ $errors->first('menulis')}}</strong></span>@endif';

        var cell5 = row.insertCell(4);
        cell5.innerHTML = '<select class="form-control" name="mengerti['+numD+']" required=""><option value="" disabled selected>-- Pilih --</option><option value="1" {{ old('mengerti') == 'Baik' ? 'selected="selected"' : '' }}>BAIK</option><option value="2" {{ old('mengerti') == 'Cukup' ? 'selected="selected"' : '' }}>CUKUP</option><option value="3" {{ old('mengerti') == 'Kurang' ? 'selected="selected"' : '' }}>KURANG</option></select>@if($errors->has('mengerti'))<span class="help-block"><strong>{{ $errors->first('mengerti')}}</strong></span>@endif';
        numD++;
    }

    function delBahasa(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
                numD--;
            }
        }
        }catch(e) {
            alert(e);
        }
    }
  </script>

  <script language="javascript">
    var numE=1;
    function addKomputer(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;

        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';

        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<input type="text" name="nama_program['+numE+']" class="form-control" placeholder="Nama Program"@if(isset($data['nama_program']))value="{{  $data['nama_program']->bahasa }}"@endif>@if($errors->has('nama_program'))<span class="help-block"><strong>{{ $errors->first('nama_program')}}</strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<select class="form-control" name="nilai['+numE+']"><option value="" disabled selected>-- Pilih --</option><option value="1" {{ old('nilai') == '1' ? 'selected="selected"' : '' }}>BAIK</option><option value="2" {{ old('nilai') == '2' ? 'selected="selected"' : '' }}>CUKUP</option><option value="3" {{ old('nilai') == '3' ? 'selected="selected"' : '' }}>KURANG</option></select>@if($errors->has('nilai'))<span class="help-block"><strong>{{ $errors->first('nilai')}}</strong></span>@endif';
        numE++;
    }

    function delKomputer(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
                numE--;
            }
        }
        }catch(e) {
            alert(e);
        }
    }
  </script>

  <script language="javascript">
    var numF=1;
    function addPenyakit(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;

        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';

        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<input type="text" name="nama_penyakit['+numF+']" class="form-control" placeholder="Nama Penyakit"@if(isset($data['nama_penyakit']))value="{{  $data['nama_penyakit']->bahasa }}"@endif>@if($errors->has('nama_penyakit'))<span class="help-block"><strong>{{ $errors->first('nama_penyakit')}}</strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<textarea type="text" name="keterangan['+numF+']" class="form-control" placeholder="Keterangan" rows="2" cols="40"></textarea>@if($errors->has('keterangan'))<span class="help-block"><strong>{{ $errors->first('keterangan')}}</strong></span>@endif';
        numF++;
    }

    function delPenyakit(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
                numF--;
            }
        }
        }catch(e) {
            alert(e);
        }
    }
  </script>


@stop
