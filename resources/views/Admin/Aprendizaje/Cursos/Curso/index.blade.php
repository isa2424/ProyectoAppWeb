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
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Todos los Cursos</h3>


        </div>
        <div class="box-header">
            <button type="button"class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal">
             + Agregar Curso
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Curso</h4>
                  </div>
                  <div class="modal-body">
                    <form id="demo-form2" method="post" action="{{ route('curso.guardar') }}" data-parsley-validate class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="row">
                          <div class="col-md-12">
                            <label  for="exampleInputTit1e">Categorias:<sup class="redstar">*</sup></label>
                            <br>
                            <select style="width: 100%" name="Id_Categoria" required="" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                              <option value="none" selected disabled hidden>
                               Seleccione una opcion
                              </option>
                              @foreach($categoria as $cate)
                              <option value="{{$cate->Id_Categoria}}">{{$cate->Titulo}}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label  for="exampleInputTit1e">Instructor:<sup class="redstar">*</sup></label>
                          <br>
                          <select style="width: 100%" name="Id_Persona" required="" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                            <option value="none" selected disabled hidden>
                             Seleccione una opcion
                            </option>
                            @foreach($instructor as $cate)
                            <option value="{{$cate->Id_Persona}}">{{$cate->Nombres}}  {{$cate->Apellidos}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                      <br>

                      <div class="row">
                        <div class="col-md-12">
                          <label for="c_name">Titulo:<sup class="redstar">*</sup></label>
                          <input placeholder="Ingrese el Titulo" type="text" class="form-control" name="Titulo" required="">
                        </div>
                      </div>
                      <br>



                      <div class="row">
                        <div class="col-md-12">
                          <label for="c_name">Descripción:<sup class="redstar">*</sup></label>
                          <textarea placeholder="Ingrese una descripción" type="text" name="Descripcion" rows="3" class="form-control" required="" ></textarea>
                        </div>
                      </div>
                      <br>


                      <div class="row">

                        <div class="col-md-4">
                          <label for="exampleInputDetails">Estado:</label>
                          <li class="tg-list-item">
                            <input class="tgl tgl-skewed" id="status" type="checkbox" name="Estado" >
                            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                          </li>
                          <input type="hidden"  name="free" value="0" for="status" id="status">


                        </div>
                      </div>
                      <br>

                      <div class="row">
                        <div class="col-md-6">
                          <label>Imagen:<sup class="redstar">*</sup></label>
                          <br>
                          <input required="" type="file" name="Foto" id="image" class="inputfile inputfile-1"  />


                        </div>
                      </div>

                      <br>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>Imagen</th>
                  <th>Titulo</th>

                  <th>Categoria</th>
                  <th>Estado</th>
                  <th>Editar</th>

                </thead>

                <tbody>
                  <?php $i=0;?>



                    @foreach ($cursos as $curso)

                        <?php $i++;?>

                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          @if($curso->Foto != null || $curso->Foto !='')

                          <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Cursos/'.$curso->Foto) }} ">

                          @else
                            <img src="{{ asset('images/default/user.jpg')}}" class="img-responsive" alt="User Image">
                          @endif
                        </td>
                        <td>{{ $curso->Titulo }}</td>
                        <td>{{ $curso->Categoria }}</td>

                        <td>
                            <form action="{{ route('curso.quick',$curso->Id_Curso) }}" method="POST">
                              {{ csrf_field() }}
                              <button  type="Submit" class="btn btn-xs {{ $curso->Estado ==1 ? 'btn-success' : 'btn-danger' }}">
                                @if($curso->Estado ==1)
                                Activo
                                @else
                                Inactivo
                                @endif
                              </button>
                            </form>
                          </td>
                          <td>
                            <a class="btn btn-success btn-sm" href="{{ route('curso.show',$curso->Id_Curso) }}">
                              <i class="glyphicon glyphicon-pencil"></i></a>
                          </td>



                    </tr>

                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection
@section('scripts')
    <script>
        (function($) {
            "use strict";

            $(function() {
                $('.js-example-basic-single').select2(
                    {
                    tags: true,
                    tokenSeparators: [',', ' ']
                    });
                });
        })(jQuery);

    </script>
@endsection
