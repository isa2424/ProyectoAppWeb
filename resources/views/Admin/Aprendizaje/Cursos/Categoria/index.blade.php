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
          <h3 class="box-title">Todos las Categorias</h3>
        </div>
        <div class="box-header">
            <button type="button"class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal">
             + Agregar Categoria
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agg Categoria</h4>
                  </div>
                  <div class="modal-body">
                    <form id="demo-form2" method="post" action="{{ route('categoria.guardar') }}" data-parsley-validate class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="row">
                        <div class="col-md-12">
                          <label for="c_name">Titulo:<sup class="redstar">*</sup></label>
                          <input placeholder="Ingrese el Titulo" type="text" class="form-control" name="Titulo" required="">
                        </div>
                      </div>
                      <br>

                      <div class="row">
                        <div class="col-md-12">
                          <label for="c_name">SubTitulo:<sup class="redstar">*</sup></label>
                          <input placeholder="Ingrese el SubTitulo" type="text" class="form-control" name="SubTitulo" required="">
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
                          <label>Imagen:</label> - <p class="inline info">size: 250x150</p>
                          <br>
                          <input type="file" name="Foto" id="image" class="inputfile inputfile-1"  />


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
              <table id="example4" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>Imagen</th>
                  <th>Titulo</th>

                  <th>SubTitulo</th>
                  <th>Estado</th>
                  <th>Editar</th>

                </thead>

                <tbody>
                  <?php $i=0;?>



                    @foreach ($categorias as $categoria)

                        <?php $i++;?>

                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          @if($categoria->Foto != null || $categoria->Foto !='')
                          <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Categorias/'.$categoria->Foto) }} ">

                          @else
                            <img src="{{ asset('images/default/user.jpg')}}" class="img-responsive" alt="User Image">
                          @endif
                        </td>
                        <td>{{ $categoria->Titulo }}</td>
                        <td>{{ $categoria->SubTitulo }}</td>

                        <td>
                            <form action="{{ route('categoria.quick',$categoria->Id_Categoria) }}" method="POST">
                              {{ csrf_field() }}
                              <button  type="Submit" class="btn btn-xs {{ $categoria->Estado ==1 ? 'btn-success' : 'btn-danger' }}">
                                @if($categoria->Estado ==1)
                                Activo
                                @else
                                Inactivo
                                @endif
                              </button>
                            </form>
                          </td>
                          <td>
                            <a class="btn btn-success btn-sm"  href="{{ route('categoria.show',$categoria->Id_Categoria) }}">
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



