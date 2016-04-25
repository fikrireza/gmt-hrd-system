<?php $__env->startSection('title'); ?>
  <title>Tambah Data Jabatan</title>
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
      <?php if(Session::has('message')): ?>
        <div class="callout callout-success">
          <h4>Berhasil!</h4>
          <p><?php echo e(Session::get('message')); ?></p>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md-5">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Tambah Data Jabatan</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="<?php echo e(url('masterjabatan')); ?>">
          <?php echo csrf_field(); ?>

          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-3 control-label">Kode Jabatan</label>
              <div class="col-sm-9">
                <input type="text" name="kode_jabatan" class="form-control" placeholder="Kode Jabatan">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama Jabatan</label>
              <div class="col-sm-9">
                <input type="text" name="nama_jabatan" class="form-control" placeholder="Nama Jabatan">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-info pull-right" style="margin-left:5px;">Simpan</button><!-- /.box-footer -->
                <button type="reset" class="btn btn-default pull-right">Reset Formulir</button>
              </div>
            </div>
          </div><!-- /.box-body -->
        </form>
      </div><!-- /.box -->
    </div><!--/.col -->

    <div class="col-md-7">
      <div class="box box-info" style="min-height:500px">
        <div class="box-header">
          <h3 class="box-title">Seluruh Data Jabatan</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>No</th>
              <th>Kode Jabatan</th>
              <th>Nama Jabatan</th>
              <th>Aksi</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach($getjabatan as $key): ?>
              <tr>
                <td><?php echo e($i); ?></td>
                <td><?php echo e($key->kode_jabatan); ?></td>
                <td><?php echo e($key->nama_jabatan); ?></td>
                <td>
                  <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                  <a href="" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                </td>
                <?php $i++; ?>
              </tr>
            <?php endforeach; ?>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
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