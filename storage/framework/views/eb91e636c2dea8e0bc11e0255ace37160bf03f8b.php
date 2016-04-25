<?php $__env->startSection('title'); ?>
  <title>Tambah Data Pegawai</title>
  <link rel="stylesheet" href="<?php echo e(asset('plugins/iCheck/all.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datepicker/datepicker3.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  <h1>
    Formulir Tambah Pegawai
    <small>Silahkan isi informasi di bawah ini.</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form class="" method="post" action="<?php echo e(url('masterpegawai')); ?>">
      <div class="row">
        <!--column -->
        <div class="col-md-12">
          <?php if(Session::has('message')): ?>
            <div class="callout callout-success">
              <h4>Berhasil!</h4>
              <p><?php echo e(Session::get('message')); ?></p>
            </div>
          <?php endif; ?>
        </div>
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Informasi Utama</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
              <?php echo csrf_field(); ?>

              <div class="box-body">
                <div class="form-group">
                  <label class="control-label">NIP Baru</label>
                  <input type="text" name="nip" class="form-control" placeholder="NIP Baru">
                </div>
                <div class="form-group">
                  <label class="control-label">NIP Lama</label>
                <input type="text" name="nip_lama" class="form-control" placeholder="NIP Lama">
                </div>
                <div class="form-group">
                  <label class="control-label">Nama Pegawai</label>
                  <input type="text" name="nama" class="form-control" placeholder="Nama Pegawai">
                </div>
                <div class="form-group">
                  <label class="control-label">Alamat</label>
                  <textarea class="form-control" name="alamat" rows="5" cols="40" placeholder="Alamat"></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Tanggal Lahir</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="tanggal_lahir" name="tanggal_lahir" data-date-format="dd-mm-yyyy">
                  </div><!-- /.input group -->
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="control-label">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                  <label class="control-label">Jenis Kelamin</label>
                  <div class="form-group">
                    <label>
                      <input type="radio" name="jk" class="minimal" value="L">
                    </label>
                    &nbsp;
                    <label>Pria</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                      <input type="radio" name="jk" class="minimal" value="P">
                    </label>
                    &nbsp;
                    <label>Wanita</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Agama</label>
                  <select class="form-control" name="agama">
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Jabatan</label>
                  <select class="form-control" name="jabatan">
                    <?php foreach($getjabatan as $key): ?>
                      <option value="<?php echo e($key->id); ?>"><?php echo e($key->kode_jabatan); ?> - <?php echo e($key->nama_jabatan); ?></option>
                    <?php endforeach; ?>
                  </select>
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
              <div class="form-group">
                <label class="control-label">Nomor KTP</label>
                <input type="text" name="no_ktp" class="form-control" placeholder="Nomor KTP">
              </div>
              <div class="form-group">
                <label class="control-label">Nomor KK</label>
                <input type="text" name="no_kk" class="form-control" placeholder="Nomor KK">
              </div>
              <div class="form-group">
                <label class="control-label">Nomor NPWP</label>
                <input type="text" name="no_npwp" class="form-control" placeholder="Nomor NPWP">
              </div>
              <div class="form-group">
                <label class="control-label">Nomor Telepon</label>
                <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon">
              </div>
              <div class="form-group">
                <label class="control-label">Nomor Rekening</label>
                <input type="text" name="no_rekening" class="form-control" placeholder="Nomor Rekening">
              </div>
              <div class="form-group">
                <label class="control-label">Nomor BPJS Kesehatan</label>
                <input type="text" name="bpjs_kesehatan" class="form-control" placeholder="Nomor BPJS Kesehatan">
              </div>
              <div class="form-group">
                <label class="control-label">Nomor BPJS Ketenagakerjaan</label>
                <input type="text" name="bpjs_ketenagakerjaan" class="form-control" placeholder="Nomor BPJS Ketenagakerjaan">
              </div>
              <div class="form-group">
                <label class="control-label">Status Pajak</label>
                <select class="form-control" name="status_pajak">
                  <option value="Wajib Pajak">Wajib Pajak</option>
                  <option value="Tidak Wajib Pajak">Tidak Wajib Pajak</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Kewarganegaraan</label>
                <select class="form-control" name="kewarganegaraan">
                  <option value="WNI">WNI</option>
                  <option value="WNA">WNA</option>
                </select>
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
  <script src="<?php echo e(asset('plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="<?php echo e(asset('bootstrap/js/bootstrap.min.js')); ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo e(asset('plugins/fastclick/fastclick.min.js')); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo e(asset('dist/js/app.min.js')); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>

  <!-- iCheck -->
  <script src="<?php echo e(asset('plugins/iCheck/icheck.min.js')); ?>"></script>

  <!-- date time -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="<?php echo e(asset('plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>


  <script type="text/javascript">
    $(function(){
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      });

      $('#tanggal_lahir').datepicker();
    });
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>