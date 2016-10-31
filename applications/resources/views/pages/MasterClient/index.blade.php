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
    <div class="col-md-3">
      <a href="{{url('masterclient/create')}}" class="btn btn-success btn-block margin-bottom"><i class="fa fa-building-o"></i> Tambah Client</a>
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
          </ul>
        </div>
      </div>
    </div>
    @endforeach
    </div>
    @if(!$CountAll->isEmpty())
    <div class="row">
      <div style="text-align: center; vertical-align: middle;">
        {{ $CountAll->links() }}
      </div>
    </div>
    @endif


  <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
  <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.min.js') }}"></script>
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <script src="{{ asset('/dist/js/pages/dashboard.js') }}"></script>
  <script src="{{ asset('/dist/js/demo.js') }}"></script>


@stop
