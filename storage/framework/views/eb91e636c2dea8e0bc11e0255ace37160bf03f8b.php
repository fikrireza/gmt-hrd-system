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
    <script>
      window.setTimeout(function() {
        $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
      }, 2000);
    </script>

    <form class="" method="post" action="<?php echo e(url('masterpegawai')); ?>">
      <div class="row">
        <!--column -->
        <div class="col-md-12">
          <?php if(Session::has('message')): ?>
            <div class="alert alert-success">
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
                <div class="form-group <?php echo e($errors->has('nip') ? 'has-error' : ''); ?>">
                  <label class="control-label">NIP Baru</label>
                  <input type="text" name="nip" class="form-control" placeholder="NIP Baru"
                    <?php if(!$errors->has('nip')): ?>
                     value="<?php echo e(old('nip')); ?>"
                    <?php endif; ?>
                  >
                  <?php if($errors->has('nip')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('nip')); ?>

                      </strong>
                    </span>
                  <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('nip_lama') ? 'has-error' : ''); ?>">
                  <label class="control-label">NIP Lama</label>
                <input type="text" name="nip_lama" class="form-control" placeholder="NIP Lama"
                <?php if(!$errors->has('nip_lama')): ?>
                   value="<?php echo e(old('nip_lama')); ?>"
                  <?php endif; ?>
                >
                <?php if($errors->has('nip_lama')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('nip_lama')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('nama') ? 'has-error' : ''); ?>">
                  <label class="control-label">Nama Pegawai</label>
                  <input type="text" name="nama" class="form-control" placeholder="Nama Pegawai"
                    <?php if(!$errors->has('nama')): ?>
                     value="<?php echo e(old('nama')); ?>"
                    <?php endif; ?>
                  >
                  <?php if($errors->has('nama')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('nama')); ?>

                      </strong>
                    </span>
                  <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('alamat') ? 'has-error' : ''); ?>">
                  <label class="control-label">Alamat</label>
                  <textarea class="form-control" name="alamat" rows="5" cols="40" placeholder="Alamat"><?php echo e(!$errors->has('alamat') ? old('alamat') : ''); ?></textarea>
                  <?php if($errors->has('alamat')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('alamat')); ?>

                      </strong>
                    </span>
                  <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('tanggal_lahir') ? 'has-error' : ''); ?>">
                  <label class="control-label">Tanggal Lahir</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="tanggal_lahir" name="tanggal_lahir" data-date-format="dd-mm-yyyy"
                      <?php if(!$errors->has('tanggal_lahir')): ?>
                       value="<?php echo e(old('tanggal_lahir')); ?>"
                      <?php endif; ?>
                    >
                  </div><!-- /.input group -->
                  <?php if($errors->has('tanggal_lahir')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('tanggal_lahir')); ?>

                      </strong>
                    </span>
                  <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                  <label for="inputEmail3" class="control-label">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email"
                    <?php if(!$errors->has('email')): ?>
                     value="<?php echo e(old('email')); ?>"
                    <?php endif; ?>
                  >
                  <?php if($errors->has('email')): ?>
                        <span class="help-block">
                          <strong><?php echo e($errors->first('email')); ?>

                      </strong>
                    </span>
                  <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('jk') ? 'has-error' : ''); ?>">
                  <label class="control-label">Jenis Kelamin</label>
                  <div class="form-group">
                    <label>
                      <input type="radio" name="jk" class="minimal" value="L" <?php echo e(old('jk') == 'L' ? 'checked' : ''); ?>>
                    </label>
                    &nbsp;
                    <label>Pria</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                      <input type="radio" name="jk" class="minimal" value="P" <?php echo e(old('jk') == 'P' ? 'checked' : ''); ?>>
                    </label>
                    &nbsp;
                    <label>Wanita</label>
                  </div>
                  <?php if($errors->has('jk')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('jk')); ?>

                      </strong>
                    </span>
                  <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('agama') ? 'has-error' : ''); ?>">
                  <label class="control-label">Agama</label>
                  <select class="form-control" name="agama">
                    <option value=""></option>
                    <option value="Islam" <?php echo e(old('agama') == 'Islam' ? 'selected="selected"' : ''); ?>>Islam</option>
                    <option value="Kristen" <?php echo e(old('agama') == 'Kristen' ? 'selected="selected"' : ''); ?>>Kristen</option>
                    <option value="Hindu" <?php echo e(old('agama') == 'Hindu' ? 'selected="selected"' : ''); ?>>Hindu</option>
                    <option value="Budha" <?php echo e(old('agama') == 'Budha' ? 'selected="selected"' : ''); ?>>Budha</option>
                    <option value="Lainnya" <?php echo e(old('agama') == 'Lainnya' ? 'selected="selected"' : ''); ?>>Lainnya</option>
                  </select>
                  <?php if($errors->has('agama')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('agama')); ?>

                      </strong>
                    </span>
                  <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('jabatan') ? 'has-error' : ''); ?>">
                  <label class="control-label">Jabatan</label>
                  <select class="form-control" name="jabatan">
                    <option value=""></option>
                    <?php foreach($getjabatan as $key): ?>
                      <option value="<?php echo e($key->id); ?>" <?php echo e(old('jabatan') == $key->id ? 'selected="selected"' : ''); ?>><?php echo e($key->kode_jabatan); ?> - <?php echo e($key->nama_jabatan); ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if($errors->has('jabatan')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('jabatan')); ?>

                      </strong>
                    </span>
                  <?php endif; ?>
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
              <div class="form-group <?php echo e($errors->has('no_ktp') ? 'has-error' : ''); ?>">
                <label class="control-label">Nomor KTP</label>
                <input type="text" name="no_ktp" maxlength="16" class="form-control" placeholder="Nomor KTP"
                <?php if(!$errors->has('no_ktp')): ?>
                 value="<?php echo e(old('no_ktp')); ?>"
                <?php endif; ?>
                >
                <?php if($errors->has('no_ktp')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('no_ktp')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
              </div>
              <div class="form-group <?php echo e($errors->has('no_kk') ? 'has-error' : ''); ?>">
                <label class="control-label">Nomor KK</label>
                <input type="text" name="no_kk" class="form-control" placeholder="Nomor KK"
                  <?php if(!$errors->has('no_kk')): ?>
                   value="<?php echo e(old('no_kk')); ?>"
                  <?php endif; ?>
                >
                <?php if($errors->has('no_kk')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('no_kk')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
              </div>
              <div class="form-group <?php echo e($errors->has('no_npwp') ? 'has-error' : ''); ?>">
                <label class="control-label">Nomor NPWP</label>
                <input type="text" name="no_npwp" class="form-control" placeholder="Nomor NPWP"
                  <?php if(!$errors->has('no_npwp')): ?>
                   value="<?php echo e(old('no_npwp')); ?>"
                  <?php endif; ?>
                >
                <?php if($errors->has('no_npwp')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('no_npwp')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
              </div>
              <div class="form-group <?php echo e($errors->has('no_telp') ? 'has-error' : ''); ?>">
                <label class="control-label">Nomor Telepon</label>
                <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon"
                  <?php if(!$errors->has('no_telp')): ?>
                   value="<?php echo e(old('no_telp')); ?>"
                  <?php endif; ?>
                >
                <?php if($errors->has('no_telp')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('no_telp')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
              </div>
              <div class="form-group <?php echo e($errors->has('no_rekening') ? 'has-error' : ''); ?>">
                <label class="control-label">Nomor Rekening</label>
                <input type="text" name="no_rekening" class="form-control" placeholder="Nomor Rekening"
                  <?php if(!$errors->has('no_rekening')): ?>
                   value="<?php echo e(old('no_rekening')); ?>"
                  <?php endif; ?>
                >
                <?php if($errors->has('no_rekening')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('no_rekening')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
              </div>
              <div class="form-group <?php echo e($errors->has('bpjs_kesehatan') ? 'has-error' : ''); ?>">
                <label class="control-label">Nomor BPJS Kesehatan</label>
                <input type="text" name="bpjs_kesehatan" class="form-control" placeholder="Nomor BPJS Kesehatan"
                  <?php if(!$errors->has('bpjs_kesehatan')): ?>
                   value="<?php echo e(old('bpjs_kesehatan')); ?>"
                  <?php endif; ?>
                >
                <?php if($errors->has('bpjs_kesehatan')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('bpjs_kesehatan')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
              </div>
              <div class="form-group <?php echo e($errors->has('bpjs_ketenagakerjaan') ? 'has-error' : ''); ?>">
                <label class="control-label">Nomor BPJS Ketenagakerjaan</label>
                <input type="text" name="bpjs_ketenagakerjaan" class="form-control" placeholder="Nomor BPJS Ketenagakerjaan"
                  <?php if(!$errors->has('bpjs_ketenagakerjaan')): ?>
                   value="<?php echo e(old('bpjs_ketenagakerjaan')); ?>"
                  <?php endif; ?>
                >
                <?php if($errors->has('bpjs_ketenagakerjaan')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('bpjs_ketenagakerjaan')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
              </div>
              <div class="form-group <?php echo e($errors->has('status_pajak') ? 'has-error' : ''); ?>">
                <label class="control-label">Status Pajak</label>
                <select class="form-control" name="status_pajak">
                  <option value=""></option>
                  <option value="Wajib Pajak" <?php echo e(old('status_pajak') == 'Wajib Pajak' ? 'selected="selected"' : ''); ?>>Wajib Pajak</option>
                  <option value="Tidak Wajib Pajak" <?php echo e(old('status_pajak') == 'Tidak Wajib Pajak' ? 'selected="selected"' : ''); ?>>Tidak Wajib Pajak</option>
                </select>
                <?php if($errors->has('status_pajak')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('status_pajak')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
              </div>
              <div class="form-group <?php echo e($errors->has('kewarganegaraan') ? 'has-error' : ''); ?>">
                <label class="control-label">Kewarganegaraan</label>
                <select class="form-control" name="kewarganegaraan">
                  <option value=""></option>
                  <option value="WNI" <?php echo e(old('kewarganegaraan') == 'WNI' ? 'selected="selected"' : ''); ?>>WNI</option>
                  <option value="WNA" <?php echo e(old('kewarganegaraan') == 'WNA' ? 'selected="selected"' : ''); ?>>WNA</option>
                </select>
                <?php if($errors->has('kewarganegaraan')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('kewarganegaraan')); ?>

                    </strong>
                  </span>
                <?php endif; ?>
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