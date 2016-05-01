<!-- GET CONTENT LAYOUT -->


<!-- START CONDITION SECTION TITLE-->
<?php $__env->startSection('title'); ?>
  <?php if(isset($data['bindbahasaasing'])): ?>
    <title>Edit Bahasa Asing</title>
  <?php else: ?>
    <title>Tambah Bahasa Asing</title>
  <?php endif; ?>
<?php $__env->stopSection(); ?>
<!-- END CONDITION SECTION TITLE-->

<?php $__env->startSection('breadcrumb'); ?>
  <h1>
      Master Bahasa Asing <small>Kelola Data Bahasa Asing</small>
  </h1>
  <ol class="breadcrumb">
    <li>
        <a href="#"><i class="fa fa-dashboard"></i>Home</a>
    </li>
    <li class="active">Dashboard</li>
  </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- START DURATION TIME ALERT -->
<script>
  window.setTimeout(function() {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
  }, 2000);
</script>
<!-- END DURATION TIME ALERT -->

    <!-- START MODAL TO ALERT DELETE-->
    <div class="modal modal-warning fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus Data Bahasa Asing</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
            <a href="<?php echo e(url('masterbahasaasing/delete/1')); ?>" class="btn btn btn-outline" id="set">Ya, saya yakin.</a>
            <?php /* <button type="button" class="btn btn btn-outline" data-dismiss="modal">Ya, saya yakin.</button> */ ?>
          </div>
        </div>
      </div>
    </div>
    <!-- END MODAL TO ALERT DELETE-->

    <!-- START ROW -->
    <div class="row">
      <!-- START MESSAGE -->
      <div class="col-md-12">
        <?php if(Session::has('message')): ?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
            <p><?php echo e(Session::get('message')); ?></p>
          </div>
        <?php endif; ?>
      </div>
      <!-- END MESSAGE -->
      <!-- START DIV FORM-->
      <div class="col-md-5">
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- START CONDITION TITLE-->
            <?php if(isset($data['bindbahasaasing'])): ?>
              <h3 class="box-title">Formulir Edit Data Bahasa Asing</h3>
            <?php else: ?>
              <h3 class="box-title">Formulir Tambah Data Bahasa Asing</h3>
            <?php endif; ?>
            <!-- END CONDITION TITLE-->
          </div>
          <!-- START CONDITION FORM INSERT AND UPDATE-->
          <?php if(isset($data['bindbahasaasing'])): ?>
            <?php echo Form::model($data['bindbahasaasing'],
                                 ['route' => ['masterbahasaasing.update'], $data[bindbahasaasing]->id],
                                 'method' => "patch", 'class'=>'form-horizontal'); ?>

          <?php else: ?>
            <form class="form-horizontal" method="post" action="<?php echo e(url('masterbahasaasing')); ?>">
          <?php endif; ?>
          <!-- END CONDITION FORM INSERT AND UPDATE-->
            <!-- START BODY-->
            <?php echo csrf_field(); ?>

            <div class="box-body">
              <div class="form-group <?php echo e($errors->has('bahasa') ? 'has-error' : ''); ?>">
                <label class="col-sm-3 control-label">Bahasa</labe>
                <div class="col-sm-9">
                    <input <?php if(isset($data['bindbahasaasing'])): ?>
                                value"<?php echo e($data['bindbahasaasing']->bahasa}"
                           <?php endif; ?>
                            type="text" name="bahasa" class="form-control" placeholder="Bahasa" maxlength="20"
                           <?php if(!errors->has('bahasa')): ?>
                              value="{{$errors->has('bahasa')); ?>"
                           <?php endif; ?>/>
                      <?php if($errors->has('kode_jabatan')): ?>
                       <span class="help-block">
                         <strong><?php echo e($errors->first('bahasa')); ?>

                         </strong>
                       </span>
                      <?php endif; ?>
                </div>
              </div>
              <div class="form-group <?php echo e($errors->has('berbicara') ? 'has-error' : ''); ?>">
                 <label class="control-label">Berbicara</label>
                 <select class="form-control" name="berbicara">
                   <option value=""></option>
                   <option value="BAIK" <?php echo e(old('berbicara') == 'BAIK' ? 'selected="selected"' : ''); ?>>BAIK</option>
                   <option value="CUKUP" <?php echo e(old('berbicara') == 'CUKUP' ? 'selected="selected"' : ''); ?>>CUKUP</option>
                   <option value="KURANG" <?php echo e(old('berbicara') == 'KURANG' ? 'selected="selected"' : ''); ?>>KURANG</option>
                 </select>
                 <?php if($errors->has('berbicara')): ?>
                   <span class="help-block">
                     <strong><?php echo e($errors->first('berbicara')); ?>

                     </strong>
                   </span>
                 <?php endif; ?>
               </div>
               <div class="form-group <?php echo e($errors->has('menulis') ? 'has-error' : ''); ?>">
                  <label class="control-label">Menulis</label>
                  <select class="form-control" name="berbicara">
                    <option value=""></option>
                    <option value="BAIK" <?php echo e(old('menulis') == 'BAIK' ? 'selected="selected"' : ''); ?>>BAIK</option>
                    <option value="CUKUP" <?php echo e(old('menulis') == 'CUKUP' ? 'selected="selected"' : ''); ?>>CUKUP</option>
                    <option value="KURANG" <?php echo e(old('menulis') == 'KURANG' ? 'selected="selected"' : ''); ?>>KURANG</option>
                  </select>
                  <?php if($errors->has('menulis')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('menulis')); ?>

                      </strong>
                    </span>
                  <?php endif; ?>
                </div>
                <div class="form-group <?php echo e($errors->has('mengerti') ? 'has-error' : ''); ?>">
                   <label class="control-label">Mengerti</label>
                   <select class="form-control" name="berbicara">
                     <option value=""></option>
                     <option value="BAIK" <?php echo e(old('mengerti') == 'BAIK' ? 'selected="selected"' : ''); ?>>BAIK</option>
                     <option value="CUKUP" <?php echo e(old('mengerti') == 'CUKUP' ? 'selected="selected"' : ''); ?>>CUKUP</option>
                     <option value="KURANG" <?php echo e(old('mengerti') == 'KURANG' ? 'selected="selected"' : ''); ?>>KURANG</option>
                   </select>
                   <?php if($errors->has('mengerti')): ?>
                     <span class="help-block">
                       <strong><?php echo e($errors->first('mengerti')); ?>

                       </strong>
                     </span>
                   <?php endif; ?>
                 </div>
                 <div class="form-group <?php echo e($errors->has('id_pegawai') ? 'has-error' : ''); ?>">
                   <label class="control-label">NIP</label>
                   <select class="form-control" name="id_pegawai">
                     <option value=""></option>
                     <?php foreach($getpegawai as $key): ?>
                       <option value="<?php echo e($key->id); ?>" <?php echo e(old('id_pegawai') == $key->id ? 'selected="selected"' : ''); ?>><?php echo e($key->nip); ?> - <?php echo e($key->nama); ?></option>
                     <?php endforeach; ?>
                   </select>
                   <?php if($errors->has('id_pegawai')): ?>
                     <span class="help-block">
                       <strong><?php echo e($errors->first('id_pegawai')); ?>

                       </strong>
                     </span>
                   <?php endif; ?>
                 </div>
                 <div class="form-group">
                   <div class="col-sm-12">
                    <button type="submit" class="btn btn-info pull-right" style="margin-left:5px;">
                      <?php if(isset($data['bindbahasaasing'])): ?>
                        Simpan Perubahan
                      <?php else: ?>
                        Simpan
                      <?php endif; ?>
                    </button>
                      <?php if(!isset($data['bindbahasaasing'])): ?>
                        <button type="reset" class="btn btn-default pull-right">Reset Formulir</button>
                      <?php endif; ?>
                   </div>
                  </div>
            </div>
            <!-- START BODY-->
          <?php if(isset($data['bindjabatan'])): ?>
            <?php echo Form::close(); ?>

          <?php else: ?>
            </form>
          <?php endif; ?>
        </div>
      </div>
      <!-- END DIV FORM-->
      <!-- START TABLE -->
      <div class="col-md-7">
        <div class="box box-info" style="min-height:500px">
          <div class="box-header">
            <h3 class="box-title">Seluruh Data Bahasa Asing</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Berbicara</th>
                <th>Menulis</th>
                <th>Mengerti</th>
                <th>Aksi</th>
              </tr>
              <?php $pageget = 1; ?>
              <?php foreach($data['$getbahasaasing'] as $key): ?>
                <tr>
                  <td><?php echo e($pageget); ?></td>
                  <td><?php echo e($key->nip); ?> - <?php echo e($key->nama); ?></td>
                  <td><?php echo e($key->berbicara); ?></td>
                  <td><?php echo e($key->menulis); ?></td>
                  <td><?php echo e($key->mengerti); ?></td>
                  <td>
                    <a href="<?php echo e(route('masterbahasaasing.edit', $key->id)); ?>" class="btn btn-warning" data-toggle='tooltip' title='Edit Data'><i class="fa fa-edit"></i></a>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-danger hapus" data-toggle="modal" data-target="#myModal" data-value="<?php echo e($key->id); ?>"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                <?php $pageget++; ?>
              <?php endforeach; ?>
            </table>
          </div><!-- /.box-body -->
          <?php /* <div class="box-footer clearfix pull-right">
            <?php echo $data['getbahasaasing']->links(); ?>

          </div> */ ?>
        </div><!-- /.box -->
      </div>
      <!-- END TABLE -->
  </div>
  <!-- END ROW -->


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

  <script type="text/javascript">
    $(function(){
      $('a.hapus').click(function(){
        var a = $(this).data('value');
        $('#set').attr('href', "<?php echo e(url('/')); ?>/masterbahasaasing/delete/"+a);
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>