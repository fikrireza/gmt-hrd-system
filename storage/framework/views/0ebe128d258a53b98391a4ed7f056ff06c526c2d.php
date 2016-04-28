<?php $__env->startSection('title'); ?>
  <title>Tambah Data Client</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  <h1>
    Master Client
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo e(url('masterclient')); ?>"> Master Client</a></li>
    <li class="active">Data Client</li>
  </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-md-5">
  	   <div class="box box-info">
  	      <div class="box-header with-border">
  	         <h3 class="box-title">
        		<?php if(isset($MasterClient)): ?>
        		  Ubah Data Client
        		<?php else: ?>
        		  Data Client
        		<?php endif; ?>
        	  </h3>
        	</div><!-- /.box-header -->
  	<!-- form start -->
  	<div class="box-body" style="display: block;">
  		<div class="row">
  			<div class="col-md-12">
  			<?php if(isset($MasterClient)): ?>
  			  <?php echo Form::model($MasterClient, ['method' => 'PATCH', 'url' => ['masterclient', $MasterClient->id], 'class'=>'form-horizontal']); ?>

  			<?php else: ?>
  			  <form class="form-horizontal" method="post" action="<?php echo e(url('masterclient')); ?>">
  			<?php endif; ?>
  			  <?php echo csrf_field(); ?>

  			<div class="box-body">
  			<div class="form-group <?php echo e($errors->has('kode_client') ? 'has-error' : ''); ?>">
  			  <label class="col-sm-4 control-label">Kode Client</label>
  			  <div class="col-sm-8">
  				<input type="text" name="kode_client" class="form-control" placeholder="Kode Client" maxlength="5"
  				<?php if(isset($MasterClient)): ?>
  				  value="<?php echo e($MasterClient->kode_client); ?>"
  				<?php else: ?>
  				value="<?php echo e(old('kode_client')); ?>"
  				<?php endif; ?>
  				>
          <?php if($errors->has('kode_client')): ?>
  				<span class="help-block">
  				  <strong><?php echo e($errors->first('kode_client')); ?>

  				  </strong>
  				</span>
  			  <?php endif; ?>
  			  </div>
  			</div>
  			<div class="form-group <?php echo e($errors->has('nama_client') ? 'has-error' : ''); ?>">
  			  <label class="col-sm-4 control-label">Nama Client</label>
  			  <div class="col-sm-8">
  				<input type="text" name="nama_client" class="form-control" placeholder="Nama Client" maxlength="20"
  				<?php if(isset($MasterClient)): ?>
  				  value="<?php echo e($MasterClient->nama_client); ?>"
  				<?php else: ?>
  				  value="<?php echo e(old('nama_client')); ?>"
  				<?php endif; ?>
  				>
          <?php if($errors->has('nama_client')): ?>
  				<span class="help-block">
  				  <strong><?php echo e($errors->first('nama_client')); ?>

  				  </strong>
  				</span>
  			  <?php endif; ?>
  			  </div>
  			</div>
  		</div><!-- /.box-body -->
  			<div class="box-footer">
  			<?php if(isset($MasterClient)): ?>
  			  <button type="submit" class="btn btn-info pull-right">Ubah Data Client</button>
  			<?php else: ?>
  			  <button type="submit" class="btn btn-info pull-right">Simpan Data Client</button>
  			<?php endif; ?>
  			</div><!-- /.box-footer -->
  		</form>
  	</div><!-- /.box -->
  	</div><!--/.col -->
  </div>


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