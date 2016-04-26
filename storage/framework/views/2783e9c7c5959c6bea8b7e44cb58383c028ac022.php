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
    <li><a href="<?php echo e(url()->previous()); ?>"> Cabang</a></li>
    <li class="active">Cabang Client</li>
  </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
      <div class="row">

        <div class="col-md-12">
        <?php if(session('status')): ?>
          <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
            <?php echo e(session('status')); ?>

          </div>
        <?php endif; ?>
        </div>

        <div class="col-md-5">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Departemen Cabang : <?php echo $CabangClient->nama_cabang; ?></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="row">
                <div class="col-md-12">
                  <form class="form-horizontal" method="post" action="<?php echo e(url('departemencabang')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="box-body">
                      <div class="form-group <?php echo e($errors->has('kode_departemen') ? 'has-error' : ''); ?>">
                        <label class="col-sm-5 control-label">Kode Departemen</label>
                        <div class="col-sm-7">
                          <input type="text" name="kode_departemen" class="form-control" placeholder="Kode Departemen" maxlength="5" value="<?php echo e(old('kode_departemen')); ?>">
                          <?php if($errors->has('kode_departemen')): ?>
                            <span class="help-block">
                              <strong><?php echo e($errors->first('kode_departemen')); ?>

                              </stron>
                            </span>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo e($errors->has('nama_departemen') ? 'has-error' : ''); ?>">
                        <label class="col-sm-5 control-label">Nama Departemen</label>
                        <div class="col-sm-7">
                          <input type="text" name="nama_departemen" class="form-control" placeholder="Nama Departemen" maxlength="45" value="<?php echo e(old('nama_departemen')); ?>">
                          <?php if($errors->has('nama_departemen')): ?>
                            <span class="help-block">
                              <strong><?php echo e($errors->first('nama_departemen')); ?>

                              </stron>
                            </span>
                          <?php endif; ?>
                        </div>
                      </div>
                      <input type="hidden" name="id_cabang" class="form-control" value="<?php echo $CabangClient->id; ?>">
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-info pull-right">Simpan</button>
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
                  <h3 class="box-title">Tabel Departemen Cabang : <?php echo $CabangClient->nama_cabang; ?></h3>
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
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Kode Departemen</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Nama Departemen</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($DepartemenCabang as $Departemen): ?>
                    <tr>
                      <td class=""><?php echo $Departemen->kode_departemen; ?></td>
                      <td class=""><?php echo $Departemen->nama_departemen; ?></td>
                      <td><a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
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
                    <?php echo $DepartemenCabang->render(); ?>

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