@extends('layouts.master')

@section('title')
  <title>Tambah Data Bank</title>
@stop

@section('breadcrumb')
  <h1>
    Data Bank
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"> Master Bank</li>
  </ol>
@stop

@section('content')
    <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 1500);
    </script>
      <div class="row">
        <div class="col-md-12">
        @if (session('tambah'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
            {{ session('tambah') }}
          </div>
        @endif
        @if (session('ubah'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Sukses!</h4>
            {{ session('ubah') }}
          </div>
        @endif
        </div>

        <div class="col-md-5">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">
                @if(isset($BankEdit))
                  Ubah Data Bank
                @else
                  Tambah Data Bank
                @endif
                </h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"></button>
              </div>
            </div>
            <div class="box-body" style="display: block;">
              <div class="row">
                <div class="col-md-12">
                  @if(isset($BankEdit))
                    <form class="form-horizontal" method="post" action="{{ route('masterbank.edit') }}">
            			@else
            			  <form class="form-horizontal" method="post" action="{{ route('masterbank.store') }}">
            			@endif
                    {!! csrf_field() !!}
                    <div class="box-body">
                      <div class="form-group {{ $errors->has('nama_bank') ? 'has-error' : '' }}">
                        <label class="col-sm-3 control-label">Nama Bank</label>
                        <div class="col-sm-9">
                          <input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank" maxlength="40" @if(isset($BankEdit)) value="{{$BankEdit->nama_bank}}" readonly="" @else value="{{ old('nama_bank') }}" @endif >
                          @if($errors->has('nama_bank'))
                          <span class="help-block">
                            <strong>{{ $errors->first('nama_bank')}}
                            </strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      @if (isset($BankEdit))
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-9">
                          <input type="hidden" name="id" value="{{ $BankEdit->id }}">
                          <label>
                            <input type="checkbox" class="flat" name="flag_status" @if($BankEdit->flag_status == 1) checked="" @endif/>
                          </label>
                        </div>
                      </div>
                      @endif
                    </div>
                    <div class="box-footer">
                      @if(isset($BankEdit))
              			  <button type="submit" class="btn btn-success pull-right">Simpan Perubahan</button>
                			@else
              			  <button type="submit" class="btn btn-success pull-right" style="margin-left:5px;">Simpan</button>
                      <button type="reset" class="btn btn-danger pull-left">Reset Formulir</button>
                			@endif
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="box box-primary box-solid">
              <div class="box-header">
                <h3 class="box-title">Data Bank</h3>
              </div>
              <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                          <tr role="row">
                            <th>No</th>
                            <th>Nama Bank</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                      @if($getBank->isEmpty())
                        <tr>
                          <td colspan="4" class="text-muted" style="text-align:center;"><i>Data bank tidak tersedia.</i></td>
                        </tr>
                      @else
                        <?php
                          $pageget;
                          if($getBank->currentPage()==1)
                            $pageget = 1;
                          else
                            $pageget = (($getBank->currentPage() - 1) * $getBank->perPage())+1;
                        ?>
                        @foreach($getBank as $bank)
                        <tr>
                          <td>{{ $pageget }}</td>
                          <td class="">{!! $bank->nama_bank !!}</td>
                          <td class="">{{ ($bank->flag_status == '1') ? 'Aktif' : 'TIdak Aktif' }}</td>
                          <td>
                            <a href="{{ route('masterbank.ubah', array('id' => $bank->id)) }}" class="btn btn-xs btn-warning"  data-toggle='tooltip' title='Edit Data'><i class="fa fa-edit" alt="Ubah"></i></a>
                          </td>
                        </tr>
                        <?php $pageget++; ?>
                        @endforeach
                      @endif
                        </tbody>
                      </table>
                    </div>
                  </div>

                <div class="row">
                  <div class="col-sm-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Menampilkan 1 s/d {!! $getBank->count() !!}  dari {!! $getBank->total() !!} Bank</div>
                  </div>
                  <div class="col-sm-7">
                    <div class="pull-right">
                      {{ $getBank->links() }}
                    </div>
                  </div>
                </div>
                </div>
              </div>
          </div>
        </div>
      </div>


  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <script src="{{asset('dist/js/demo.js')}}"></script>


@stop
