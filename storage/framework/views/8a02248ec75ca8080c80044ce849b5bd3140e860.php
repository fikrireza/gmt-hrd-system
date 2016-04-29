<?php $__env->startSection('title'); ?>
  <title>Tambah Data Cabang Client</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  <h1>
    Cabang Client
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo e(url('masterclient')); ?>"> Master Client</a></li>
    <li class="active">Cabang Client</li>
  </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 1500);
    </script>
      <div class="row">
        <div class="col-md-12">
        <?php if(session('tambah')): ?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
            <?php echo e(session('tambah')); ?>

          </div>
        <?php endif; ?>
        <?php if(session('ubah')): ?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
            <?php echo e(session('ubah')); ?>

          </div>
        <?php endif; ?>
        </div>
        <div class="col-md-5">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">
                <?php if(isset($CabangEdit)): ?>
                  Ubah Data Cabang
                <?php else: ?>
                  Tambah Cabang Client : <?php echo $MasterClient->nama_client; ?>

                <?php endif; ?>
                </h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="row">
                <div class="col-md-12">
                  <?php if(isset($CabangEdit)): ?>
            			  <?php echo Form::model($CabangClient, ['method' => 'PATCH', 'url' => ['cabangclient', $CabangEdit->id], 'class'=>'form-horizontal']); ?>

            			<?php else: ?>
            			  <form class="form-horizontal" method="post" action="<?php echo e(url('cabangclient')); ?>">
            			<?php endif; ?>
                    <?php echo csrf_field(); ?>

                    <div class="box-body">
                      <div class="form-group <?php echo e($errors->has('kode_cabang') ? 'has-error' : ''); ?>">
                        <label class="col-sm-4 control-label">Kode Cabang</label>
                        <div class="col-sm-8">
                          <input type="text" name="kode_cabang" class="form-control" placeholder="Kode Cabang" maxlength="5"
                          <?php if(isset($CabangEdit)): ?>
                  				  value="<?php echo e($CabangEdit->kode_cabang); ?>" readonly=""
                  				<?php else: ?>
                  				value="<?php echo e(old('kode_cabang')); ?>"
                  				<?php endif; ?>
                  				>
                          <?php if($errors->has('kode_cabang')): ?>
                            <span class="help-block">
                              <strong><?php echo e($errors->first('kode_cabang')); ?>

                              </strong>
                            </span>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo e($errors->has('nama_cabang') ? 'has-error' : ''); ?>">
                        <label class="col-sm-4 control-label">Nama Cabang</label>
                        <div class="col-sm-8">
                          <input type="text" name="nama_cabang" class="form-control" placeholder="Nama Cabang" maxlength="40" <?php if(isset($CabangEdit)): ?>
                  				  value="<?php echo e($CabangEdit->nama_cabang); ?>"
                  				<?php else: ?>
                  				value="<?php echo e(old('nama_cabang')); ?>"
                  				<?php endif; ?>
                  				>
                          <?php if($errors->has('nama_cabang')): ?>
                            <span class="help-block">
                              <strong><?php echo e($errors->first('nama_cabang')); ?>

                              </strong>
                            </span>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo e($errors->has('alamat_cabang') ? 'has-error' : ''); ?>">
                        <label class="col-sm-4 control-label">Alamat Cabang</label>
                        <div class="col-sm-8">
                          <textarea name="alamat_cabang" class="form-control" rows="2" placeholder="Alamat Cabang"><?php if(isset($CabangEdit)): ?><?php echo e($CabangEdit->alamat_cabang); ?><?php else: ?><?php echo e(old('alamat_cabang')); ?><?php endif; ?></textarea>
                          <?php if($errors->has('alamat_cabang')): ?>
                            <span class="help-block">
                              <strong><?php echo e($errors->first('alamat_cabang')); ?>

                              </strong>
                            </span>
                          <?php endif; ?>
                        </div>
                      </div>
                      <input type="hidden" name="id_client" class="form-control"
                      <?php if(isset($CabangEdit)): ?>
                        value="<?php echo e($MasterClient->id); ?>"
                      <?php else: ?>
                      value="<?php echo $MasterClient->id; ?>"
                      <?php endif; ?> >
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <?php if(isset($CabangEdit)): ?>
                        <button type="button" class="btn btn-default pull-left">Kembali</button>
                			  <button type="submit" class="btn btn-info pull-right">Ubah Data Cabang</button>
                			<?php else: ?>
                			  <button type="submit" class="btn btn-info pull-right">Simpan Data Cabang</button>
                			<?php endif; ?>
                    </div><!-- /.box-footer -->
                  </form>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-7">
          <div class="box box-info">
              <div class="box-header">
                  <h3 class="box-title">Data Cabang Client : <?php echo $MasterClient->nama_client; ?></h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="dataTables_length" id="example1_length"><label>Show
                        <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                          <option value="10">10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                        </select> entries</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div id="example1_filter" class="dataTables_filter">
                        <label>Search:
                          <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                          <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Kode cabang</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama cabang</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Alamat Cabang</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="2">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($CabangClient as $Cabang): ?>
                            <tr>
                              <td class=""><?php echo $Cabang->kode_cabang; ?></td>
                              <td class=""><?php echo $Cabang->nama_cabang; ?></td>
                              <td class=""><?php echo $Cabang->alamat_cabang; ?></td>
                              <td><a href="<?php echo e(url('cabangclient', $Cabang->id).('/edit')); ?>" class="btn btn-warning" ><i class="fa fa-edit" alt="Ubah"></i></a></td>
                              <td><i class="glyphicon glyphicon-open"></i><a href="<?php echo e(url('departemencabang', $Cabang->id )); ?>">Tambah Departemen</a></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-5">
                  <!--<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>-->
                    </div>
                    <div class="col-sm-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        <?php echo $CabangClient->render(); ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
          </div>
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