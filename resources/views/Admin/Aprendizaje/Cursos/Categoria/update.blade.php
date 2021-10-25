@extends ('Admin/layouts.admin')
@section ('contenido')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<section class="content">
  @include('Admin.message')
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Categoria</h3>
        </div>

        <div class="panel-body">

          <form id="demo-form" method="post" action="{{ route('categoria.update', $Categoria->Id_Categoria ) }}" data-parsley-validate class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputTit1e">Titulo:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control" name="Titulo" id="exampleInputTitulo" value="{{$Categoria->Titulo}}">
              </div>


            </div>
            <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputTit1e">SubTitulo:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="SubTitulo" id="exampleInputTitulo" value="{{$Categoria->SubTitulo}}">
                </div>

            </div>
            <div class="row">


                <div class="row">
                  <div class="col-md-6">
                    <label for="exampleInputDetails">Descripción:<sup class="redstar">*</sup></label>
                    <textarea name="Descripcion" rows="3" class="form-control" >{!! $Categoria->Descripcion !!}</textarea>
                  </div>
                </div>
                <br>

              </div>
            <div class="row">

              <div class="col-md-3">
                <label for="exampleInputTit1e">Estado:</label>

                <li class="tg-list-item">
                  <input class="tgl tgl-skewed" id="status" type="checkbox" name="Estado" {{ $Categoria->Estado == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                </li>
                <input type="hidden"  name="free" value="0" for="status" id="status">
              </div>

            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label>Imagen:</label>
                <br>
                <input type="file" name="Foto" id="image" class="inputfile inputfile-1"  />


                @if(isset($Categoria['Foto']))
                    <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Categorias/'.$Categoria['Foto']) }}" class="img-responsive"/>
                @else

                    <img src="{{ asset('images/default/user.jpg')}}"  class="img-responsive">

                @endif
              </div>

            </div>
            <br>

            <div class="row box-footer">
              <button type="submit" class="btn btn-md col-lg-2 btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection
