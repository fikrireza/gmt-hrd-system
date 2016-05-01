<?php $__env->startSection('title'); ?>
  <title>Lihat Data Pegawai</title>
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/AdminLTE.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  <h1>
    Seluruh Data Pegawai
    <small>Berikut adalah seluruh data pegawai pada database.</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-danger box-solid">
        <div class="box-header">
            Data ditampilkan dalam bentuk tabular.
        </div>
        <div class="box-body">
          <table class="table table-hover" id="tabelpegawai">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>No Telp</th>
                <th>Jabatan</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>   <!-- /.row -->


  <!-- jQuery 2.1.4 -->
  <script src="<?php echo e(asset('plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="<?php echo e(asset('bootstrap/js/bootstrap.min.js')); ?>"></script>
  <!-- DataTables -->
  <script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo e(asset('plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo e(asset('plugins/fastclick/fastclick.min.js')); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo e(asset('dist/js/app.min.js')); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>


  <script type="text/javascript">
    $(function() {
        $('#tabelpegawai').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo route('datatables.data'); ?>',
            column: [
              {data: '0', name: 'nip'},
              {data: '1', name: 'name'},
              {data: '2', name: 'jenis_kelamin'},
              {data: '3', name: 'no_telp'},
              {data: '4', name: 'nama_jabatan'},
              {data: '5', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>