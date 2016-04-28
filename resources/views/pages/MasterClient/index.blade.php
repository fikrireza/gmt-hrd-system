@extends('layouts.master')

@section('title')
  <title>Master Client</title>
@stop

@section('breadcrumb')
  <h1>
    Master Client
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
@stop

@section('content')

  <div class="row">
  <div class="col-md-1">
  <div class="box">
    <div class="btn-group-vertical">
      <a href="{{url('masterclient/create')}}"><button type="button" class="btn btn-success">Tambah Client</button></a>
    </div>
  </div>
  </div>
  </div>

  <div class="row">
    <!-- Master Client -->
    <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 2000);
    </script>
    <div class="col-md-12">
    @if (session('tambah'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
        {{ session('tambah') }}
      </div>
    @endif
    @if (session('update'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
        {{ session('update') }}
      </div>
    @endif
  </div>
    @foreach($CountAll as $client)
    <div class="col-md-4">
      <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-white">
          <a href="{{url('masterclient', $client->id).('/edit')}}">
            <h3 class="widget-user-username">{{ $client->nama_client}}</h3>
            <h5 class="widget-user-desc">{{ $client->kode_client}}</h5>
          </a>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            <li><a href="{{ url('masterclient/cabang', $client->id)}}">Cabang Client <span class="pull-right badge bg-blue">{{ $client->hitungCabang}}</span></a></li>
            <li><a href="{{ url('masterclient/departemen', $client->id )}}">Department Client <span class="pull-right badge bg-blue">0</span></a></li>
          </ul>
        </div>
      </div><!-- /.widget-user -->
    </div>
    @endforeach
  </div><!-- /.row -->


  <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
  <!-- Morris.js charts -->
  <script src="{{ asset('/bootstrap/js/raphael-min.js') }}"></script>
  <script src="{{ asset('/plugins/morris/morris.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
  <!-- jvectormap -->
  <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('/plugins/knob/jquery.knob.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('/bootstrap/js/moment.min.js') }}"></script>
  <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <!-- Slimscroll -->
  <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('plugins/fastclick/fastclick.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('/dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('/dist/js/demo.js') }}"></script>


@stop
