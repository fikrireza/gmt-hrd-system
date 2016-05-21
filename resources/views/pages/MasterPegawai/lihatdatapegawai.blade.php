@extends('layouts.master')

@section('title')
  <title>Lihat Data Pegawai</title>
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
  <div class="row">
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
          <li class="active"><a href="#dKeluarga" data-toggle="tab">Primary</a></li>
          <li><a href="#dPengalaman" data-toggle="tab">Secondary</a></li>
          <li><a href="#dKesehatan" data-toggle="tab">Kesehatan</a></li>
          <li><a href="#dPendukung" data-toggle="tab">Data Pendukung</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="dKeluarga">
            <h3>Data Keluarga</h3>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Nama</th>
                  <th>Hubungan</th>
                  <th>Tanggal Lahir</th>
                  <th>Pekerjaan</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
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
                </tr>
                @endforeach
              </tbody>
            </table>

            <h3>Pendidikan</h3>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Jenjang</th>
                  <th>Institusi</th>
                  <th>Tahun Masuk</th>
                  <th>Tahun Lulus</th>
                  <th>Gelar</th>
                </tr>
                @foreach($DataPendidikan as $pendidikan)
                <tr>
                  <td>{{ $pendidikan->jenjang_pendidikan }}</td>
                  <td>{{ $pendidikan->institusi_pendidikan }}</td>
                  <td>{{ $pendidikan->tahun_masuk_pendidikan }}</td>
                  <td>{{ $pendidikan->tahun_lulus_pendidikan }}</td>
                  <td>{{ $pendidikan->gelar_akademik }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div><!-- /.End Keluarga -->
          <div class="tab-pane" id="dPengalaman">
            <h3>Pengalaman Kerja</h3>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Nama Perusahaan</th>
                  <th>Posisi</th>
                  <th>Tahun Awal Kerja</th>
                  <th>Tahun Akhir Kerja</th>
                </tr>
                @foreach($DataPengalaman as $pengalaman)
                <tr>
                  <td>{{ $pengalaman->nama_perusahaan }}</td>
                  <td>{{ $pengalaman->posisi_perusahaan }}</td>
                  <td>{{ $pengalaman->tahun_awal_kerja }}</td>
                  <td>{{ $pengalaman->tahun_akhir_kerja }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <h3>Keahlian Komputer</h3>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Nama Program</th>
                  <th>Nilai</th>
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
                </tr>
                @endforeach
              </tbody>
            </table>

            <h3>Bahasa Asing</h3>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Bahasa</th>
                  <th>Berbicara</th>
                  <th>Menulis</th>
                  <th>Mengerti</th>
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
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- /.End Pengalaman -->

          <div class="tab-pane" id="dKesehatan">
            <h3>Kondisi Kesehatan</h3>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Tinggi Badan</th>
                  <th>Berat Badan</th>
                  <th>Warna Rambut</th>
                  <th>Warna Mata</th>
                  <th>Berkacamata</th>
                  <th>Merokok</th>
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
                </tr>
                @endforeach
              </tbody>
            </table>

            <h3>Riwayat Penyakit</h3>
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-navy">
                  <th>Nama Penyakit</th>
                  <th>Keterangan</th>
                </tr>
                @foreach($DataPenyakit as $penyakit)
                <tr>
                  <td>{{ $penyakit->nama_penyakit }}</td>
                  <td>{{ $penyakit->keterangan_penyakit }}</td>
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
@stop
