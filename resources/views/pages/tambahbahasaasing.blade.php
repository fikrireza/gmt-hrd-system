<!-- GET CONTENT LAYOUT -->
@extends('layouts.master')

<!-- START CONDITION SECTION TITLE-->
@section('title')
  @if(isset($data['bindbahasaasing']))
    <title>Edit Bahasa Asing</title>
  @else
    <title>Tambah Bahasa Asing</title>
  @endif
@stop
<!-- END CONDITION SECTION TITLE-->

@section('breadcrumb')
  <h1>
      Master Bahasa Asing <small>Kelola Data Bahasa Asing</small>
  </h1>
  <ol class="breadcrumb">
    <li>
        <a href="#"><i class="fa fa-dashboard"></i>Home</a>
    </li>
    <li class="active">Dashboard</li>
  </ol>
@stop

@section('content')
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
            <a href="{{url('masterbahasaasing/delete/1')}}" class="btn btn btn-outline" id="set">Ya, saya yakin.</a>
            {{-- <button type="button" class="btn btn btn-outline" data-dismiss="modal">Ya, saya yakin.</button> --}}
          </div>
        </div>
      </div>
    </div>
    <!-- END MODAL TO ALERT DELETE-->

    <!-- START ROW -->
    <div class="row">
      <!-- START MESSAGE -->
      <div class="col-md-12">
        @if(Session::has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
            <p>{{ Session::get('message') }}</p>
          </div>
        @endif
      </div>
      <!-- END MESSAGE -->
      <!-- START DIV FORM-->
      <div class="col-md-5">
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- START CONDITION TITLE-->
            @if(isset($data['bindbahasaasing']))
              <h3 class="box-title">Formulir Edit Data Bahasa Asing</h3>
            @else
              <h3 class="box-title">Formulir Tambah Data Bahasa Asing</h3>
            @endif
            <!-- END CONDITION TITLE-->
          </div>
          <!-- START CONDITION FORM INSERT AND UPDATE-->
          @if(isset($data['bindbahasaasing']))
            {!! Form::model($data['bindbahasaasing'],
                                 ['route' => ['masterbahasaasing.update'], $data[bindbahasaasing]->id],
                                 'method' => "patch", 'class'=>'form-horizontal') !!}
          @else
            <form class="form-horizontal" method="post" action="{{url('masterbahasaasing')}}">
          @endif
          <!-- END CONDITION FORM INSERT AND UPDATE-->
            <!-- START BODY-->
            {!! csrf_field() !!}
            <div class="box-body">
              <div class="form-group {{ $errors->has('bahasa') ? 'has-error' : ''}}">
                <label class="col-sm-3 control-label">Bahasa</labe>
                <div class="col-sm-9">
                    <input @if(isset($data['bindbahasaasing']))
                                value"{{$data['bindbahasaasing']->bahasa}"
                           @endif
                            type="text" name="bahasa" class="form-control" placeholder="Bahasa" maxlength="20"
                           @if(!errors->has('bahasa'))
                              value="{{$errors->has('bahasa')}}"
                           @endif/>
                      @if($errors->has('kode_jabatan'))
                       <span class="help-block">
                         <strong>{{ $errors->first('bahasa')}}
                         </strong>
                       </span>
                      @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('berbicara') ? 'has-error' : '' }}">
                 <label class="control-label">Berbicara</label>
                 <select class="form-control" name="berbicara">
                   <option value=""></option>
                   <option value="BAIK" {{ old('berbicara') == 'BAIK' ? 'selected="selected"' : '' }}>BAIK</option>
                   <option value="CUKUP" {{ old('berbicara') == 'CUKUP' ? 'selected="selected"' : '' }}>CUKUP</option>
                   <option value="KURANG" {{ old('berbicara') == 'KURANG' ? 'selected="selected"' : '' }}>KURANG</option>
                 </select>
                 @if($errors->has('berbicara'))
                   <span class="help-block">
                     <strong>{{ $errors->first('berbicara')}}
                     </strong>
                   </span>
                 @endif
               </div>
               <div class="form-group {{ $errors->has('menulis') ? 'has-error' : '' }}">
                  <label class="control-label">Menulis</label>
                  <select class="form-control" name="berbicara">
                    <option value=""></option>
                    <option value="BAIK" {{ old('menulis') == 'BAIK' ? 'selected="selected"' : '' }}>BAIK</option>
                    <option value="CUKUP" {{ old('menulis') == 'CUKUP' ? 'selected="selected"' : '' }}>CUKUP</option>
                    <option value="KURANG" {{ old('menulis') == 'KURANG' ? 'selected="selected"' : '' }}>KURANG</option>
                  </select>
                  @if($errors->has('menulis'))
                    <span class="help-block">
                      <strong>{{ $errors->first('menulis')}}
                      </strong>
                    </span>
                  @endif
                </div>
                <div class="form-group {{ $errors->has('mengerti') ? 'has-error' : '' }}">
                   <label class="control-label">Mengerti</label>
                   <select class="form-control" name="berbicara">
                     <option value=""></option>
                     <option value="BAIK" {{ old('mengerti') == 'BAIK' ? 'selected="selected"' : '' }}>BAIK</option>
                     <option value="CUKUP" {{ old('mengerti') == 'CUKUP' ? 'selected="selected"' : '' }}>CUKUP</option>
                     <option value="KURANG" {{ old('mengerti') == 'KURANG' ? 'selected="selected"' : '' }}>KURANG</option>
                   </select>
                   @if($errors->has('mengerti'))
                     <span class="help-block">
                       <strong>{{ $errors->first('mengerti')}}
                       </strong>
                     </span>
                   @endif
                 </div>
                 <div class="form-group {{ $errors->has('id_pegawai') ? 'has-error' : '' }}">
                   <label class="control-label">NIP</label>
                   <select class="form-control" name="id_pegawai">
                     <option value=""></option>
                     @foreach($getpegawai as $key)
                       <option value="{{ $key->id }}" {{ old('id_pegawai') == $key->id ? 'selected="selected"' : '' }}>{{ $key->nip }} - {{ $key->nama }}</option>
                     @endforeach
                   </select>
                   @if($errors->has('id_pegawai'))
                     <span class="help-block">
                       <strong>{{ $errors->first('id_pegawai')}}
                       </strong>
                     </span>
                   @endif
                 </div>
                 <div class="form-group">
                   <div class="col-sm-12">
                    <button type="submit" class="btn btn-info pull-right" style="margin-left:5px;">
                      @if(isset($data['bindbahasaasing']))
                        Simpan Perubahan
                      @else
                        Simpan
                      @endif
                    </button>
                      @if(!isset($data['bindbahasaasing']))
                        <button type="reset" class="btn btn-default pull-right">Reset Formulir</button>
                      @endif
                   </div>
                  </div>
            </div>
            <!-- START BODY-->
          @if(isset($data['bindjabatan']))
            {!! Form::close() !!}
          @else
            </form>
          @endif
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
              @foreach($data['$getbahasaasing'] as $key)
                <tr>
                  <td>{{ $pageget }}</td>
                  <td>{{ $key->nip }} - {{ $key->nama }}</td>
                  <td>{{ $key->berbicara }}</td>
                  <td>{{ $key->menulis }}</td>
                  <td>{{ $key->mengerti }}</td>
                  <td>
                    <a href="{{ route('masterbahasaasing.edit', $key->id) }}" class="btn btn-warning" data-toggle='tooltip' title='Edit Data'><i class="fa fa-edit"></i></a>
                    <span data-toggle="tooltip" title="Hapus Data">
                      <a href="" class="btn btn-danger hapus" data-toggle="modal" data-target="#myModal" data-value="{{$key->id}}"><i class="fa fa-remove"></i></a>
                    </span>
                  </td>
                </tr>
                <?php $pageget++; ?>
              @endforeach
            </table>
          </div><!-- /.box-body -->
          {{-- <div class="box-footer clearfix pull-right">
            {!! $data['getbahasaasing']->links() !!}
          </div> --}}
        </div><!-- /.box -->
      </div>
      <!-- END TABLE -->
  </div>
  <!-- END ROW -->


  <!-- jQuery 2.1.4 -->
  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>

  <script type="text/javascript">
    $(function(){
      $('a.hapus').click(function(){
        var a = $(this).data('value');
        $('#set').attr('href', "{{ url('/') }}/masterbahasaasing/delete/"+a);
      });
    });
  </script>
@stop
