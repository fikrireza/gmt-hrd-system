<?php $__env->startSection('title'); ?>
  <?php if(isset($data['bindjabatan'])): ?>
    <title>Edit Data Jabatan</title>
  <?php else: ?>
    <title>Tambah Data Jabatan</title>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  <h1>
    Master Jabatan
    <small>Kelola Data Jabatan</small>
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

    <!-- Modal -->
    <div class="modal modal-warning fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus Data Jabatan</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk menghapus data jabatan ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
            <a href="<?php echo e(url('masterjabatan/hapusjabatan/1')); ?>" class="btn btn btn-outline" id="set">Ya, saya yakin.</a>
            <?php /* <button type="button" class="btn btn btn-outline" data-dismiss="modal">Ya, saya yakin.</button> */ ?>
          </div>
        </div>

      </div>
    </div>

  <div class="row">
    <!--column -->
    <div class="col-md-12">
      <?php if(Session::has('message')): ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
          <p><?php echo e(Session::get('message')); ?></p>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md-5">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <?php if(isset($data['bindjabatan'])): ?>
            <h3 class="box-title">Formulir Edit Data Jabatan</h3>
          <?php else: ?>
            <h3 class="box-title">Formulir Tambah Data Jabatan</h3>
          <?php endif; ?>
        </div><!-- /.box-header -->
        <!-- form start -->
        <?php if(isset($data['bindjabatan'])): ?>
          <?php echo Form::model($data['bindjabatan'], ['route' => ['masterjabatan.update', $data['bindjabatan']->id], 'method' => "patch", 'class'=>'form-horizontal']); ?>

        <?php else: ?>
          <form class="form-horizontal" method="post" action="<?php echo e(url('masterjabatan')); ?>">
        <?php endif; ?>
          <?php echo csrf_field(); ?>

          <div class="box-body">
            <div class="form-group <?php echo e($errors->has('kode_jabatan') ? 'has-error' : ''); ?>">
              <label class="col-sm-3 control-label">Kode Jabatan</label>
              <div class="col-sm-9">
                <input
                  <?php if(isset($data['bindjabatan'])): ?>
                    value="<?php echo e($data['bindjabatan']->kode_jabatan); ?>" readonly="true"
                  <?php endif; ?>
                  type="text" name="kode_jabatan" class="form-control" placeholder="Kode Jabatan" maxlength="6"
                  <?php if(!$errors->has('kode_jabatan')): ?>
                   value="<?php echo e(old('kode_jabatan')); ?>"
                  <?php endif; ?>
                >

                <?php if($errors->has('kode_jabatan')): ?>
                 <span class="help-block">
                   <strong><?php echo e($errors->first('kode_jabatan')); ?>

                   </strong>
                 </span>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-group <?php echo e($errors->has('nama_jabatan') ? 'has-error' : ''); ?>">
              <label class="col-sm-3 control-label">Nama Jabatan</label>
              <div class="col-sm-9">
                <input
                  <?php if(isset($data['bindjabatan'])): ?>
                    value="<?php echo e($data['bindjabatan']->nama_jabatan); ?>"
                  <?php endif; ?>
                  type="text" name="nama_jabatan" class="form-control" placeholder="Nama Jabatan"
                  <?php if(!$errors->has('nama_jabatan')): ?>
                    value="<?php echo e(old('nama_jabatan')); ?>"
                  <?php endif; ?>
                >
                <?php if($errors->has('nama_jabatan')): ?>
                 <span class="help-block">
                   <strong><?php echo e($errors->first('nama_jabatan')); ?>

                   </strong>
                 </span>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-info pull-right" style="margin-left:5px;">
                  <?php if(isset($data['bindjabatan'])): ?>
                    Simpan Perubahan
                  <?php else: ?>
                    Simpan
                  <?php endif; ?>
                </button>
                  <?php if(!isset($data['bindjabatan'])): ?>
                    <button type="reset" class="btn btn-default pull-right">Reset Formulir</button>
                  <?php endif; ?>
              </div>
            </div>
          </div><!-- /.box-body -->
        <?php if(isset($data['bindjabatan'])): ?>
          <?php echo Form::close(); ?>

        <?php else: ?>
          </form>
        <?php endif; ?>
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
            <?php foreach($data['getjabatan'] as $key): ?>
              <tr>
                <td><?php echo e($i); ?></td>
                <td><?php echo e($key->kode_jabatan); ?></td>
                <td><?php echo e($key->nama_jabatan); ?></td>
                <td>
                  <a href="<?php echo e(route('masterjabatan.edit', $key->id)); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                  <a href="" class="btn btn-danger hapus" data-toggle="modal" data-target="#myModal" data-value="<?php echo e($key->id); ?>"><i class="fa fa-remove"></i></a>
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

  <script type="text/javascript">
    $(function(){
      $('a.hapus').click(function(){
        var a = $(this).data('value');
        $('#set').attr('href', "<?php echo e(url('/')); ?>/masterjabatan/hapusjabatan/"+a);
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>