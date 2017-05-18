<!DOCTYPE html>
<html>
  <head>
    @include('includes.head')
    @yield('title')
  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        @include('includes.header')
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        @include('includes.sidebar')
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          @yield('breadcrumb')
        </section>

        <section class="content">

          <div class="modal fade bs-example-modal-sm" id="modalTunggu" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                      <span class="glyphicon glyphicon-time"></span> Mohon Tunggu
                    </h4>
                </div>
                <div class="modal-body">
                  <div class="progress">
                      <div class="progress-bar progress-bar-info progress-bar-striped active" style="width: 100%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        @include('includes.footer')
      </footer>

    </div><!-- ./wrapper -->

    <script type="text/javascript">
      $(function () {
          $('#modalTunggu').modal('show');
          $.ajax({
              success: function () {
                  $('#modalTunggu').modal('hide');
                  // console.log('Berhasil');
              },
              error: function () {
                  $('#modalTunggu').modal('hide');
                  // console.log('Gagal');
              }
          });
      });
    </script>

  </body>
</html>
