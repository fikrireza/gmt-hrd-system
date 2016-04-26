<?php $__env->startSection('title'); ?>
  <title>Master Client</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  <h1>
    Master Client
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <div class="row">
  <div class="col-md-1">
  <div class="box">
    <div class="btn-group-vertical">
      <a href="<?php echo e(url('masterclient/create')); ?>"><button type="button" class="btn btn-success">Tambah Client</button></a>
    </div>
  </div>
  </div>
  </div>

  <div class="row">
    <!-- Master Client -->
    <?php if(session('tambah')): ?>
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
        <?php echo e(session('tambah')); ?>

      </div>
    <?php endif; ?>
    <?php if(session('update')): ?>
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
        <?php echo e(session('update')); ?>

      </div>
    <?php endif; ?>
    <?php foreach($CountAll as $client): ?>
    <div class="col-md-4">
      <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-white">
          <a href="<?php echo e(url('masterclient', $client->id).('/edit')); ?>">
            <h3 class="widget-user-username"><?php echo e($client->nama_client); ?></h3>
            <h5 class="widget-user-desc"><?php echo e($client->kode_client); ?></h5>
          </a>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            <li><a href="<?php echo e(url('masterclient/cabang', $client->id)); ?>">Cabang Client <span class="pull-right badge bg-blue"><?php echo e($client->hitung); ?></span></a></li>
            <li><a href="<?php echo e(url('masterclient/departemen', $client->id )); ?>">Department Client <span class="pull-right badge bg-blue">0</span></a></li>
          </ul>
        </div>
      </div><!-- /.widget-user -->
    </div>
    <?php endforeach; ?>
  </div><!-- /.row -->


  <script src="<?php echo e(asset('/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.5 -->
  <script src="<?php echo e(asset('/bootstrap/js/bootstrap.min.js')); ?>"></script>
  <!-- Morris.js charts -->
  <script src="<?php echo e(asset('/bootstrap/js/raphael-min.js')); ?>"></script>
  <script src="<?php echo e(asset('/plugins/morris/morris.min.js')); ?>"></script>
  <!-- Sparkline -->
  <script src="<?php echo e(asset('/plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>
  <!-- jvectormap -->
  <script src="<?php echo e(asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
  <script src="<?php echo e(asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo e(asset('/plugins/knob/jquery.knob.js')); ?>"></script>
  <!-- daterangepicker -->
  <script src="<?php echo e(asset('/bootstrap/js/moment.min.js')); ?>"></script>
  <script src="<?php echo e(asset('/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
  <!-- datepicker -->
  <script src="<?php echo e(asset('/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo e(asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
  <!-- Slimscroll -->
  <script src="<?php echo e(asset('/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo e(asset('plugins/fastclick/fastclick.min.js')); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo e(asset('dist/js/app.min.js')); ?>"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo e(asset('/dist/js/pages/dashboard.js')); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo e(asset('/dist/js/demo.js')); ?>"></script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>