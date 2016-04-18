<?php $__env->startSection('title'); ?>
  <title>Tambah Data Pegawai</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
      <div class="row">
        <!--column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo e(url('masterpegawai')); ?>">
              <?php echo csrf_field(); ?>

              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-4">
                    <input type="text" name="nip" class="form-control" placeholder="NIP">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Pegawai</label>
                  <div class="col-sm-4">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Pegawai">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-4">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-4">
                    <textarea class="form-control" name="alamat" rows="8" cols="40" placeholder="Alamat"></textarea>
                  </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
              </div><!-- /.box-footer -->
            </form>
          </div><!-- /.box -->
        </div><!--/.col -->
      </div>   <!-- /.row -->


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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>