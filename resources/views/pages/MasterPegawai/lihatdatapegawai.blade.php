@extends('layouts.master')

@section('title')
  <title>Lihat Data Pegawai</title>
  <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
  <style>
  .datepicker{z-index:1151 !important;}
  </style>
@stop

@section('breadcrumb')
  <h1>
    Lihat Data Pegawai
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ url('masterpegawai')}}"> Master Pegawai</a></li>
    <li class="active">Data Pegawai</li>
  </ol>
@stop

@section('content')

  {{-- modal delete keluarga --}}
  <div class="modal modal-default fade" id="hapuskeluarga" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Data Keluarga</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus data keluarga ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="#" class="btn btn-primary" id="setkeluarga">Ya, saya yakin.</a>
        </div>
      </div>
    </div>
  </div>

  {{-- modal delete pendidikan --}}
  <div class="modal modal-default fade" id="hapuspendidikan" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Data Pendidikan</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus data pendidikan ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="#" class="btn btn-primary" id="setpendidikan">Ya, saya yakin.</a>
        </div>
      </div>
    </div>
  </div>

  {{-- modal delete pengalaman --}}
  <div class="modal modal-default fade" id="hapuspengalaman" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Data Pengalaman</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus data pengalaman ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="#" class="btn btn-primary" id="setpengalaman">Ya, saya yakin.</a>
        </div>
      </div>
    </div>
  </div>

  {{-- modal delete komputer --}}
  <div class="modal modal-default fade" id="hapuskomputer" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Data Keahlian Komputer</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus data keahlian komputer ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="#" class="btn btn-primary" id="setkomputer">Ya, saya yakin.</a>
        </div>
      </div>
    </div>
  </div>

  {{-- modal delete bahasa --}}
  <div class="modal modal-default fade" id="hapusbahasa" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Data Bahasa Asing</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus data bahasa asing ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="#" class="btn btn-primary" id="setbahasa">Ya, saya yakin.</a>
        </div>
      </div>
    </div>
  </div>

  {{-- modal delete kesehatan --}}
  <div class="modal modal-default fade" id="hapuskesehatan" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Data Kondisi Kesehatan</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus data kondisi kesehatan ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="#" class="btn btn-primary" id="setkesehatan">Ya, saya yakin.</a>
        </div>
      </div>
    </div>
  </div>

  {{-- modal delete penyakit --}}
  <div class="modal modal-default fade" id="hapuspenyakit" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Data Riwayat Penyakit</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus data riwayat penyakit ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="#" class="btn btn-primary" id="setpenyakit">Ya, saya yakin.</a>
        </div>
      </div>
    </div>
  </div>

  {{-- modal tambah keluarga --}}
  <div class="modal modal-default fade" id="modalkeluarga" role="dialog">
    <div class="modal-dialog" style="width:1000px;">
      <!-- Modal content-->
      <form action="{{url('addkeluarga')}}" method="post">
        {!! csrf_field() !!}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data Keluarga</h4>
          </div>
          <div class="modal-body">
            <table class="table" id="dKeluarga">
              <tbody>
                <tr>
                  <th>Nama</th>
                  <th>Hubungan</th>
                  <th width="200px;">Tanggal Lahir</th>
                  <th>Pekerjaan</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                </tr>
                <tr>
                  <td>
                    <input class="form-control" type="hidden" name="id_pegawai" value="<?php
                      foreach ($DataPegawai as $k) {
                        echo $k->id;
                      }
                    ?>">
                    <input class="form-control" type="hidden" name="nip" value="<?php
                      foreach ($DataPegawai as $k) {
                        echo $k->nip;
                      }
                    ?>">
                    <input class="form-control" type="text" name="nama_keluarga" placeholder="Nama" required>
                  </td>
                  <td>
                    <select class="form-control" name="hubungan_keluarga">
                      <option>-- Pilih --</option>
                      <option value="AYAH">AYAH</option>
                      <option value="IBU">IBU</option>
                      <option value="KAKAK">KAKAK</option>
                      <option value="ADIK">ADIK</option>
                      <option value="LAINNYA">LAINNYA</option>
                    </select>
                  </td>
                  <td>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tanggal_lahir_keluarga" class="form-control tanggal_lahir_keluarga" required>
                    </div>
                  </td>
                  <td>
                    <select class="form-control" name="pekerjaan_keluarga">
                      <option>-- Pilih --</option>
                      <option value="PEGAWAI NEGERI">PEGAWAI NEGERI</option>
                      <option value="PEGAWAI SWASTA">PEGAWAI SWASTA</option>
                      <option value="WIRAUSAHA">WIRAUSAHA</option>
                      <option value="RUMAH TANGGA">RUMAH TANGGA</option>
                      <option value="MAHASISWA">MAHASISWA</option>
                      <option value="PELAJAR">PELAJAR</option>
                      <option value="LAINNYA">LAINNYA</option>
                    </select>
                  </td>
                  <td>
                    <label>
                      <input type="radio" name="jenis_kelamin_keluarga" class="minimal" value="L">
                    </label>&nbsp;&nbsp;
                    {{-- &nbsp; --}}
                    <label>Pria</label>
                    <br>
                    <label>
                      <input type="radio" name="jenis_kelamin_keluarga" class="minimal" value="P">
                    </label>&nbsp;&nbsp;
                    {{-- &nbsp; --}}
                    <label>Wanita</label>
                  </td>
                  <td>
                    <textarea name="alamat_keluarga" rows="3" class="form-control"></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
    </form>
    </div>
  </div>

  {{-- modal tambah pendidikan --}}
  <div class="modal modal-default fade" id="modalpendidikan" role="dialog">
    <div class="modal-dialog" style="width:1000px;">
      <!-- Modal content-->
      <form action="{{url('addpendidikan')}}" method="post">
        {!! csrf_field() !!}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data Pendidikan</h4>
          </div>
          <div class="modal-body">
            <table class="table" id="dKeluarga">
              <tbody>
                <tr>
                  <th>Jenjang</th>
                  <th>Institusi</th>
                  <th>Tahun Masuk</th>
                  <th>Tahun Lulus</th>
                  <th>Gelar</th>
                </tr>
                <tr>
                  <td>
                    <input class="form-control" type="hidden" name="id_pegawai" value="<?php
                      foreach ($DataPegawai as $k) {
                        echo $k->id;
                      }
                    ?>">
                    <input class="form-control" type="hidden" name="nip" value="<?php
                      foreach ($DataPegawai as $k) {
                        echo $k->nip;
                      }
                    ?>">
                    <select class="form-control" name="jenjang_pendidikan">
                      <option>-- Pilih --</option>
                      <option value="PELATIHAN KEAHLIAN">PELATIHAN KEAHLIAN</option>
                      <option value="S2">S2 Magister</option>
                      <option value="S1">S1 Strata</option>
                      <option value="D3">D3 Akademik</option>
                      <option value="SMU">SMU</option>
                      <option value="SMP">SMP</option>
                      <option value="SD">SD</option>
                      <option value="LAINNYA">LAINNYA</option>
                    </select>
                  </td>
                  <td>
                    <input type="text" name="institusi_pendidikan" class="form-control">
                  </td>
                  <td>
                    <input type="text" name="tahun_masuk_pendidikan" class="form-control">
                  </td>
                  <td>
                    <input type="text" name="tahun_lulus_pendidikan" class="form-control">
                  </td>
                  <td>
                    <input type="text" name="gelar_akademik" class="form-control">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
    </form>
    </div>
  </div>

  <div class="row">
    <script>
      window.setTimeout(function() {
        $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
      }, 2000);
    </script>

    <div class="col-md-12">
      @if(Session::has('message'))
        <div class="alert alert-success">
          <h4>Berhasil!</h4>
          <p>{{ Session::get('message') }}</p>
        </div>
      @endif
    </div>

    <div class="col-md-4">
      <!-- Data Pegawai -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          @foreach($DataPegawai as $pegawai)
          <img class="profile-user-img img-responsive img-circle" src="{{ asset('dist/img/user2-160x160.jpg')}}" alt="User profile picture">
          <h3 class="profile-username text-center">{{ $pegawai->nama}}</h3>
          <p class="text-muted text-center">{{ $pegawai->status_kontrak}} | {{ $pegawai->id_jabatan}}</p>

          <table class="table table-condensed">
            <tbody>
              <tr>
                <td>NIP</td>
                <td>:</td>
                <td><b>{{ $pegawai->nip}}</b></td>
              </tr>
              <tr>
                <td>NIP Lama</td>
                <td>:</td>
                <td><b>{{ $pegawai->nip_lama}}</b></td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><b>{{ $pegawai->tanggal_lahir}}</b></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><b>@if($pegawai->jenis_kelamin == 'L')
                 Pria
               @else
                 Wanita
               @endif</b></td>
              </tr>
              <tr>
                <td>E-mail</td>
                <td>:</td>
                <td><b>{{ $pegawai->email}}</b></td>
              </tr>
              <tr>
                <td>Agama</td>
                <td>:</td>
                <td><b>{{ $pegawai->agama}}</b></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><b>{{ $pegawai->alamat}}</b></td>
              </tr>
              <tr>
                <td>No Telp</td>
                <td>:</td>
                <td><b>{{ $pegawai->no_telp}}</b></td>
              </tr>
              <tr>
                <td>No KTP</td>
                <td>:</td>
                <td><b>{{ $pegawai->no_ktp}}</b></td>
              </tr>
              <tr>
                <td>No KK</td>
                <td>:</td>
                <td><b>{{ $pegawai->no_kk}}</b></td>
              </tr>
              <tr>
                <td>No NPWP</td>
                <td>:</td>
                <td><b>{{ $pegawai->no_npwp}}</b></td>
              </tr>
              <tr>
                <td>BPJS Ketenagakerjaan</td>
                <td>:</td>
                <td><b>{{ $pegawai->bpjs_ketenagakerjaan}}</b></td>
              </tr>
              <tr>
                <td>BPJS Kesehatan</td>
                <td>:</td>
                <td><b>{{ $pegawai->bpjs_kesehatan}}</b></td>
              </tr>
              <tr>
                <td>No Rekening</td>
                <td>:</td>
                <td><b>{{ $pegawai->no_rekening}}</b></td>
              </tr>
              <tr>
                <td>kewarganegaraan</td>
                <td>:</td>
                <td><b>{{ $pegawai->kewarganegaraan}}</b></td>
              </tr>
            </tbody>
          </table>
          @endforeach
        </div><!-- /.box-body -->
      </div>
      <!-- End Data Pegawai -->
    </div>
    <!-- End Row 3 -->
    <div class="col-md-8">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tabKeluarga" data-toggle="tab">Primary</a></li>
          <li><a href="#dPengalaman" data-toggle="tab">Secondary</a></li>
          <li><a href="#dKesehatan" data-toggle="tab">Kesehatan</a></li>
          <li><a href="#dPendukung" data-toggle="tab">Data Pendukung</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="tabKeluarga">
            <h3>Data Keluarga</h3>
            <button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalkeluarga"><i class="fa fa-plus"></i> Tambah Data Keluarga</button>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Nama</th>
                  <th>Hubungan</th>
                  <th>Tanggal Lahir</th>
                  <th>Pekerjaan</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
                @foreach($DataKeluarga as $keluarga)
                <tr>
                  <td>{{ $keluarga->nama_keluarga }}</td>
                  <td>{{ $keluarga->hubungan_keluarga }}</td>
                  <td>{{ $keluarga->tanggal_lahir_keluarga }}</td>
                  <td>{{ $keluarga->pekerjaan_keluarga }}</td>
                  <td>@if($keluarga->jenis_kelamin_keluarga == 'L')
                    Pria
                  @else
                    Wanita
                  @endif</td>
                  <td>{{ $keluarga->alamat_keluarga }}</td>
                  <td>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-xs btn-danger hapuskeluarga" data-toggle="modal" data-target="#hapuskeluarga" data-value="{{$keluarga->id}}"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <h3>Pendidikan</h3>
            <button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalpendidikan"><i class="fa fa-plus"></i> Tambah Data Pendidikan</button>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Jenjang</th>
                  <th>Institusi</th>
                  <th>Tahun Masuk</th>
                  <th>Tahun Lulus</th>
                  <th>Gelar</th>
                  <th>Aksi</th>
                </tr>
                @foreach($DataPendidikan as $pendidikan)
                <tr>
                  <td>{{ $pendidikan->jenjang_pendidikan }}</td>
                  <td>{{ $pendidikan->institusi_pendidikan }}</td>
                  <td>{{ $pendidikan->tahun_masuk_pendidikan }}</td>
                  <td>{{ $pendidikan->tahun_lulus_pendidikan }}</td>
                  <td>{{ $pendidikan->gelar_akademik }}</td>
                  <td>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-xs btn-danger hapuspendidikan" data-toggle="modal" data-target="#hapuspendidikan" data-value="{{$pendidikan->id}}"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div><!-- /.End Keluarga -->
          <div class="tab-pane" id="dPengalaman">
            <h3>Pengalaman Kerja</h3>
            <button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalpengalaman"><i class="fa fa-plus"></i> Tambah Data Pengalaman Kerja</button>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Nama Perusahaan</th>
                  <th>Posisi</th>
                  <th>Tahun Awal Kerja</th>
                  <th>Tahun Akhir Kerja</th>
                  <th>Aksi</th>
                </tr>
                @foreach($DataPengalaman as $pengalaman)
                <tr>
                  <td>{{ $pengalaman->nama_perusahaan }}</td>
                  <td>{{ $pengalaman->posisi_perusahaan }}</td>
                  <td>{{ $pengalaman->tahun_awal_kerja }}</td>
                  <td>{{ $pengalaman->tahun_akhir_kerja }}</td>
                  <td>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-xs btn-danger hapuspengalaman" data-toggle="modal" data-target="#hapuspengalaman" data-value="{{$pengalaman->id}}"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <h3>Keahlian Komputer</h3>
            <button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalkomputer"><i class="fa fa-plus"></i> Tambah Data Keahlian Komputer</button>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Nama Program</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
                @foreach($DataKomputer as $komputer)
                <tr>
                  <td>{{ $komputer->nama_program }}</td>
                  <td>@if($komputer->nilai_komputer == '1')
                    Baik
                  @elseif($komputer->nilai_komputer == '2')
                    Cukup
                  @else
                    Kurang
                  @endif</td>
                  <td>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-xs btn-danger hapuskomputer" data-toggle="modal" data-target="#hapuskomputer" data-value="{{$komputer->id}}"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <h3>Bahasa Asing</h3>
            <button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalbahasa"><i class="fa fa-plus"></i> Tambah Data Bahasa Asing</button>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Bahasa</th>
                  <th>Berbicara</th>
                  <th>Menulis</th>
                  <th>Mengerti</th>
                  <th>Aksi</th>
                </tr>
                @foreach($DataBahasa as $bahasa)
                <tr>
                  <td>{{ $bahasa->bahasa }}</td>
                  <td>@if($bahasa->berbicara == '1')
                    Baik
                  @elseif($bahasa->berbicara == '2')
                    Cukup
                  @else
                    Kurang
                  @endif</td>
                  <td>@if($bahasa->menulis == '1')
                    Baik
                  @elseif($bahasa->menulis == '2')
                    Cukup
                  @else
                    Kurang
                  @endif</td>
                  <td>@if($bahasa->mengerti == '1')
                    Baik
                  @elseif($bahasa->mengerti == '2')
                    Cukup
                  @else
                    Kurang
                  @endif</td>
                  <td>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-xs btn-danger hapusbahasa" data-toggle="modal" data-target="#hapusbahasa" data-value="{{$bahasa->id}}"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- /.End Pengalaman -->

          <div class="tab-pane" id="dKesehatan">
            <h3>Kondisi Kesehatan</h3>
            <button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalkesehatan"><i class="fa fa-plus"></i> Tambah Data Kesehatan</button>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Tinggi Badan</th>
                  <th>Berat Badan</th>
                  <th>Warna Rambut</th>
                  <th>Warna Mata</th>
                  <th>Berkacamata</th>
                  <th>Merokok</th>
                  <th>Aksi</th>
                </tr>
                @foreach($DataKesehatan as $kesehatan)
                <tr>
                  <td>{{ $kesehatan->tinggi_badan }} CM</td>
                  <td>{{ $kesehatan->berat_badan }} KG</td>
                  <td>{{ $kesehatan->warna_rambut }}</td>
                  <td>{{ $kesehatan->warna_mata }}</td>
                  <td>@if($kesehatan->berkacamata == '0')
                    Tidak
                  @else
                    Ya
                  @endif</td>
                  <td>@if($kesehatan->merokok == '0')
                    Tidak
                  @else
                    Ya
                  @endif</td>
                  <td>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-xs btn-danger hapuskesehatan" data-toggle="modal" data-target="#hapuskesehatan" data-value="{{$kesehatan->id}}"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <h3>Riwayat Penyakit</h3>
            <button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalpenyakit"><i class="fa fa-plus"></i> Tambah Data Riwayat Penyakit</button>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Nama Penyakit</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
                @foreach($DataPenyakit as $penyakit)
                <tr>
                  <td>{{ $penyakit->nama_penyakit }}</td>
                  <td>{{ $penyakit->keterangan_penyakit }}</td>
                  <td>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-xs btn-danger hapuspenyakit" data-toggle="modal" data-target="#hapuspenyakit" data-value="{{$penyakit->id}}"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- /.End Kesehatan -->

          <div class="tab-pane" id="dPendukung">
            Ini Untuk Menampilkan File Yang DiUpload (Ijazah, KTP, KK, Foto)
          </div><!-- /.End Kesehatan -->

        </div><!-- /.tab-content -->
      </div><!-- /.nav-tabs-custom -->
    </div>
  </div>


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

      $('.tanggal_lahir_keluarga').datepicker({
        format: 'yyyy/mm/dd'
      });

      $('a.hapuskeluarga').click(function(){
        var a = $(this).data('value');
        $('#setkeluarga').attr('href', "{{ url('/') }}/masterpegawai/hapuskeluarga/"+a);
      });

      $('a.hapuspendidikan').click(function(){
        var a = $(this).data('value');
        $('#setpendidikan').attr('href', "{{ url('/') }}/masterpegawai/hapuspendidikan/"+a);
      });
    });
  </script>
@stop
