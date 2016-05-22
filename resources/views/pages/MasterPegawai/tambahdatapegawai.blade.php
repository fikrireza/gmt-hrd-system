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
                  <label class="col-sm-3 control-label">NIP</label>
                  <div class="col-sm-9">
                  {!! Form::text('nip', null, ['class'=>'form-control', 'placeholder'=>'NIP']) !!}
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
                    {!! Form::text('nip_lama', null, ['class'=>'form-control', 'placeholder'=>'NIP Lama']) !!}
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
                    {!! Form::text('nama', null, ['class'=>'form-control', 'placeholder'=>'Nama Pegawai']) !!}
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
                    {!! Form::textarea('alamat', null, ['class'=>'form-control', 'placeholder'=>'Alamat', 'size' => '2x2']) !!}
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
                      {!! Form::text('tanggal_lahir', null, ['class'=>'form-control', 'placeholder'=>'yyyy-mm-dd', 'id' => 'tanggal_lahir', 'data-date-format' => 'yyyy-mm-dd']) !!}
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
                    {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
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
                        <input type="radio" name="jenis_kelamin" class="minimal" value="L" {{ old('jk') == 'L' ? 'checked' : '' }}>
                      </label>
                      &nbsp;
                      <label>Pria</label>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <label>
                        <input type="radio" name="jenis_kelamin" class="minimal" value="P" {{ old('jk') == 'P' ? 'checked' : '' }}>
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
                    {!! Form::select('agama', array('Islam' => 'Islam',
                                                    'Kristen' => 'Kristen',
                                                    'Hindu' => 'Hindu',
                                                    'Budha' => 'Budha',
                                                    'Lainnya' => 'Lainnya'),
                                      null, ['class' => 'form-control', 'placeholder' => '-- Pilih Agama --']) !!}
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
                    {{-- <select class="form-control" name="jabatan">
                      <option value="" disabled selected>-- Pilih Jabatan --</option>
                      @foreach($getjabatan as $key)
                        <option value="{{ $key->id }}" {{ old('jabatan') == $key->id ? 'selected="selected"' : '' }}>{{ $key->kode_jabatan }} - {{ $key->nama_jabatan }}</option>
                      @endforeach
                    </select> --}}
                    {!! Form::select('jabatan', $getjabatan, null, ['class' => 'form-control','placeholder' => '-- Pilih Jabatan --']) !!}
                    @if($errors->has('jabatan'))
                      <span class="help-block">
                        <strong>{{ $errors->first('jabatan')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
                {{-- <div class="form-group {{ $errors->has('status_karyawan') ? 'has-error' : '' }}">
                  <label class="col-sm-3 control-label">Status</label>
                  <div class="col-sm-9">
                    {!! Form::select('status_karyawan', array('Kontrak' => 'Kontrak',
                                                    'Freelance' => 'Freelance',
                                                    'Tetap' => 'Tetap'),
                                      null, ['class' => 'form-control', 'placeholder' => '-- Pilih Status Karyawan --']) !!}
                    @if($errors->has('status_karyawan'))
                      <span class="help-block">
                        <strong>{{ $errors->first('status_karyawan')}}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div> --}}
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
                  {!! Form::text('no_ktp', null, ['class'=>'form-control', 'maxlength' => '16', 'placeholder'=>'Nomor KTP']) !!}
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
                  {!! Form::text('no_kk', null, ['class'=>'form-control', 'maxlength' => '16', 'placeholder'=>'Nomor Kartu Keluarga']) !!}
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
                  {!! Form::text('no_npwp', null, ['class'=>'form-control', 'maxlength' => '16', 'placeholder'=>'Nomor NPWP']) !!}
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
                  {!! Form::text('no_telp', null, ['class'=>'form-control', 'maxlength' => '15', 'placeholder'=>'Nomor Telepon']) !!}
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
                  {!! Form::text('no_rekening', null, ['class'=>'form-control', 'maxlength' => '16', 'placeholder'=>'Nomor Rekening']) !!}
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
                  {!! Form::text('bpjs_kesehatan', null, ['class'=>'form-control', 'maxlength' => '16', 'placeholder'=>'BPJS Kesehatan']) !!}
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
                  {!! Form::text('bpjs_ketenagakerjaan', null, ['class'=>'form-control', 'maxlength' => '16', 'placeholder'=>'BPJS Ketenagakerjaan']) !!}
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
                  {!! Form::select('status_pajak', array('Wajib Pajak' => 'Wajib Pajak',
                                                  'Tidak Wajib Pajak' => 'Tidak Wajib Pajak'),
                                    null, ['class' => 'form-control', 'placeholder' => '-- Pilih Wajib Pajak --']) !!}
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
                  {!! Form::select('kewarganegaraan', array('WNI' => 'WNI',
                                                  'WNA' => 'WNA'),
                                    null, ['class' => 'form-control', 'placeholder' => '-- Pilih Wajib Pajak --']) !!}
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
              <li id="tab_keluarga" class="active"><a href="#tab_Keluarga" data-toggle="tab">Data Keluarga</a></li>
              <li id="tab_pengalaman"><a href="#tab_Pengalaman" data-toggle="tab">Pengalaman Kerja</a></li>
              <li id="tab_kesehatan"><a href="#tab_Kesehatan" data-toggle="tab">Kondisi Kesehatan</a></li>
              <li id="tab_pendidikan"><a href="#tab_Pendidikan" data-toggle="tab">Pendidikan</a></li>
              <li id="tab_bahasa"><a href="#tab_Bahasa" data-toggle="tab">Bahasa Asing</a></li>
              <li id="tab_komputer"><a href="#tab_Komputer" data-toggle="tab">Keahlian Komputer</a></li>
              <li id="tab_penyakit"><a href="#tab_Penyakit" data-toggle="tab">Riwayat Penyakit</a></li>
            </ul>
            {{-- START Data Keluarga --}}
            <div class="tab-content">
              <div class="tab-pane active" id="tab_Keluarga">
                <div class="box-body">
                  <table class="table" id="dKeluarga">
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
                            {!! Form::text('data_keluarga[0][nama_keluarga]', null ,['class'=>'form-control', 'placeholder'=>'Nama Keluarga']) !!}
                          </div>
                        </td>
                        <td>
                          <div class="{{ $errors->has('hubungan_keluarga') ? 'has-error' : '' }}">
                            {!! Form::select('data_keluarga[0][hubungan_keluarga]', array('AYAH' => 'AYAH',
                                                            'IBU' => 'IBU',
                                                            'KAKAK' => 'KAKAK',
                                                            'ADIK' => 'ADIK',
                                                            'LAINNYA' => 'LAINNYA'),
                                              null, ['class' => 'form-control', 'placeholder' => '-- Pilih --']) !!}
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
                              {!! Form::text('data_keluarga[0][tanggal_lahir_keluarga]', null, ['class'=>'form-control', 'data-date-format'=>'yyyy-mm-dd', 'placeholder'=>'yyyy-mm-dd', 'id'=>'tanggal_lahir_keluarga']) !!}
                            </div>
                            @if($errors->has('tanggal_lahir_keluarga'))
                              <span class="help-block">
                                <strong><h6>{{ $errors->first('tanggal_lahir_keluarga')}}</h6></strong>
                              </span>
                            @endif
                          </div>
                        </td>
                        <td>
                          {!! Form::select('data_keluarga[0][pekerjaan_keluarga]', array('PEGAWAINEGERI' => 'PEGAWAINEGERI',
                                                          'PEGAWAISWASTA' => 'PEGAWAISWASTA',
                                                          'WIRASAWASTA' => 'WIRASAWASTA',
                                                          'RUMAH TANGGA' => 'RUMAH TANGGA',
                                                          'MAHASISWA' => 'MAHASISWA',
                                                          'PELAJAR' => 'PELAJAR',
                                                          'LAINNYA' => 'LAINNYA'),
                                            null, ['class' => 'form-control', 'placeholder' => '-- Pilih --']) !!}
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
                              <input type="radio" name="data_keluarga[0][jenis_kelamin_keluarga]" class="minimal" value="L" {{ old('jenis_kelamin_keluarga') == 'L' ? 'checked' : '' }}>
                            </label>
                            {{-- &nbsp; --}}
                            <label>Pria</label>
                            &nbsp;&nbsp;&nbsp;
                            <label>
                              <input type="radio" name="data_keluarga[0][jenis_kelamin_keluarga]" class="minimal" value="P" {{ old('jenis_kelamin_keluarga') == 'P' ? 'checked' : '' }}>
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
                          {!! Form::textarea('data_keluarga[0][alamat_keluarga]', null, ['class'=>'form-control', 'placeholder'=>'Alamat', 'size' => '2x2']) !!}
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
                <div class="box-footer clearfix">
                  <div class="col-md-6">
                    <label class="btn btn-round bg-green" onclick="addKeluarga('dKeluarga')">Tambah Anggota</label>&nbsp;<label class="btn btn-round bg-red" onclick="delKeluarga('dKeluarga')">Hapus Anggota</label>
                  </div>
                  <div class="col-md-6">
                    <a href="#tab_Pengalaman" data-toggle="tab" id="btn_ke_pengalaman"><label class="btn btn-round bg-blue pull-right">Selanjutnya</label></a>
                  </div>
                </div>
              </div>
              {{-- END Data Keluarga --}}

              {{-- START Pengalaman Kerja--}}
              <div class="tab-pane" id="tab_Pengalaman">
                <div class="box-body">
                  <table class="table" id="dPengalaman">
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
                            {!! Form::text('pengalaman[0][nama_perusahaan]', null ,['class'=>'form-control', 'placeholder'=>'Nama Perusahaan']) !!}
                              @if($errors->has('nama_perusahaan'))
                                <span class="help-block">
                                  <strong><h6>{{ $errors->first('nama_perusahaan')}}</h6></strong>
                                </span>
                              @endif
                          </div>
                        </td>
                        <td>
                          <div class="{{ $errors->has('posisi') ? 'has-error' : '' }}">
                            {!! Form::text('pengalaman[0][posisi]', null ,['class'=>'form-control', 'placeholder'=>'Posisi']) !!}
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
                              {!! Form::text('pengalaman[0][tahun_awal_kerja]', null, ['class'=>'form-control', 'data-date-format'=>'yyyy-mm-dd', 'placeholder'=>'yyyy-mm-dd', 'id'=>'tahun_awal_kerja']) !!}
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
                              {!! Form::text('pengalaman[0][tahun_akhir_kerja]', null, ['class'=>'form-control', 'data-date-format'=>'yyyy-mm-dd', 'placeholder'=>'yyyy-mm-dd', 'id'=>'tahun_akhir_kerja']) !!}
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
                <div class="box-footer clearfix">
                  <div class="col-md-6">
                    <label class="btn btn-round bg-green" onclick="addPengalaman('dPengalaman')">Tambah Pengalaman</label>&nbsp;
                    <label class="btn btn-round bg-red" onclick="delPengalaman('dPengalaman')">Hapus Pengalaman</label>
                  </div>
                  <div class="col-md-6">
                    <a href="#tab_Kesehatan" data-toggle="tab" id="btn_ke_kesehatan"><label class="btn btn-round bg-blue pull-right">Selanjutnya</label></a>
                  </div>
                </div>
              </div>
              {{-- END Pengalaman Kerja--}}
              {{-- START Kesehatan --}}
              <div class="tab-pane" id="tab_Kesehatan">
                <div class="box-body">
                  <div class="form-group {{ $errors->has('tinggi_badan') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Tinggi Badan</label>
                    <div class="col-sm-6">
                      {!! Form::text('tinggi_badan', null, ['class'=>'form-control', 'placeholder'=>'Tinggi Badan', 'onkeyup'=>'validAngka(this)']) !!}
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('berat_badan') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Berat Badan</label>
                    <div class="col-sm-6">
                      {!! Form::text('berat_badan', null, ['class'=>'form-control', 'placeholder'=>'Berat Badan', 'onkeyup'=>'validAngka(this)']) !!}
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('warna_rambut') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Warna Rambut</label>
                    <div class="col-sm-6">
                      {!! Form::text('warna_rambut', null, ['class'=>'form-control', 'placeholder'=>'Warna Rambut']) !!}
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('warna_mata') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Warna Mata</label>
                      <div class="col-sm-6">
                        {!! Form::text('warna_mata', null, ['class'=>'form-control', 'placeholder'=>'Warna Mata']) !!}
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('berkacamata') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">Berkacamata</label>
                    <div class="col-sm-6">
                      <div class="form-group">
                        &nbsp;&nbsp;&nbsp;
                        <label>
                          <input type="radio" name="berkacamata" class="minimal" value="Ya" {{ old('berkacamata') == 'L' ? 'checked' : '' }}>
                        </label>
                        &nbsp;
                        <label>Ya</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                          <input type="radio" name="berkacamata" class="minimal" value="Tidak" {{ old('berkacamata') == 'P' ? 'checked' : '' }}>
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
                      @if($errors->has('merokok'))
                        <span class="help-block">
                          <strong>{{ $errors->first('merokok')}}
                          </strong>
                        </span>
                      @endif
                    </div>
                  </div>
              </div>
              <div class="box-footer clearfix">
                <div class="col-md-6 pull-right">
                  <a href="#tab_Pendidikan" data-toggle="tab" id="btn_ke_pendidikan"><label class="btn btn-round bg-blue pull-right">Selanjutnya</label></a>
                </div>
              </div>
            </div>
            {{-- END TAB 2 --}}
            {{-- START TAB 3 --}}
            <div class="tab-pane" id="tab_Pendidikan">
              <div class="box-body">
                <table class="table table-hover" id="dPendidikan">
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
                        <select class="form-control" name="pendidikan[0][jenjang_pendidikan]" >
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
                        <input type="text" name="pendidikan[0][institusi_pendidikan]" class="form-control uppercase" placeholder="Institusi Pendidikan" >
                        @if($errors->has('institusi_pendidikan'))
                          <span class="help-block">
                            <strong>{{ $errors->first('institusi_pendidikan')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <input type="text" name="pendidikan[0][tahun_masuk_pendidikan]" class="form-control" placeholder="Tahun Masuk" maxlength="4" onkeyup="validAngka(this)" >
                        @if($errors->has('tahun_masuk'))
                          <span class="help-block">
                            <strong>{{ $errors->first('tahun_masuk')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <input type="text" name="pendidikan[0][tahun_lulus_pendidikan]" class="form-control" placeholder="Tahun Lulus" maxlength="4" onkeyup="validAngka(this)" >
                        @if($errors->has('tahun_lulus'))
                          <span class="help-block">
                            <strong>{{ $errors->first('tahun_lulus')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <input type="text" name="pendidikan[0][gelar_akademik]" class="form-control" placeholder="Gelar Kelulusan" maxlength="10" >
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="box-footer clearfix">
                <div class="col-md-6">
                  <label class="btn btn-round bg-green" onclick="addPendidikan('dPendidikan')">Tambah Pendidikan</label>&nbsp;
                  <label class="btn btn-round bg-red" onclick="delPendidikan('dPendidikan')">Hapus Pendidikan</label>
                </div>
                <div class="col-md-6 pull-right">
                  <a href="#tab_Bahasa" data-toggle="tab" id="btn_ke_bahasa"><label class="btn btn-round bg-blue pull-right">Selanjutnya</label></a>
                </div>
              </div>
            </div>
            {{-- END TAB 3 --}}
            {{-- START TAB 4 --}}
            <div class="tab-pane" id="tab_Bahasa">
              <div class="box-body">
                <table class="table table-hover" id="dBahasa">
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
                        {!! Form::text('bahasa[0][bahasa]', null, ['class'=>'form-control', 'placeholder'=>'Bahasa']) !!}
                        @if($errors->has('bahasa'))
                          <span class="help-block">
                            <strong>{{ $errors->first('bahasa')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <select class="form-control" name="bahasa[0][berbicara]" >
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
                        <select class="form-control" name="bahasa[0][menulis]" >
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
                        <select class="form-control" name="bahasa[0][mengerti]" >
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
              <div class="box-footer clearfix">
                <div class="col-md-6">
                  <label class="btn btn-round bg-green" onclick="addBahasa('dBahasa')">Tambah Bahasa</label>&nbsp;
                  <label class="btn btn-round bg-red" onclick="delBahasa('dBahasa')">Hapus Bahasa</label>
                </div>
                <div class="col-md-6 pull-right">
                  <a href="#tab_Komputer" data-toggle="tab" id="btn_ke_komputer"><label class="btn btn-round bg-blue pull-right">Selanjutnya</label></a>
                </div>
              </div>
            </div>
            {{-- END Bahasa --}}

            {{-- START Komputer --}}
            <div class="tab-pane" id="tab_Komputer">
              <div class="box-body">
                <table class="table table-hover" id="dKomputer">
                  <tbody>
                    <tr>
                      <th width="20px"></th>
                      <th width="200px">Nama Program</th>
                      <th width="200px">Nilai</th>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk"/></td>
                      <td>
                        {!! Form::text('komputer[0][nama_program]', null, ['class'=>'form-control', 'placeholder'=>'Nama Program']) !!}
                        @if($errors->has('nama_program'))
                          <span class="help-block">
                            <strong>{{ $errors->first('nama_program')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        <select class="form-control" name="komputer[0][nilai]">
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
              <div class="box-footer clearfix">
                <div class="col-md-6">
                  <label class="btn btn-round bg-green" onclick="addKomputer('dKomputer')">Tambah Komputer</label>&nbsp;
                  <label class="btn btn-round bg-red" onclick="delKomputer('dKomputer')">Hapus Komputer</label>
                </div>
                <div class="col-md-6 pull-right">
                  <a href="#tab_Penyakit" data-toggle="tab" id="btn_ke_penyakit"><label class="btn btn-round bg-blue pull-right">Selanjutnya</label></a>
                </div>
              </div>
            </div>
            {{-- End Komputer --}}
            {{-- START Penyakit --}}
            <div class="tab-pane" id="tab_Penyakit">
              <div class="box-body">
                <table class="table table-hover" id="dPenyakit">
                  <thead>

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
                        {!! Form::text('penyakit[0][nama_penyakit]', null, ['class'=>'form-control', 'placeholder'=>'Jenis Penyakit']) !!}
                        @if($errors->has('nama_penyakit'))
                          <span class="help-block">
                            <strong>{{ $errors->first('nama_penyakit')}}
                            </strong>
                          </span>
                        @endif
                      </td>
                      <td>
                        {!! Form::textarea('penyakit[0][keterangan]', null, ['class'=>'form-control', 'placeholder'=>'Jenis Penyakit', 'size' => '2x2']) !!}
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
              <div class="box-footer clearfix">
                <div class="col-md-6">
                  <label class="btn btn-round bg-green" onclick="addPenyakit('dPenyakit')">Tambah Penyakit</label>&nbsp;
                  <label class="btn btn-round bg-red" onclick="delPenyakit('dPenyakit')">Hapus Penyakit</label>
                </div>
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
              </div>
            </div>
            {{-- START TAB 6 --}}
          </div>
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

      $('#btn_ke_pengalaman').click(function(){
        $('li#tab_pengalaman').attr('class','active');
        $('li#tab_keluarga').attr('class','');
      });

      $('#btn_ke_kesehatan').click(function(){
        $('li#tab_kesehatan').attr('class','active');
        $('li#tab_pengalaman').attr('class','');
      });

      $('#btn_ke_pendidikan').click(function(){
        $('li#tab_pendidikan').attr('class','active');
        $('li#tab_kesehatan').attr('class','');
      });

      $('#btn_ke_bahasa').click(function(){
        $('li#tab_bahasa').attr('class','active');
        $('li#tab_pendidikan').attr('class','');
      });

      $('#btn_ke_komputer').click(function(){
        $('li#tab_komputer').attr('class','active');
        $('li#tab_bahasa').attr('class','');
      });

      $('#btn_ke_penyakit').click(function(){
        $('li#tab_penyakit').attr('class','active');
        $('li#tab_komputer').attr('class','');
      });
    });
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

  <script language="javascript">
    var numA=1;
    function addKeluarga(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;

        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';

        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<input type="text" name="data_keluarga['+numA+'][nama_keluarga]" class="form-control" placeholder="Nama Keluarga"@if(!$errors->has('nama_keluarga'))value="{{ old('nama_keluarga') }}"@endif>@if($errors->has('nama_keluarga'))<span class="help-block"><strong><h6>{{ $errors->first('nama_keluarga')}}</h6></strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<select class="form-control" name="data_keluarga['+numA+'][hubungan_keluarga]"><option value="" disabled selected>-- Pilih --</option><option value="AYAH" {{ old('hubungan_keluarga') == 'AYAH' ? 'selected="selected"' : '' }}>AYAH</option><option value="IBU" {{ old('hubungan_keluarga') == 'IBU' ? 'selected="selected"' : '' }}>IBU</option><option value="KAKAK" {{ old('hubungan_keluarga') == 'KAKAK' ? 'selected="selected"' : ''}}>KAKAK</option><option value="ADIK" {{ old('hubungan_keluarga') == 'ADIK' ? 'selected="selected"' : ''}}>ADIK</option><option value="LAINNYA" {{ old('hubungan_keluarga') == 'LAINNYA' ? 'selected="selected"' : ''}}>LAINNYA</option></select>@if($errors->has('hubungan_keluarga'))<span class="help-block"><strong><h6>{{ $errors->first('hubungan_keluarga')}}</h6></strong></span>@endif';

        var cell4 = row.insertCell(3);
        cell4.innerHTML = '<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right" id="tanggal_lahir_keluarga" name="data_keluarga['+numA+'][tanggal_lahir_keluarga]" data-date-format="dd-mm-yyyy"@if(!$errors->has('tanggal_lahir_keluarga'))value="{{ old('tanggal_lahir_keluarga') }}"@endif></div>@if($errors->has('tanggal_lahir_keluarga'))<span class="help-block"><strong><h6>{{ $errors->first('tanggal_lahir_keluarga')}}</h6></strong></span>@endif';

        var cell5 = row.insertCell(4);
        cell5.innerHTML = '<select class="form-control" name="data_keluarga['+numA+'][pekerjaan_keluarga]"><option value="" disabled selected>-- Pilih --</option><option value="PEGAWAINEGERI" {{ old('pekerjaan_keluarga') == 'PEGAWAINEGERI' ? 'selected="selected"' : '' }}>PEGAWAI NEGERI</option><option value="PEGAWAISWASTA" {{ old('pekerjaan_keluarga') == 'PEGAWAISWASTA' ? 'selected="selected"' : '' }}>PEGAWAI SWASTA</option><option value="WIRASAWASTA" {{ old('pekerjaan_keluarga') == 'WIRASAWASTA' ? 'selected="selected"' : '' }}>WIRASAWASTA</option><option value="RUMAH TANGGA" {{ old('pekerjaan_keluarga') == 'RUMAH TANGGA' ? 'selected="selected"' : '' }}>RUMAH TANGGA</option><option value="MAHASISWA" {{ old('pekerjaan_keluarga') == 'MAHASISWA' ? 'selected="selected"' : '' }}>MAHASISWA</option><option value="PELAJAR" {{ old('pekerjaan_keluarga') == 'PELAJAR' ? 'selected="selected"' : '' }}>PELAJAR</option><option value="LAINNYA" {{ old('pekerjaan_keluarga') == 'LAINNYA' ? 'selected="selected"' : '' }}>LAINNYA</option></select>@if($errors->has('pekerjaan_keluarga'))<span class="help-block"><strong>{{ $errors->first('pekerjaan_keluarga')}}</strong></span>@endif';

        var cell6 = row.insertCell(5);
        cell6.innerHTML = '<label><input type="radio" name="data_keluarga['+numA+'][jenis_kelamin_keluarga]" class="minimal" value="L" {{ old('jenis_kelamin_keluarga') == 'L' ? 'checked' : '' }}></label><label>Pria</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="data_keluarga['+numA+'][jenis_kelamin_keluarga]" class="minimal" value="P" {{ old('jenis_kelamin_keluarga') == 'P' ? 'checked' : '' }}></label><label>Wanita</label>@if($errors->has('jenis_kelamin_keluarga'))<span class="help-block"><strong>{{ $errors->first('jenis_kelamin_keluarga')}}</strong></span>@endif';

        var cell7 = row.insertCell(6);
        cell7.innerHTML = '<textarea type="text" name="data_keluarga['+numA+'][alamat_keluarga]" class="form-control uppercase" placeholder="Alamat" rows="2">@if(!$errors->has('alamat_keluarga')){{ old('alamat_keluarga')}}@endif</textarea>@if($errors->has('alamat_keluarga'))<span class="help-block"><strong>{{ $errors->first('alamat_keluarga')}}</strong></span>@endif';
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
        cell2.innerHTML = '<input type="text" name="pengalaman['+numB+'][nama_perusahaan]" class="form-control" placeholder="Nama Perusahaan"@if(!$errors->has('nama_perusahaan'))value="{{ old('nama_perusahaan') }}"@endif>@if($errors->has('nama_perusahaan'))<span class="help-block"><strong><h6>{{ $errors->first('nama_perusahaan')}}</h6></strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<input type="text" name="pengalaman['+numB+'][posisi]" class="form-control" placeholder="Posisi" d="[]"@if(!$errors->has('posisi'))value="{{ old('posisi') }}"@endif>@if($errors->has('posisi'))<span class="help-block"><strong><h6>{{ $errors->first('posisi')}}</h6></strong></span>@endif';

        var cell4 = row.insertCell(3);
        cell4.innerHTML = '<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right" id="tahun_awal_kerja" name="pengalaman['+numB+'][tahun_awal_kerja]" data-date-format="dd-mm-yyyy" @if(!$errors->has('tahun_awal_kerja'))value="{{ old('tahun_awal_kerja') }}"@endif></div>@if($errors->has('tahun_awal_kerja'))<span class="help-block"><strong><h6>{{ $errors->first('tahun_awal_kerja')}}</h6></strong></span>@endif';

        var cell5 = row.insertCell(4);
        cell5.innerHTML = '<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right" id="tahun_akhir_kerja" name="pengalaman['+numB+'][tahun_akhir_kerja]" data-date-format="dd-mm-yyyy" @if(!$errors->has('tahun_akhir_kerja'))value="{{ old('tahun_akhir_kerja') }}"@endif></div>@if($errors->has('tahun_akhir_kerja'))<span class="help-block"><strong><h6>{{ $errors->first('tahun_akhir_kerja')}}</h6></strong></span>@endif';
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
        cell2.innerHTML = '<select class="form-control" name="pendidikan['+numC+'][jenjang_pendidikan]" ><option value="" disabled selected>-- Pilih --</option><option value="PELATIHANKEAHLIAN">PELATIHAN KEAHLIAN</option><option value="S2">S2 Magister</option><option value="S1">S1 Universitas</option><option value="D3">D3 Akademik</option><option value="SMU">SMU</option><option value="SMP">SMP</option><option value="SD">SD</option><option value="LAINNYA">LAINNYA</option></select>@if($errors->has('jenjang_pendidikan'))<span class="help-block"><strong>{{ $errors->first('jenjang_pendidikan')}}</strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<input type="text" name="pendidikan['+numC+'][institusi_pendidikan]" class="form-control uppercase" placeholder="Institusi Pendidikan" >@if($errors->has('institusi_pendidikan'))<span class="help-block"><strong>{{ $errors->first('institusi_pendidikan')}}</strong></span>@endif';

        var cell4 = row.insertCell(3);
        cell4.innerHTML = '<input type="text" name="pendidikan['+numC+'][tahun_masuk_pendidikan]" class="form-control" placeholder="Tahun Masuk" maxlength="4" onkeyup="validAngka(this)" >@if($errors->has('tahun_masuk'))<span class="help-block"><strong>{{ $errors->first('tahun_masuk')}}</strong></span>@endif';

        var cell5 = row.insertCell(4);
        cell5.innerHTML = '<input type="text" name="pendidikan['+numC+'][tahun_lulus_pendidikan]" class="form-control" placeholder="Tahun Lulus" maxlength="4" onkeyup="validAngka(this)" >@if($errors->has('tahun_lulus'))<span class="help-block"><strong>{{ $errors->first('tahun_lulus')}}</strong></span>@endif';

        var cell6 = row.insertCell(5);
        cell6.innerHTML = '<input type="text" name="pendidikan['+numC+'][gelar_akademik]" class="form-control" placeholder="Gelar Kelulusan" maxlength="10" >@if($errors->has('gelar_akademik'))<span class="help-block"><strong>{{ $errors->first('gelar_akademik')}}</strong></span>@endif';
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
        cell2.innerHTML = '<input type="text" name="bahasa['+numD+'][bahasa]" class="form-control uppercase" placeholder="Bahasa" @if(isset($data['bindbahasaasing']))value="{{  $data['bindbahasaasing']->bahasa }}" readonly="true"@endif>@if($errors->has('bahasa'))<span class="help-block"><strong>{{ $errors->first('bahasa')}}</strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<select class="form-control" name="bahasa['+numD+'][berbicara]" ><option value="" disabled selected>-- Pilih --</option><option value="1" {{ old('berbicara') == '1' ? 'selected="selected"' : '' }}>BAIK</option><option value="2" {{ old('berbicara') == '2' ? 'selected="selected"' : '' }}>CUKUP</option><option value="3" {{ old('berbicara') == '3' ? 'selected="selected"' : '' }}>KURANG</option></select>@if($errors->has('berbicara'))<span class="help-block"><strong>{{ $errors->first('berbicara')}}</strong></span>@endif';

        var cell4 = row.insertCell(3);
        cell4.innerHTML = '<select class="form-control" name="bahasa['+numD+'][menulis]" ><option value="" disabled selected>-- Pilih --</option><option value="1" {{ old('menulis') == 'Baik' ? 'selected="selected"' : '' }}>BAIK</option><option value="2" {{ old('menulis') == 'Cukup' ? 'selected="selected"' : '' }}>CUKUP</option><option value="3" {{ old('menulis') == 'Kurang' ? 'selected="selected"' : '' }}>KURANG</option></select>@if($errors->has('menulis'))<span class="help-block"><strong>{{ $errors->first('menulis')}}</strong></span>@endif';

        var cell5 = row.insertCell(4);
        cell5.innerHTML = '<select class="form-control" name="bahasa['+numD+'][mengerti]" ><option value="" disabled selected>-- Pilih --</option><option value="1" {{ old('mengerti') == 'Baik' ? 'selected="selected"' : '' }}>BAIK</option><option value="2" {{ old('mengerti') == 'Cukup' ? 'selected="selected"' : '' }}>CUKUP</option><option value="3" {{ old('mengerti') == 'Kurang' ? 'selected="selected"' : '' }}>KURANG</option></select>@if($errors->has('mengerti'))<span class="help-block"><strong>{{ $errors->first('mengerti')}}</strong></span>@endif';
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
        cell2.innerHTML = '<input type="text" name="komputer['+numE+'][nama_program]" class="form-control" placeholder="Nama Program"@if(isset($data['nama_program']))value="{{  $data['nama_program']->bahasa }}"@endif>@if($errors->has('nama_program'))<span class="help-block"><strong>{{ $errors->first('nama_program')}}</strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<select class="form-control" name="komputer['+numE+'][nilai]"><option value="" disabled selected>-- Pilih --</option><option value="1" {{ old('nilai') == '1' ? 'selected="selected"' : '' }}>BAIK</option><option value="2" {{ old('nilai') == '2' ? 'selected="selected"' : '' }}>CUKUP</option><option value="3" {{ old('nilai') == '3' ? 'selected="selected"' : '' }}>KURANG</option></select>@if($errors->has('nilai'))<span class="help-block"><strong>{{ $errors->first('nilai')}}</strong></span>@endif';
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
        cell2.innerHTML = '<input type="text" name="penyakit['+numF+'][nama_penyakit]" class="form-control" placeholder="Nama Penyakit"@if(isset($data['nama_penyakit']))value="{{  $data['nama_penyakit']->bahasa }}"@endif>@if($errors->has('nama_penyakit'))<span class="help-block"><strong>{{ $errors->first('nama_penyakit')}}</strong></span>@endif';

        var cell3 = row.insertCell(2);
        cell3.innerHTML = '<textarea type="text" name="penyakit['+numF+'][keterangan]" class="form-control" placeholder="Keterangan" rows="2" cols="40"></textarea>@if($errors->has('keterangan'))<span class="help-block"><strong>{{ $errors->first('keterangan')}}</strong></span>@endif';
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
