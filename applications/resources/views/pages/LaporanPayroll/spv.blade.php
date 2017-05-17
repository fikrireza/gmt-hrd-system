<html>

    <table>
      <tr>
        <th colspan="8"><h3>PT. GANDA MADY INDOTAMA - Proses Payroll Periode {{ $getbatch->tanggal_proses}} s/d {{ $getbatch->tanggal_proses_akhir }}</h3></th>
      </tr>
    </table>
    <table style="border-collapse: collapse; border: 1px solid black;">
      <tr>
        <td style="background-color: #000000; color: #ffffff;"><b>No</b></td>
        <td style="background-color: #000000; color: #ffffff;"><b>NIP</b></td>
        <td style="background-color: #000000; color: #ffffff;"><b>NAMA</b></td>
        <td style="background-color: #000000; color: #ffffff;"><b>DAYS</b></td>
        <td style="background-color: #000000; color: #ffffff;"><b>JABATAN</b></td>
        @foreach ($getkomponengaji as $komponenGaji)
        @if($komponenGaji->tipe_komponen == "D")
        <td style="background-color: #2d96ff; color: #ffffff;border: 1px solid black;"><b>{{ $komponenGaji->nama_komponen }}</b></td>
        @endif
        @endforeach
        <td style="background-color: #cccdce;"><b>JUMLAH GAJI</b></td>
        @foreach ($getkomponengaji as $komponenGaji)
        @if($komponenGaji->tipe_komponen == "P")
        <td style="background-color: #c62121; color: #ffffff;border: 1px solid black;"><b>{{ $komponenGaji->nama_komponen }}</b></td>
        @endif
        @endforeach
        <td style="background-color: #cccdce;"><b>TOTAL GAJI</b></td>
      </tr>
    @php
      $no = 1;
      $grandJumlahGaji = 0;
      $grandTotalGaji = 0;
    @endphp
    @foreach($hasilQuery as $key)
    @foreach($getAnak as $karyawan)
    @if($karyawan->id_kelompok_jabatan == $getSPV && $karyawan->id_pegawai == $key->id)
      <tr style="border: 1px solid black;">
        <td style="border: 1px solid black;">{{ $no }}</td>
        <td style="border: 1px solid black;">{{$key->nip }}</td>
        <td style="border: 1px solid black;">{{$key->nama_pegawai }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_Workday }}</td>
        <td style="border: 1px solid black;">{{ $key->Jabatan }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_GAJI_POKOK }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_TUNJANGAN_JABATAN }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_TUNJANGAN_INSENTIF }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_TUNJANGAN_LEMBUR }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_KEKURANGAN_BULAN_LALU }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_TUNJANGAN_TRANSPORT_MAKAN }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_KETUA_REGU }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_PENGEMBALIAN_SERAGAM }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_TUNJANGAN_MAKAN_LEMBUR }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_SALARY }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_SHIFT_PAGI_SIANG }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_TUNJANGAN_MAKAN_TRANSPORT }}</td>
        @php
          $jumlahGajinya = $key->Jumlah_GAJI_POKOK + $key->Jumlah_TUNJANGAN_JABATAN + $key->Jumlah_TUNJANGAN_INSENTIF + $key->Jumlah_TUNJANGAN_LEMBUR + $key->Jumlah_KEKURANGAN_BULAN_LALU + $key->Jumlah_TUNJANGAN_TRANSPORT_MAKAN + $key->Jumlah_KETUA_REGU + $key->Jumlah_PENGEMBALIAN_SERAGAM + $key->Jumlah_TUNJANGAN_MAKAN_LEMBUR + $key->Jumlah_SALARY + $key->Jumlah_SHIFT_PAGI_SIANG + $key->Jumlah_TUNJANGAN_MAKAN_TRANSPORT;

          $grandJumlahGaji += $jumlahGajinya;
        @endphp
        <td style="background-color: #cccdce; border: 1px solid black;">{{ $jumlahGajinya }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_BPJS_KESEHATAN }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_POTONGAN_KAS }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_BPJS_KETENAGAKERJAAN }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_POTONGAN_PINJAMAN }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_POTONGAN_SERAGAM }}</td>
        <td style="border: 1px solid black;">{{$key->Jumlah_POTONGAN_CONSUMABLE }}</td>
        @php
          $jumlahPotongannya = $key->Jumlah_BPJS_KESEHATAN + $key->Jumlah_POTONGAN_KAS + $key->Jumlah_BPJS_KETENAGAKERJAAN + $key->Jumlah_POTONGAN_PINJAMAN + $key->Jumlah_POTONGAN_SERAGAM + $key->Jumlah_POTONGAN_CONSUMABLE;
          $no++;
          $grandTotalGaji += $jumlahGajinya - $jumlahPotongannya;
        @endphp
        <td style="background-color: #cccdce; border: 1px solid black;">{{ $jumlahGajinya - $jumlahPotongannya}}</td>
      </tr>
    @endif
    @endforeach
    @endforeach
      {{-- <tr style="background-color: #cccdce;">
        <td colspan="2" style="border: 1px solid black;"><b>Sub Total</b></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_Workday')}}</b></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_GAJI_POKOK')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_TUNJANGAN_JABATAN')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_TUNJANGAN_INSENTIF')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_TUNJANGAN_LEMBUR')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_KEKURANGAN_BULAN_LALU')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_TUNJANGAN_TRANSPORT_MAKAN')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_KETUA_REGU')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_PENGEMBALIAN_SERAGAM')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_TUNJANGAN_MAKAN_LEMBUR')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_SALARY')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_SHIFT_PAGI_SIANG')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_TUNJANGAN_MAKAN_TRANSPORT')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $grandJumlahGaji }}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_BPJS_KESEHATAN')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_POTONGAN_KAS')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_BPJS_KETENAGAKERJAAN')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_POTONGAN_PINJAMAN')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_POTONGAN_SERAGAM')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $hasilQuery->sum('Jumlah_POTONGAN_CONSUMABLE')}}</b></td>
        <td style="border: 1px solid black;"><b>{{ $grandTotalGaji }}</td>
      </tr> --}}
    </table>

</html>
