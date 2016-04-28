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
    <form class="" method="post" action="{{url('masterpegawai')}}">
      <div class="row">
        <!--column -->
        <div class="col-md-12">
          @if(Session::has('message'))
            <div class="callout callout-success">
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
                  <label class="control-label">NIP Baru</label>
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
                <div class="form-group {{ $errors->has('nip_lama') ? 'has-error' : '' }}">
                  <label class="control-label">NIP Lama</label>
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
                <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                  <label class="control-label">Nama Pegawai</label>
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
                <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                  <label class="control-label">Alamat</label>
                  <textarea class="form-control" name="alamat" rows="5" cols="40" placeholder="Alamat">{{ !$errors->has('alamat') ? old('alamat') : '' }}</textarea>
                  @if($errors->has('alamat'))
                    <span class="help-block">
                      <strong>{{ $errors->first('alamat')}}
                      </strong>
                    </span>
                  @endif
                </div>
                <div class="form-group {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                  <label class="control-label">Tanggal Lahir</label>
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
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                  <label for="inputEmail3" class="control-label">Email</label>
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
                <div class="form-group {{ $errors->has('jk') ? 'has-error' : '' }}">
                  <label class="control-label">Jenis Kelamin</label>
                  <div class="form-group">
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
                <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                  <label class="control-label">Agama</label>
                  <select class="form-control" name="agama">
                    <option value=""></option>
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
                <div class="form-group {{ $errors->has('jabatan') ? 'has-error' : '' }}">
                  <label class="control-label">Jabatan</label>
                  <select class="form-control" name="jabatan">
                    <option value=""></option>
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
                <label class="control-label">Nomor KTP</label>
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
              <div class="form-group {{ $errors->has('no_kk') ? 'has-error' : '' }}">
                <label class="control-label">Nomor KK</label>
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
              <div class="form-group {{ $errors->has('no_npwp') ? 'has-error' : '' }}">
                <label class="control-label">Nomor NPWP</label>
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
              <div class="form-group {{ $errors->has('no_telp') ? 'has-error' : '' }}">
                <label class="control-label">Nomor Telepon</label>
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
              <div class="form-group {{ $errors->has('no_rekening') ? 'has-error' : '' }}">
                <label class="control-label">Nomor Rekening</label>
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
              <div class="form-group {{ $errors->has('bpjs_kesehatan') ? 'has-error' : '' }}">
                <label class="control-label">Nomor BPJS Kesehatan</label>
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
              <div class="form-group {{ $errors->has('bpjs_ketenagakerjaan') ? 'has-error' : '' }}">
                <label class="control-label">Nomor BPJS Ketenagakerjaan</label>
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
              <div class="form-group {{ $errors->has('status_pajak') ? 'has-error' : '' }}">
                <label class="control-label">Status Pajak</label>
                <select class="form-control" name="status_pajak">
                  <option value=""></option>
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
              <div class="form-group {{ $errors->has('kewarganegaraan') ? 'has-error' : '' }}">
                <label class="control-label">Kewarganegaraan</label>
                <select class="form-control" name="kewarganegaraan">
                  <option value=""></option>
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
            </div> <!-- /.box-body -->
            <div class="box-footer">
              <button type="reset" class="btn btn-default">Reset Formulir</button>
              <button type="submit" class="btn btn-info pull-right">Simpan</button>
            </div><!-- /.box-footer -->
          </div> <!-- /.box-info -->
        </div> <!-- /.col -->
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
    });
  </script>

@stop
